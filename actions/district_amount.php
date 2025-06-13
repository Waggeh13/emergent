<?php
include("../controllers/district_amount_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['district_id'])) {
        $response["message"] = "District ID is required.";
        echo json_encode($response);
        exit();
    }

    $district_id = sanitize_input($_POST['district_id']);
    
    $amounts = calculateDistrictAmountsController($district_id);

    if ($amounts !== false) {
        $response["success"] = true;
        $response["total_paid"] = $amounts['total_paid'];
        $response["total_owed"] = $amounts['total_owed'];
    } else {
        $response["message"] = "Error calculating district amounts.";
    }
} else {
    $response["message"] = "Invalid request method.";
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>