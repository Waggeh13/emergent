<?php

include("../controllers/district_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $districts = viewdistrictsController();
        
        if ($districts !== false && is_array($districts)) {
            $response["success"] = true;
            $response["data"] = $districts;
        } else {
            $response["message"] = "No districts found.";
            $response["data"] = [];
        }
    } catch (Exception $e) {
        $response["message"] = "Error fetching districts: " . $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method.";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>