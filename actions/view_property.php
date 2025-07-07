<?php
ob_start();
session_start();
include("../controllers/property_controller.php");

$response = array("success" => false, "message" => "", "data" => []);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_SESSION['admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        $propertyCode = isset($_POST["property_code"]) ? trim($_POST["property_code"]) : '';

        if (empty($propertyCode)) {
            throw new Exception("Property code is required.");
        }

        $property = view_property_ctr($propertyCode);

        if ($property !== false && is_array($property) && !empty($property)) {
            $response["success"] = true;
            $response["data"] = $property;
        } else {
            $response["message"] = "Property not found.";
        }
    } catch (Exception $e) {
        $response["message"] = "Error fetching property: " . $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method.";
}

ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>