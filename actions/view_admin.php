<?php
ob_start();
session_start();
include("../controllers/admin_controller.php");

$response = array("success" => false, "message" => "", "data" => []);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $adminId = isset($_POST["admin_id"]) ? trim($_POST["admin_id"]) : 0;
        if (empty($adminId)) {
            throw new Exception("Admin ID is required.");
        }

        $admin = viewadminController($adminId);

        if ($admin !== false && is_array($admin) && !empty($admin)) {
            $response["success"] = true;
            $response["data"] = $admin;
        } else {
            $response["message"] = "Admin not found.";
        }
    } catch (Exception $e) {
        $response["message"] = "Error fetching admin: " . $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method. Expected POST.";
}

ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>