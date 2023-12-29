<?php
session_start();
require_once "./config/db.php";

$idAnggota = $_GET['id'];
 
$query = "DELETE FROM anggota WHERE ID_Anggota='$idAnggota'";
mysqli_query($db_connect, $query);

header("Location: anggota.php");
exit();
?>
