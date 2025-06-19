<?php
require("../settings/db_class.php");

class login_class extends db_connection
{
    public function get_admin_by_id($admin_id)
    {
        $sql = "SELECT admin_id, password FROM admin_table WHERE admin_id = ?";
        $stmt = $this->db_conn()->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $admin_id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($admin_id, $password);
                $stmt->fetch();
                return [
                    'admin_id' => $admin_id,
                    'password' => $password
                ];
            } else {
                return null;
            }
        } else {
            return false;
        }
    }

    public function verify_password($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    public function get_user_by_number($phone_number)
    {
        $sql = "SELECT phone_number, password FROM user_table WHERE phone_number = ?";
        $stmt = $this->db_conn()->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $phone_number);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($phone_number, $password);
                $stmt->fetch();
                return [
                    'phone_number' => $phone_number,
                    'password' => $password
                ];
            } else {
                return null;
            }
        } else {
            return false;
        }
    }

        public function get_super_admin($super_admin_id)
    {
        $sql = "SELECT superadmin_id, password FROM superadmin_table WHERE superadmin_id = ?";
        $stmt = $this->db_conn()->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $super_admin_id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($super_admin_id, $password);
                $stmt->fetch();
                return [
                    'super_admin_id' => $super_admin_id,
                    'password' => $password
                ];
            } else {
                return null;
            }
        } else {
            return false;
        }
    }
}
?>