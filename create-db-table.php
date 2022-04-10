<?php
require 'db-config.php';

$data = json_decode(file_get_contents("php://input"));

$site_name = $data->sitename;
$site_email = $data->email;
$site_password = $data->password;
$language = $data->language;

try {
	
$db_conn = mysqli_connect($host,$user,$password,$database);
$sql_table = "
CREATE TABLE IF NOT EXISTS `settings` (
	`id` INT(6) NOT NULL AUTO_INCREMENT,
	`sitename` VARCHAR(30) NOT NULL,
	`lang` VARCHAR(10) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `admin_users` (
	`id` INT(6) NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(50) NOT NULL,
	`password` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `products` (
	`id` INT(9) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`price` INT(9) NOT NULL,
	`promo_price` INT(9),
	`quantity` INT(9),
	`max_quantity` INT(9),
	`description` VARCHAR(5000),
	`image_1` VARCHAR(256),
	`image_2` VARCHAR(256),
	`image_3` VARCHAR(256),
	`image_4` VARCHAR(256),
	`image_5` VARCHAR(256),
	`sales` INT(9),
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;
";
mysqli_multi_query($db_conn, $sql_table);
while(mysqli_more_results($db_conn))
{
   mysqli_next_result($db_conn);
}
try {
	
$sql_insert_user = "INSERT INTO admin_users (email, password)
VALUES ('$site_email', '$site_password')";
$sql_insert_site = "INSERT INTO settings (sitename, lang)
VALUES ('$site_name', '$language')";	
$db_conn->query($sql_insert_user);
$db_conn->query($sql_insert_site);
	
} catch(mysqli_sql_exception $e){
  echo json_encode(["error" => true, "msg" => $e]);	
}	
} catch(mysqli_sql_exception $e) {
  echo json_encode(["error" => true, "msg" => $e]);	
}

?>