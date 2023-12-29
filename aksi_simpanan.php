<?php 

include "./config/db.php";

if(isset($_POST['bsimpan'])){
    $idAnggota = $_POST['ID_Anggota'];
    $jumlahSimpanan = $_POST['Jumlah_Simpanan'];
    $tanggalSimpanan = $_POST['Tanggal_Simpanan'];
    $namaAnggota = $_POST['Nama_Anggota'];
    $jenisSimpanan = $_POST['Jenis_Simpanan'];
    
    $query = "INSERT INTO `simpanan` (`ID_Anggota`, `Jumlah_Simpanan`, `Tanggal_Simpanan`, `Nama_Anggota`, `Jenis_Simpanan`) 
    VALUES ('$idAnggota','$jumlahSimpanan','$tanggalSimpanan','$namaAnggota','$jenisSimpanan')";
    $simpan = mysqli_query($db_connect, $query);

    if(!$query){
        "<script>
        alert('isi terlebih dahulu nominal dan tanggalnya!');
        document.location='simpanan.php';
        </script>";
    }else{
        $berhasil = mysqli_query($db_connect, $query);
        echo "<script>
        alert('Simpanan anda berhasil');
        document.location='simpanan.php';
        </script>";
    }

}

?>