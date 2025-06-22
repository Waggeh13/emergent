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

        $adminId = isset($_POST['admin_id']) ? trim($_POST['admin_id']) : '';

        if (empty($adminId)) {
            throw new Exception("Admin ID is required.");
        }

        $result = deleteadminController($adminId);

        if ($result) {
            $response["success"] = true;
            $response["message"] = "Admin deleted successfully.";
        } else {
            throw new Exception("Failed to delete admin.");
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