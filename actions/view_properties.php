<?php
ob_start();
session_start();
include("../controllers/property_controller.php");

$response = array("success" => false, "message" => "", "data" => []);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        if (!isset($_SESSION['admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        $properties = view_properties_ctr();

        if ($properties !== false && is_array($properties)) {
            $response["success"] = true;
            $response["data"] = $properties;
        } else {
            $response["message"] = "No properties found.";
            $response["data"] = [];
        }
    } catch (Exception $e) {
        $response["message"] = "Error fetching properties: " . $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method.";
}

ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>