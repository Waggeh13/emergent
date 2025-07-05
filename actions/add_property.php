<?php
ob_start();
session_start();
include("../controllers/property_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_SESSION['admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        $propertyCode = isset($_POST['propertyCode']) ? trim($_POST['propertyCode']) : '';
        $ownerName = isset($_POST['OwnerName']) ? trim($_POST['OwnerName']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';
        $propertyType = isset($_POST['propertyType']) ? trim($_POST['propertyType']) : '';
        $category = isset($_POST['category']) ? trim($_POST['category']) : '';
        $assessment = isset($_POST['assetValue']) ? floatval($_POST['assetValue']) : 0;
        $rate = isset($_POST['rate']) ? floatval($_POST['rate']) : 0;
        $status = isset($_POST['status']) ? trim($_POST['status']) : 'Unpaid';
        $billingCycle = isset($_POST['billingCycle']) ? trim($_POST['billingCycle']) : '';

        if (empty($propertyCode) || empty($ownerName) || empty($phone) || empty($address) || empty($propertyType) || empty($category) || empty($assessment) || empty($rate) || empty($status) || empty($billingCycle)) {
            throw new Exception("All required fields must be filled.");
        }

        if (property_exists_ctr($propertyCode)) {
            throw new Exception("Property code already exists.");
        }

        $adminId = $_SESSION['admin_id'];
        $districtId = get_admin_district_ctr($adminId);
        if (!$districtId) {
            throw new Exception("District not found for this admin.");
        }

        $amountOwed = $assessment * ($rate / 100);
        $amountPaid = 0.00;

        $result = add_property_ctr($propertyCode, $ownerName, $phone, $email, $address, $propertyType, $category, $assessment, $rate, $amountOwed, $amountPaid, $status, $billingCycle, $districtId, $adminId);

        if ($result) {
            $response["success"] = true;
            $response["message"] = "Property added successfully.";
        } else {
            throw new Exception("Failed to add property.");
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