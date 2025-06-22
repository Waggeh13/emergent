<?php
session_start();
include("../controllers/district_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_SESSION['super_admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        $districtId = isset($_POST['district_id']) ? trim($_POST['district_id']) : '';

        if (empty($districtId)) {
            throw new Exception("District ID is required.");
        }

        $district = new district_class();
        $result = $district->deletedistrict($districtId);

        if ($result) {
            $response["success"] = true;
            $response["message"] = "District deleted successfully.";
        } else {
            throw new Exception("Failed to delete district.");
        }
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method.";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>