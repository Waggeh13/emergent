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

        $adminId = isset($_POST['adminID']) ? trim($_POST['adminID']) : '';
        $adminName = isset($_POST['adminName']) ? trim($_POST['adminName']) : '';
        $adminEmail = isset($_POST['adminEmail']) ? trim($_POST['adminEmail']) : '';
        $adminDistrict = isset($_POST['adminDistrict']) ? trim($_POST['adminDistrict']) : '';
        $adminStatus = isset($_POST['adminStatus']) ? trim($_POST['adminStatus']) : '';

        if (empty($adminId) || empty($adminName) || empty($adminEmail) || empty($adminDistrict) || empty($adminStatus)) {
            throw new Exception("All fields are required.");
        }

        if (admin_exists_ctr($adminId)) {
            throw new Exception("Admin ID already exists.");
        }

        $result = addadminController($adminId, $adminName, $adminEmail, $adminDistrict, $adminStatus);

        if ($result) {
            $response["success"] = true;
            $response["message"] = "Admin added successfully.";
        } else {
            throw new Exception("Failed to add admin.");
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