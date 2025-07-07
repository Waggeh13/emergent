<?php
session_start();
require_once("../controllers/district_amount_controller.php");
require_once("../settings/db_class.php");

$response = array("success" => false, "message" => "", "data" => []);

try {
    // Check if admin is logged in
    if (!isset($_SESSION['admin_id'])) {
        throw new Exception("Admin not logged in");
    }

    $admin_id = $_SESSION['admin_id'];
    
    // Create database connection
    $db = new db_connection();
    
    // Fetch district_id for the admin
    $sql = "SELECT district_id FROM admin_table WHERE admin_id = ?";
    $stmt = mysqli_prepare($db->db_conn(), $sql);
    mysqli_stmt_bind_param($stmt, "s", $admin_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (!$result) {
        throw new Exception("Failed to query admin data: " . mysqli_error($db->db_conn()));
    }
    
    $admin_data = mysqli_fetch_assoc($result);
    if (!$admin_data) {
        throw new Exception("Admin not found");
    }
    
    $district_id = $admin_data['district_id'];
    
    // Fetch district amounts
    $amounts = calculateDistrictAmountsController($district_id);
    if ($amounts === false) {
        throw new Exception("Failed to fetch district amounts");
    }

    $response['data'] = [
        'total_owed' => $amounts['total_owed'],
        'total_paid' => $amounts['total_paid'],
        'district_id' => $district_id
    ];
    $response['success'] = true;
    
} catch (Exception $e) {
    $response['message'] = "Error fetching data: " . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>