<?php
include("../controllers/district_controller.php");

$response = array("success" => false, "message" => "", "data" => []);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $districtId = isset($_POST["district_id"]) ? trim($_POST["district_id"]) : 0;
        if (empty($districtId)) {
            throw new Exception("District ID is required.");
        }

        $district = viewdistrictController($districtId);

        if ($district !== false && is_array($district) && !empty($district)) {
            $response["success"] = true;
            $response["data"] = $district;
        } else {
            $response["message"] = "District not found.";
        }
    } catch (Exception $e) {
        $response["message"] = "Error fetching district: " . $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method. Expected POST.";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>