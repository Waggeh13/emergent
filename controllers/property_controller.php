<?php
require("../classes/property_class.php");

function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

function view_properties_ctr() {
    $property = new property_class();
    $result = $property->get_properties();
    return $result !== false ? $result : [];
}

function view_property_ctr($property_code) {
    $property = new property_class();
    $result = $property->get_property_by_code($property_code);
    return $result !== false ? $result : [];
}

function property_exists_ctr($property_code) {
    $property = new property_class();
    $result = $property->property_code_exists($property_code);
    return $result !== false && !empty($result);
}

function get_admin_district_ctr($admin_id) {
    $property = new property_class();
    $result = $property->get_admin_district($admin_id);
    return $result !== false && !empty($result) ? $result[0]['district_id'] : null;
}

function add_property_ctr($property_code, $owner_name, $phone, $email, $address, $property_type, $category, $assessment, $rate, $amount_owed, $amount_paid, $status, $billing_cycle, $district_id, $created_by) {
    $property = new property_class();
    return $property->add_property($property_code, $owner_name, $phone, $email, $address, $property_type, $category, $assessment, $rate, $amount_owed, $amount_paid, $status, $billing_cycle, $district_id, $created_by);
}

function update_property_ctr($original_property_code, $property_code, $owner_name, $phone, $email, $address, $property_type, $category, $assessment, $rate, $amount_owed, $amount_paid, $status, $billing_cycle, $district_id, $created_by) {
    $property = new property_class();
    return $property->update_property($original_property_code, $property_code, $owner_name, $phone, $email, $address, $property_type, $category, $assessment, $rate, $amount_owed, $amount_paid, $status, $billing_cycle, $district_id, $created_by);
}

function delete_property_ctr($property_code) {
    $property = new property_class();
    return $property->delete_property($property_code);
}
?>