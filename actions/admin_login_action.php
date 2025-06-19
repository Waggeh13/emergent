<?php
session_start();
include("../controllers/login_controller.php");

$response = ['error' => false, 'message' => '', 'is_default_password' => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = sanitize_input($_POST['admin_id']);
    $password = sanitize_input($_POST['password']);

    $response = login_admin($admin_id, $password);
} else {
    $response['error'] = true;
    $response['message'] = "Wrong request method. Please try again.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>