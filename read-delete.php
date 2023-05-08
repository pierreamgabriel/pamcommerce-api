<?php

require_once 'db-config.php';

$data = json_decode(file_get_contents("php://input"));
$table = $data->table;
$task = $data->task;

if ($task == 'read') {

    try {
        $db_conn = mysqli_connect($host, $user, $password, $database);
        $allData = mysqli_query($db_conn, "SELECT * FROM `$table`");
        $all_data = mysqli_fetch_all($allData, MYSQLI_ASSOC);
        echo json_encode(["error" => false, "all_data" => $all_data]);
        } catch (mysqli_sql_exception $e) {
        echo json_encode(["error" => true, "msg" => $e]);
        }

} elseif ($task == 'delete') {

    try {
        $db_conn = mysqli_connect($host, $user, $password, $database);
        $id = $data->id;
        $delete = mysqli_query($db_conn, "DELETE FROM `$table` WHERE `id`='$id'");
        echo json_encode(["error" => false]);
        } catch (mysqli_sql_exception $e) {
        echo json_encode(["error" => true, "msg" => $e]);
        }
}
