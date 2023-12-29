<?php
session_start();
require_once "../config/db.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $nama = $_POST["nama"];
    $nik = $_POST["nik"];
    $alamat = $_POST["alamat"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $gender = $_POST["gender"];
    $no_telepon = $_POST["no_telepon"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    $sql = "INSERT INTO anggota (Nama, NIK, Alamat, Tanggal_Lahir, Gender, No_Telepon, email, Username, Password, Create_Date, Status)
            VALUES ('$nama', '$nik', '$alamat', '$tanggal_lahir', '$gender', '$no_telepon', '$email', '$username', '$password', NOW(), 'Aktif')";
 
    $result = mysqli_query($db_connect, $sql);

    if ($result) {
        echo "Registration successful!<br>";
        header("Location: ./../login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db_connect);
    }
}
 
mysqli_close($db_connect);
?>
