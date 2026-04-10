<?php

function readCustomers($filename) {
    if (!file_exists($filename)) return [];
    
    $customers = [];
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        $fields = explode(';', $line);
        if (count($fields) >= 12) {
            $customers[] = [
                'id' => $fields[0],
                'first_name' => $fields[1],
                'last_name' => $fields[2],
                'email' => $fields[3],
                'university' => $fields[4],
                'address' => $fields[5],
                'city' => $fields[6],
                'state' => $fields[7],
                'country' => $fields[8],
                'zip' => $fields[9],
                'phone' => $fields[10],
                'sales' => $fields[11]
            ];
        }
    }
    return $customers;
}

function readOrders($customer, $filename) {
    if (!file_exists($filename)) return [];
    
    $orders = [];
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        $fields = explode(',', $line);
        if (count($fields) >= 5 && $fields[1] == $customer['id']) {
            $orders[] = [
                'order_id' => $fields[0],
                'customer_id' => $fields[1],
                'isbn' => $fields[2],
                'title' => $fields[3],
                'category' => $fields[4]
            ];
        }
    }
    return $orders;
}

?>
