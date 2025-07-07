<?php
require_once("../settings/db_class.php");

class admin_class extends db_connection {

    public function getadmins() {
        $sql = "SELECT * FROM admin_table ORDER BY fullname";
        $result = $this->db_fetch_all($sql);
        return $result !== false ? $result : [];
    }

    public function addadmin($adminId, $adminName, $adminEmail, $adminDistrict, $adminStatus) {
        if (!isset($_SESSION['super_admin_id'])) {
            return false;
        }

        $adminId = mysqli_real_escape_string($this->db_conn(), $adminId);
        $adminName = mysqli_real_escape_string($this->db_conn(), $adminName);
        $adminEmail = mysqli_real_escape_string($this->db_conn(), $adminEmail);
        $adminDistrict = mysqli_real_escape_string($this->db_conn(), $adminDistrict);
        $adminStatus = mysqli_real_escape_string($this->db_conn(), $adminStatus);
        $created_by = mysqli_real_escape_string($this->db_conn(), $_SESSION['super_admin_id']);
        $password = mysqli_real_escape_string($this->db_conn(), "Emergent@2025");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin_table (admin_id, fullname, email, password, district_id, Status, created_by)
                VALUES ('$adminId', '$adminName', '$adminEmail', '$hashed_password', '$adminDistrict', '$adminStatus', '$created_by')";
        return $this->db_query($sql);
    }

    public function deleteadmin($id) {
        $id = mysqli_real_escape_string($this->db_conn(), $id);
        $sql = "DELETE FROM admin_table WHERE admin_id = '$id'";
        return $this->db_query($sql);
    }

    public function getadminsbyID($id) {
        $id = mysqli_real_escape_string($this->db_conn(), $id);
        $sql = "SELECT * FROM admin_table WHERE admin_id = '$id'";
        return $this->db_fetch_all($sql);
    }

    public function updateadmin($adminId, $adminName, $adminEmail, $adminDistrict, $adminStatus) {
        $adminId = mysqli_real_escape_string($this->db_conn(), $adminId);
        $adminName = mysqli_real_escape_string($this->db_conn(), $adminName);
        $adminEmail = mysqli_real_escape_string($this->db_conn(), $adminEmail);
        $adminDistrict = mysqli_real_escape_string($this->db_conn(), $adminDistrict);
        $adminStatus = mysqli_real_escape_string($this->db_conn(), $adminStatus);

        $sql = "UPDATE admin_table
                SET fullname = '$adminName', email = '$adminEmail', district_id = '$adminDistrict', Status = '$adminStatus'
                WHERE admin_id = '$adminId'";

        return $this->db_query($sql);
    }

    public function updateadminWithId($original_admin_id, $new_admin_id, $adminName, $adminEmail, $adminDistrict, $adminStatus) {
        $original_admin_id = mysqli_real_escape_string($this->db_conn(), $original_admin_id);
        $new_admin_id = mysqli_real_escape_string($this->db_conn(), $new_admin_id);
        $adminName = mysqli_real_escape_string($this->db_conn(), $adminName);
        $adminEmail = mysqli_real_escape_string($this->db_conn(), $adminEmail);
        $adminDistrict = mysqli_real_escape_string($this->db_conn(), $adminDistrict);
        $adminStatus = mysqli_real_escape_string($this->db_conn(), $adminStatus);

        mysqli_begin_transaction($this->db_conn());

        try {
            $sql_admin = "UPDATE admin_table SET admin_id = ?, fullname = ?, email = ?, district_id = ?, Status = ? WHERE admin_id = ?";
            $stmt_admin = mysqli_prepare($this->db_conn(), $sql_admin);
            mysqli_stmt_bind_param($stmt_admin, "ssssss", $new_admin_id, $adminName, $adminEmail, $adminDistrict, $adminStatus, $original_admin_id);
            $result = mysqli_stmt_execute($stmt_admin);
            mysqli_stmt_close($stmt_admin);

            mysqli_commit($this->db_conn());
            return $result;
        } catch (Exception $e) {
            mysqli_rollback($this->db_conn());
            return false;
        }
    }

    public function admin_ID_exists($admin_id) {
        $admin_id = mysqli_real_escape_string($this->db_conn(), $admin_id);
        $sql = "SELECT admin_id FROM admin_table WHERE admin_id = '$admin_id'";
        return $this->db_fetch_all($sql);
    }
}
?>