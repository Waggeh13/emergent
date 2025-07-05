<?php
require_once("../controllers/district_controller.php");
require_once("../controllers/properties_controller.php");
require_once("../controllers/district_amount_controller.php");

$response = array("success" => false, "message" => "", "summary" => [], "districts" => []);

try {
    // Fetch all districts
    $districts = viewdistrictsController();
    if ($districts === false) {
        throw new Exception("Failed to fetch districts");
    }

    // Fetch all properties
    $properties = viewpropertiesController();
    if ($properties === false) {
        throw new Exception("Failed to fetch properties");
    }

    // Calculate summary metrics
    $total_properties = count($properties);
    $total_paid = '0.00';
    $total_unpaid = '0.00';
    $paid_properties = 0;
    $unpaid_properties = 0;

    foreach ($properties as $property) {
        $paid = $property['amount_paid'] ?? '0.00';
        $owed = $property['amount_owed'] ?? '0.00';
        $total_paid = bcadd($total_paid, $paid, 2);
        $total_unpaid = bcadd($total_unpaid, bcsub($owed, $paid, 2), 2);
        if ($property['payment_status'] === 'Paid') {
            $paid_properties++;
        } else {
            $unpaid_properties++;
        }
    }

    $percent_paid = $total_properties > 0 ? round(($paid_properties / $total_properties) * 100) : 0;
    $percent_unpaid = $total_properties > 0 ? round(($unpaid_properties / $total_properties) * 100) : 0;

    $response['summary'] = [
        'total_properties' => $total_properties,
        'total_paid' => $total_paid,
        'total_unpaid' => $total_unpaid,
        'paid_properties' => $paid_properties,
        'unpaid_properties' => $unpaid_properties,
        'percent_paid' => $percent_paid,
        'percent_unpaid' => $percent_unpaid
    ];

    // Calculate district-level data
    $district_data = [];
    foreach ($districts as $district) {
        $amounts = calculateDistrictAmountsController($district['district_id']);
        if ($amounts === false) {
            continue; // Skip districts with no data
        }

        $district_properties = array_filter($properties, function($prop) use ($district) {
            return $prop['district_id'] === $district['district_id'];
        });

        $district_paid_properties = count(array_filter($district_properties, function($prop) {
            return $prop['payment_status'] === 'Paid';
        }));

        $total_billed = $amounts['total_owed'];
        $paid = $amounts['total_paid'];
        $unpaid = bcsub($total_billed, $paid, 2);
        // Use bcdiv for precise percentage calculation
        $percent_paid = $total_billed !== '0.00' ? round(bcdiv($paid, $total_billed, 4) * 100, 2) : 0;

        $district_data[] = [
            'district_name' => $district['district_name'],
            'total_billed' => $total_billed,
            'paid' => $paid,
            'unpaid' => $unpaid,
            'percent_paid' => $percent_paid
        ];
    }

    $response['districts'] = $district_data;
    $response['success'] = true;
} catch (Exception $e) {
    $response['message'] = "Error fetching report data: " . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>