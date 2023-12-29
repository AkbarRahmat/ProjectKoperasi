<?php
session_start();
require_once "./config/db.php";

$idSimpanan = $_GET['id'];
 
$query = "DELETE FROM simpanan WHERE ID_Simpanan='$idSimpanan'";
mysqli_query($db_connect, $query);

header("Location: simpanan.php");
exit();
?>
