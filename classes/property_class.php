<?php
require_once("../settings/db_class.php");

class property_class extends db_connection {

    public function get_properties() {
        $sql = "SELECT * FROM properties ORDER BY property_code";
        return $this->db_fetch_all($sql);
    }

    public function get_property_by_code($property_code) {
        $property_code = mysqli_real_escape_string($this->db_conn(), $property_code);
        $sql = "SELECT * FROM properties WHERE property_code = '$property_code'";
        return $this->db_fetch_all($sql);
    }

    public function property_code_exists($property_code) {
        $property_code = mysqli_real_escape_string($this->db_conn(), $property_code);
        $sql = "SELECT property_code FROM properties WHERE property_code = '$property_code'";
        return $this->db_fetch_all($sql);
    }

    public function get_admin_district($admin_id) {
        $admin_id = mysqli_real_escape_string($this->db_conn(), $admin_id);
        $sql = "SELECT district_id FROM admin_table WHERE admin_id = '$admin_id'";
        return $this->db_fetch_all($sql);
    }

    public function add_property($property_code, $owner_name, $phone, $email, $address, $property_type, $category, $assessment, $rate, $amount_owed, $amount_paid, $status, $billing_cycle, $district_id, $created_by) {
        if (!isset($_SESSION['admin_id'])) {
            return false;
        }

        $property_code = mysqli_real_escape_string($this->db_conn(), $property_code);
        $owner_name = mysqli_real_escape_string($this->db_conn(), $owner_name);
        $phone = mysqli_real_escape_string($this->db_conn(), $phone);
        $email = $email ? mysqli_real_escape_string($this->db_conn(), $email) : null;
        $address = mysqli_real_escape_string($this->db_conn(), $address);
        $property_type = mysqli_real_escape_string($this->db_conn(), $property_type);
        $category = mysqli_real_escape_string($this->db_conn(), $category);
        $assessment = floatval($assessment);
        $rate = floatval($rate);
        $amount_owed = floatval($amount_owed);
        $amount_paid = floatval($amount_paid);
        $status = mysqli_real_escape_string($this->db_conn(), $status);
        $billing_cycle = mysqli_real_escape_string($this->db_conn(), $billing_cycle);
        $district_id = mysqli_real_escape_string($this->db_conn(), $district_id);
        $created_by = mysqli_real_escape_string($this->db_conn(), $created_by);

        $sql = "INSERT INTO properties (property_code, owner_name, owner_phone_number, email, property_address, property_type, property_category, assessment, rate, amount_owed, amount_paid, payment_status, billing_cycle, district_id, created_by)
                VALUES ('$property_code', '$owner_name', '$phone', " . ($email ? "'$email'" : "NULL") . ", '$address', '$property_type', '$category', $assessment, $rate, $amount_owed, $amount_paid, '$status', '$billing_cycle', '$district_id', '$created_by')";
        return $this->db_query($sql);
    }

    public function update_property($original_property_code, $property_code, $owner_name, $phone, $email, $address, $property_type, $category, $assessment, $rate, $amount_owed, $amount_paid, $status, $billing_cycle, $district_id, $created_by) {
        $original_property_code = mysqli_real_escape_string($this->db_conn(), $original_property_code);
        $property_code = mysqli_real_escape_string($this->db_conn(), $property_code);
        $owner_name = mysqli_real_escape_string($this->db_conn(), $owner_name);
        $phone = mysqli_real_escape_string($this->db_conn(), $phone);
        $email = $email ? mysqli_real_escape_string($this->db_conn(), $email) : null;
        $address = mysqli_real_escape_string($this->db_conn(), $address);
        $property_type = mysqli_real_escape_string($this->db_conn(), $property_type);
        $category = mysqli_real_escape_string($this->db_conn(), $category);
        $assessment = floatval($assessment);
        $rate = floatval($rate);
        $amount_owed = floatval($amount_owed);
        $amount_paid = floatval($amount_paid);
        $status = mysqli_real_escape_string($this->db_conn(), $status);
        $billing_cycle = mysqli_real_escape_string($this->db_conn(), $billing_cycle);
        $district_id = mysqli_real_escape_string($this->db_conn(), $district_id);
        $created_by = mysqli_real_escape_string($this->db_conn(), $created_by);

        $sql = "UPDATE properties
                SET property_code = '$property_code', owner_name = '$owner_name', owner_phone_number = '$phone', email = " . ($email ? "'$email'" : "NULL") . ", property_address = '$address', property_type = '$property_type', property_category = '$category', assessment = $assessment, rate = $rate, amount_owed = $amount_owed, amount_paid = $amount_paid, payment_status = '$status', billing_cycle = '$billing_cycle', district_id = '$district_id', created_by = '$created_by'
                WHERE property_code = '$original_property_code'";
        return $this->db_query($sql);
    }

    public function delete_property($property_code) {
        $property_code = mysqli_real_escape_string($this->db_conn(), $property_code);
        $sql = "DELETE FROM properties WHERE property_code = '$property_code'";
        return $this->db_query($sql);
    }
}
?>