<?php
require("../classes/district_class.php");

function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

function viewdistrictsController() {
    $districts = new district_class();
    return $districts->getdistricts();
}

function district_exists_ctr($district_id) {
    $district = new district_class();
    return $district->district_ID_exists($district_id);
}

function adddistrictController($districtId, $districtName) {
    $district = new district_class();
    return $district->adddistrict($districtId, $districtName);
}
?>