<?php
require_once("../settings/db_class.php");

class properties_class extends db_connection {

    
    public function getproperties() {
        $sql = "SELECT * FROM properties ORDER BY property_code";
        $result = $this->db_fetch_all($sql);
        return $result !== false ? $result : [];
    }


}