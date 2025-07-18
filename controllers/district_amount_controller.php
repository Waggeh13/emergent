<?php
require("../classes/district_amount_class.php");

if (!function_exists('sanitize_input')) {
    function sanitize_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }
}

function calculateDistrictAmountsController($district_id) {
    $district_amount = new DistrictAmountClass();
    return $district_amount->calculateDistrictAmounts($district_id);
}
?>