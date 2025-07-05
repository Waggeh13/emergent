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
        // Ensure values are sent as strings to preserve precision
        $response["total_paid"] = number_format($amounts['total_paid'], 2, '.', '');
        $response["total_owed"] = number_format($amounts['total_owed'], 2, '.', '');
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