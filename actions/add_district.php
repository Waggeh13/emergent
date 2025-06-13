<?php
session_start();
include("../controllers/district_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        $response["message"] = "User not logged in.";
        echo json_encode($response);
        exit();
    }

    $districtId = sanitize_input($_POST['districtId']);

    if (district_exists_ctr($districtId)) {
        $response = [
            "success" => false,
            "message" => "ID already registered. Please Verify."
        ];
        echo json_encode($response);
        exit();
    }

    $districtName = sanitize_input($_POST['districtName']);

    $result = adddistrictController($districtId, $districtName);
    if ($result) {
        $response["success"] = true;
        $response["message"] = "District registered successfully.";
    } else {
        $response["success"] = false;
        $response["message"] = "Error: Unable to register district. Please try again.";
    }
} else {
    $response["message"] = "Invalid request method.";
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>