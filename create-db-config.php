<?php
$data = json_decode(file_get_contents("php://input"));
$fw=fopen("db-config.php",'w',true);
fwrite( $fw, "<?php
\$host = \"$data->hostname\";
\$user = \"$data->hostuser\";
\$password = \"$data->hostpass\";
\$database = \"$data->dbname\";
");
fclose($fw);