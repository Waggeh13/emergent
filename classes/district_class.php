<?php
require_once("../settings/db_class.php");

class district_class extends db_connection {

    public function getdistricts() {
        $sql = "SELECT * FROM district_table ORDER BY district_name";
        $result = $this->db_fetch_all($sql);
        return $result !== false ? $result : [];
    }

    public function adddistrict($district_id, $district_name) {
        if (!isset($_SESSION['super_admin_id'])) {
            return false;
        }

        $district_id = mysqli_real_escape_string($this->db_conn(), $district_id);
        $district_name = mysqli_real_escape_string($this->db_conn(), $district_name);
        $created_by = mysqli_real_escape_string($this->db_conn(), $_SESSION['super_admin_id']);
        $sql = "INSERT INTO district_table (district_id, district_name, created_by)
                VALUES ('$district_id', '$district_name', '$created_by')";
        return $this->db_query($sql);
    }

    public function deletedistrict($id) {
        $id = mysqli_real_escape_string($this->db_conn(), $id);
        $sql = "DELETE FROM district_table WHERE district_id = '$id'";
        return $this->db_query($sql);
    }

    public function getdistrictsbyID($id) {
        $id = mysqli_real_escape_string($this->db_conn(), $id);
        $sql = "SELECT * FROM district_table WHERE district_id = '$id'";
        return $this->db_fetch_all($sql);
    }

    public function updatedistricts($districtId, $districtName) {
        $district_id = mysqli_real_escape_string($this->db_conn(), $districtId);
        $district_name = mysqli_real_escape_string($this->db_conn(), $districtName);

        $sql = "UPDATE district_table
                SET district_name = '$district_name'
                WHERE district_id = '$district_id'";

        return $this->db_query($sql);
    }

    public function updatedistrictsWithId($original_district_id, $new_district_id, $district_name) {
        $original_district_id = mysqli_real_escape_string($this->db_conn(), $original_district_id);
        $new_district_id = mysqli_real_escape_string($this->db_conn(), $new_district_id);
        $district_name = mysqli_real_escape_string($this->db_conn(), $district_name);

        mysqli_begin_transaction($this->db_conn());

        try {
            $sql_admin = "UPDATE district_table SET district_id = ?, district_name = ? WHERE district_id = ?";
            $stmt_admin = mysqli_prepare($this->db_conn(), $sql_admin);
            mysqli_stmt_bind_param($stmt_admin, "sss", $new_district_id, $district_name, $original_district_id);
            $result = mysqli_stmt_execute($stmt_admin);
            mysqli_stmt_close($stmt_admin);

            mysqli_commit($this->db_conn());
            return $result;
        } catch (Exception $e) {
            mysqli_rollback($this->db_conn());
            return false;
        }
    }

    public function district_ID_exists($district_id) {
        $district_id = mysqli_real_escape_string($this->db_conn(), $district_id);
        $sql = "SELECT district_id FROM district_table WHERE district_id = '$district_id'";
        return $this->db_fetch_all($sql);
    }
}
?>