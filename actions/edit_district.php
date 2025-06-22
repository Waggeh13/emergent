<?php
session_start();
include("../controllers/district_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_SESSION['super_admin_id'])) {
            throw new Exception("User not authenticated. Please log in.");
        }

        $originalDistrictId = isset($_POST['originalDistrictId']) ? trim($_POST['originalDistrictId']) : '';
        $newDistrictId = isset($_POST['districtId']) ? trim($_POST['districtId']) : '';
        $districtName = isset($_POST['districtName']) ? trim($_POST['districtName']) : '';

        if (empty($originalDistrictId) || empty($newDistrictId) || empty($districtName)) {
            throw new Exception("All fields are required.");
        }
        if ($newDistrictId !== $originalDistrictId && district_exists_ctr($newDistrictId)) {
            throw new Exception("New District ID already exists.");
        }

        $district = new district_class();

        if ($newDistrictId === $originalDistrictId) {
            // Update only the name
            $result = $district->updatedistricts($originalDistrictId, $districtName);
        } else {
            // Update both ID and name
            $result = $district->updatedistrictsWithId($originalDistrictId, $newDistrictId, $districtName);
        }

        if ($result) {
            $response["success"] = true;
            $response["message"] = "District updated successfully.";
        } else {
            throw new Exception("Failed to update district.");
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