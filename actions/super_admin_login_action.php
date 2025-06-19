<?php
session_start();
include("../controllers/login_controller.php");

$response = ['error' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $super_admin_id = sanitize_input($_POST['super_admin_id']);
    $password = sanitize_input($_POST['password']);

    $response = login_super_admin($super_admin_id, $password);
} else {
    $response['error'] = true;
    $response['message'] = "Wrong request method. Please try again.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>