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

        $propertyCode = isset($_POST['property_code']) ? trim($_POST['property_code']) : '';

        if (empty($propertyCode)) {
            throw new Exception("Property code is required.");
        }

        $result = delete_property_ctr($propertyCode);

        if ($result) {
            $response["success"] = true;
            $response["message"] = "Property deleted successfully.";
        } else {
            throw new Exception("Failed to delete property.");
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