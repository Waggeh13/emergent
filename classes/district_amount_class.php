<?php
require_once("../settings/db_class.php");

class DistrictAmountClass extends db_connection {

    public function calculateDistrictAmounts($district_id) {
        $district_id = mysqli_real_escape_string($this->db_conn(), $district_id);
        
        $sql = "SELECT
                    COALESCE(SUM(amount_paid), 0) as total_paid,
                    COALESCE(SUM(amount_owed), 0) as total_owed
                FROM properties
                WHERE district_id = '$district_id'";
        
        $result = $this->db_fetch_one($sql);
        
        if ($result) {
            return [
                'total_paid' => floatval($result['total_paid']),
                'total_owed' => floatval($result['total_owed'])
            ];
        }
        
        return false;
    }
}
?>