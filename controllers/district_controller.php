<?php
require("../classes/district_class.php");

if (!function_exists('sanitize_input')) {
    function sanitize_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }
}


function viewdistrictsController() {
    $districts = new district_class();
    $result = $districts->getdistricts();
    return $result !== false ? $result : [];
}

function viewdistrictController($districtId) {
    $district = new district_class();
    $result = $district->getdistrictsbyID($districtId);
    return $result !== false ? $result : [];
}

function district_exists_ctr($district_id) {
    $district = new district_class();
    $result = $district->district_ID_exists($district_id);
    return $result !== false && !empty($result);
}

function adddistrictController($districtId, $districtName) {
    $district = new district_class();
    return $district->adddistrict($districtId, $districtName);
}
?>