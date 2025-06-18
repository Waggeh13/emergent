<?php
session_start();
include("../controllers/login_controller.php");

$response = ['error' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_number = sanitize_input($_POST['phone_number']);
    $password = sanitize_input($_POST['password']);

    $response = login_user($phone_number, $password);
} else {
    $response['error'] = true;
    $response['message'] = "Wrong request method. Please try again.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>