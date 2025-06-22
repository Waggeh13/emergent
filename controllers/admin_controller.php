<?php
require("../classes/admin_class.php");

function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

function viewadminsController() {
    $admins = new admin_class();
    $result = $admins->getadmins();
    return $result !== false ? $result : [];
}

function viewadminController($adminId) {
    $admin = new admin_class();
    $result = $admin->getadminsbyID($adminId);
    return $result !== false ? $result : [];
}

function admin_exists_ctr($admin_id) {
    $admin = new admin_class();
    $result = $admin->admin_ID_exists($admin_id);
    return $result !== false && !empty($result);
}

function addadminController($adminId, $adminName, $adminEmail, $adminDistrict, $adminStatus) {
    $admin = new admin_class();
    return $admin->addadmin($adminId, $adminName, $adminEmail, $adminDistrict, $adminStatus);
}

function updateadminController($adminId, $adminName, $adminEmail, $adminDistrict, $adminStatus) {
    $admin = new admin_class();
    return $admin->updateadmin($adminId, $adminName, $adminEmail, $adminDistrict, $adminStatus);
}

function updateadminWithIdController($originalAdminId, $newAdminId, $adminName, $adminEmail, $adminDistrict, $adminStatus) {
    $admin = new admin_class();
    return $admin->updateadminWithId($originalAdminId, $newAdminId, $adminName, $adminEmail, $adminDistrict, $adminStatus);
}

function deleteadminController($adminId) {
    $admin = new admin_class();
    return $admin->deleteadmin($adminId);
}
?>