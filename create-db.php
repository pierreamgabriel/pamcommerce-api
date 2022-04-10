<?php
require 'db-config.php';

try {
$db_create = mysqli_connect($host,$user,$password);	
$sql_create = "CREATE DATABASE IF NOT EXISTS $database";
$db_create->query($sql_create);	
} catch(mysqli_sql_exception $e) {
echo json_encode(["error" => true, "msg" => $e]);	
}
