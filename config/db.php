<?php

$DB_HOST = 'localhost';
$DB_USER = 'koperasi';
$DB_PASSWORD = 'koperasidb';
$DB_NAME = 'koperasi';
$DB_PORT = 3306;

try{
$db_connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);
}catch(\Throwable $th){
    error_log($th->getMessage());
}
// if ($db_connect->connect_error) {
//     die("Failed to connect to MySQL: " . $db_connect->connect_error);
// }

?>
