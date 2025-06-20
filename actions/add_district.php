<?php
session_start();
include("../controllers/district_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_SESSION['super_admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        $districtId = isset($_POST['districtId']) ? trim($_POST['districtId']) : '';
        $districtName = isset($_POST['districtName']) ? trim($_POST['districtName']) : '';


        if (district_exists_ctr($districtId)) {
            throw new Exception("District ID already exists.");
        }

        $result = adddistrictController($districtId, $districtName);

        if ($result) {
            $response["success"] = true;
            $response["message"] = "District added successfully.";
        } else {
            throw new Exception("Failed to add district.");
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