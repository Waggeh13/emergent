<?php
ob_start();
session_start();
include("../controllers/property_controller.php");

$response = array("success" => false, "message" => "", "errors" => []);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_SESSION['admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        if (!isset($_FILES['propertyFile']) || $_FILES['propertyFile']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("No valid file uploaded.");
        }

        $adminId = $_SESSION['admin_id'];
        $districtId = get_admin_district_ctr($adminId);
        if (!$districtId) {
            throw new Exception("District not found for this admin.");
        }

        $file = $_FILES['propertyFile']['tmp_name'];
        $handle = fopen($file, 'r');
        if ($handle === false) {
            throw new Exception("Failed to open CSV file.");
        }

        $headers = fgetcsv($handle);
        if ($headers === false) {
            throw new Exception("Invalid CSV format.");
        }

        $headers = array_map('trim', $headers);
        $requiredHeaders = ['Property Code', 'Owner Name', 'Phone Number', 'Email', 'Address', 'Type', 'Category', 'Asset Value', 'Rate', 'Status', 'Billing Cycle'];
        if (count(array_intersect($headers, $requiredHeaders)) !== count($requiredHeaders)) {
            throw new Exception("CSV is missing required headers.");
        }

        $rowNumber = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;
            $data = array_combine($headers, array_map('trim', $row));

            $propertyCode = $data['Property Code'] ?? '';
            $ownerName = $data['Owner Name'] ?? '';
            $phone = $data['Phone Number'] ?? '';
            $email = $data['Email'] ?? '';
            $address = $data['Address'] ?? '';
            $propertyType = $data['Type'] ?? '';
            $category = $data['Category'] ?? '';
            $assessment = floatval($data['Asset Value'] ?? 0);
            $rate = floatval($data['Rate'] ?? 0);
            $status = $data['Status'] ?? 'Unpaid';
            $billingCycle = $data['Billing Cycle'] ?? '';

            if (empty($propertyCode) || empty($ownerName) || empty($phone) || empty($address) || empty($propertyType) || empty($category) || empty($assessment) || empty($rate) || empty($status) || empty($billingCycle)) {
                $response["errors"][] = "Row $rowNumber: Missing required fields.";
                continue;
            }

            if (property_exists_ctr($propertyCode)) {
                $response["errors"][] = "Row $rowNumber: Property code '$propertyCode' already exists.";
                continue;
            }

            $amountOwed = $assessment * ($rate / 100);
            $amountPaid = 0.00;

            $result = add_property_ctr($propertyCode, $ownerName, $phone, $email, $address, $propertyType, $category, $assessment, $rate, $amountOwed, $amountPaid, $status, $billingCycle, $districtId, $adminId);

            if (!$result) {
                $response["errors"][] = "Row $rowNumber: Failed to add property.";
            }
        }

        fclose($handle);

        if (empty($response["errors"])) {
            $response["success"] = true;
            $response["message"] = "All properties uploaded successfully.";
        } else {
            $response["success"] = false;
            $response["message"] = "Some rows failed to upload. See errors for details.";
        }
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method.";
}

ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>