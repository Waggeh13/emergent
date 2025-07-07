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

        $originalPropertyCode = isset($_POST['originalPropertyCode']) ? trim($_POST['originalPropertyCode']) : '';
        $propertyCode = isset($_POST['editPropertyCode']) ? trim($_POST['editPropertyCode']) : '';
        $ownerName = isset($_POST['editOwnerName']) ? trim($_POST['editOwnerName']) : '';
        $phone = isset($_POST['editPhone']) ? trim($_POST['editPhone']) : '';
        $email = isset($_POST['editEmail']) ? trim($_POST['editEmail']) : '';
        $address = isset($_POST['editAddress']) ? trim($_POST['editAddress']) : '';
        $propertyType = isset($_POST['editPropertyType']) ? trim($_POST['editPropertyType']) : '';
        $category = isset($_POST['editCategory']) ? trim($_POST['editCategory']) : '';
        $assessment = isset($_POST['editAssetValue']) ? floatval($_POST['editAssetValue']) : 0;
        $rate = isset($_POST['editRate']) ? floatval($_POST['editRate']) : 0;
        $status = isset($_POST['editStatus']) ? trim($_POST['editStatus']) : '';
        $billingCycle = isset($_POST['editBillingCycle']) ? trim($_POST['editBillingCycle']) : '';

        if (empty($propertyCode) || empty($ownerName) || empty($phone) || empty($address) || empty($propertyType) || empty($category) || empty($assessment) || empty($rate) || empty($status) || empty($billingCycle)) {
            throw new Exception("All required fields must be filled.");
        }

        if ($originalPropertyCode !== $propertyCode && property_exists_ctr($propertyCode)) {
            throw new Exception("New property code already exists.");
        }

        $adminId = $_SESSION['admin_id'];
        $districtId = get_admin_district_ctr($adminId);
        if (!$districtId) {
            throw new Exception("District not found for this admin.");
        }

        $amountOwed = $assessment * ($rate / 100);
        $amountPaid = 0.00;

        $result = update_property_ctr($originalPropertyCode, $propertyCode, $ownerName, $phone, $email, $address, $propertyType, $category, $assessment, $rate, $amountOwed, $amountPaid, $status, $billingCycle, $districtId, $adminId);

        if ($result) {
            $response["success"] = true;
            $response["message"] = "Property updated successfully.";
        } else {
            throw new Exception("Failed to update property.");
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