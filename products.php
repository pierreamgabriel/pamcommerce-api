<?php

require_once 'db-config.php';

$data = json_decode(file_get_contents("php://input"));
$task = $data->task;
$image1 = $data->images[0];
$image2 = $data->images[1];
$image3 = $data->images[2];
$image4 = $data->images[3];
$image5 = $data->images[4];

try {
    $db_conn = mysqli_connect($host, $user, $password, $database);
    if ($task == 'add' && $db_conn) {
        try {
            $sql_insert_product = "INSERT INTO products (name, price, promo_price, quantity,
            max_quantity, description, image_1, image_2, image_3, image_4, image_5)
VALUES ('$data->name', '$data->price', '$data->promoprice', '$data->quantity', '$data->max',
'$data->description', '$image1', '$image2', '$image3', '$image4', '$image5')";
            $db_conn->query($sql_insert_product);
        } catch (mysqli_sql_exception $e) {
            echo json_encode(["error" => true, "msg" => $e]);
        }
    }
} catch (mysqli_sql_exception $e) {
    echo json_encode(["error" => true, "msg" => $e]);
}
