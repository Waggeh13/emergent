<?php
include("../classes/login_class.php");

function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

function login_admin($admin_id, $password)
{
    $admin_login = new login_class();
    $default_password = "Emergent@2025";

    $user = $admin_login->get_admin_by_id($admin_id);
    if ($user === null) {
        return [
            'error' => true,
            'message' => 'Admin not registered or incorrect admin ID.',
            'is_default_password' => false
        ];
    }

    if ($admin_login->verify_password($password, $user['password'])) {
        $is_default_password = password_verify($default_password, $user['password']);
        
        $_SESSION['admin_id'] = $user['admin_id'];

        return [
            'error' => false,
            'message' => 'Login successful.',
            'is_default_password' => $is_default_password
        ];
    } else {
        return [
            'error' => true,
            'message' => 'Incorrect password.',
            'is_default_password' => false
        ];
    }
}

function login_user($phone_number, $password)
{
    $user_login = new login_class();

    $user = $user_login->get_user_by_number($phone_number);
    if ($user === null) {
        return ['error' => true, 'message' => 'User not registered or incorrect phone number.'];
    }

    if ($user_login->verify_password($password, $user['password'])) {
        $_SESSION['phone_number'] = $user['phone_number'];
        return ['error' => false];
    } else {
        return ['error' => true, 'message' => 'Incorrect password.'];
    }
}
?>