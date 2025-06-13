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
        $sql = "SELECT user_number, role, password FROM user_table WHERE phone_number = ?";
        $stmt = $this->db_conn()->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user_id, $role, $password);
                $stmt->fetch();
                return [
                    'user_id' => $user_id,
                    'role' => $role,
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