<?php
// Retrieve the JSON order data from the HTTP POST request
$orderData = json_decode(file_get_contents('php://input'), true);

// Check if the order data was retrieved successfully
if (!$orderData) {
    // Send an error response back to the client
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(['message' => 'Error: could not retrieve order data.']);
    exit();
}

// Process and store the order data in a database
$query = $db->prepare('INSERT INTO shop_order (order_data) VALUES (:order_data)');

// Send a success response back to the client
header('Content-Type: application/json');
http_response_code(200);
echo json_encode(['message' => 'Order successfully processed.']);
exit();
?>