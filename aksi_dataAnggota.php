<?php

include "./config/db.php";

if (isset($_POST['bedit'])) {
    $idAnggota = $_POST['ID_Anggota'];
    $namaAnggota = $_POST['Nama'];
    $alamat = $_POST['Alamat'];
    $tanggalLahir = $_POST['Tanggal_Lahir'];
    $nik = $_POST['NIK'];
    $jenisKelamin = $_POST['Gender'];
    $noTelepon = $_POST['No_Telepon'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $status = $_POST['Status'];

    // Lakukan validasi input atau gunakan parameterisasi
    // ...

    // Pastikan nilai string diapit dengan benar
    $query = "UPDATE anggota SET Nama = '$namaAnggota', Alamat = '$alamat', Tanggal_Lahir = '$tanggalLahir', NIK = '$nik', Gender = '$jenisKelamin', No_Telepon = '$noTelepon', Email = '$email', Password = '$password', Status = '$status' WHERE ID_Anggota = '$idAnggota'";

    $resultEditAnggota = mysqli_query($db_connect, $query);

    if (!$resultEditAnggota) {
        // Tambahkan pesan kesalahan yang lebih deskriptif
        die("Error updating record: " . mysqli_error($db_connect));
    } else {
        echo "Record updated successfully";
    }
}
if(isset($_POST['bhapus'])){
    $idAnggota = $_POST['ID_Anggota'];
    $namaAnggota = $_POST['Nama'];
    $alamat = $_POST['Alamat'];
    $tanggalLahir = $_POST['Tanggal_Lahir'];
    $nik = $_POST['NIK'];
    $jenisKelamin = $_POST['Gender'];
    $noTelepon = $_POST['No_Telepon'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $status = $_POST['Status'];
}

?>
