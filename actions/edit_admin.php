<?php
ob_start();
session_start();
include("../controllers/admin_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_SESSION['super_admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        $originalAdminID = isset($_POST['originalAdminID']) ? trim($_POST['originalAdminID']) : '';
        $newAdminID = isset($_POST['adminID']) ? trim($_POST['adminID']) : '';
        $adminName = isset($_POST['adminName']) ? trim($_POST['adminName']) : '';
        $adminEmail = isset($_POST['adminEmail']) ? trim($_POST['adminEmail']) : '';
        $adminDistrict = isset($_POST['adminDistrict']) ? trim($_POST['adminDistrict']) : '';
        $adminStatus = isset($_POST['adminStatus']) ? trim($_POST['adminStatus']) : '';

        if (empty($originalAdminID) || empty($newAdminID) || empty($adminName) || empty($adminEmail) || empty($adminDistrict) || empty($adminStatus)) {
            throw new Exception("All fields are required.");
        }

        // Check if new admin ID exists and is different from original
        if ($newAdminID !== $originalAdminID && admin_exists_ctr($newAdminID)) {
            throw new Exception("New Admin ID already exists.");
        }

        if ($newAdminID === $originalAdminID) {
            // Update only the other fields
            $result = updateadminController($newAdminID, $adminName, $adminEmail, $adminDistrict, $adminStatus);
        } else {
            // Update admin ID and other fields
            $result = updateadminWithIdController($originalAdminID, $newAdminID, $adminName, $adminEmail, $adminDistrict, $adminStatus);
        }

        if ($result) {
            $response["success"] = true;
            $response["message"] = "Admin updated successfully.";
        } else {
            throw new Exception("Failed to update admin.");
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