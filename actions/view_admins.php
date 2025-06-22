<?php
ob_start();
include("../controllers/admin_controller.php");

$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $admins = viewadminsController();

        if ($admins !== false && is_array($admins)) {
            $response["success"] = true;
            $response["data"] = $admins;
        } else {
            $response["message"] = "No admins found.";
            $response["data"] = [];
        }
    } catch (Exception $e) {
        $response["message"] = "Error fetching admins: " . $e->getMessage();
    }
} else {
    $response["message"] = "Invalid request method.";
}

ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit();
?>