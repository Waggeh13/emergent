<?php
require("../classes/properties_class.php");

if (!function_exists('sanitize_input')) {
    function sanitize_input($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }
}


function viewpropertiesController() {
    $properties = new properties_class();
    $result = $properties->getproperties();
    return $result !== false ? $result : [];
}


?>