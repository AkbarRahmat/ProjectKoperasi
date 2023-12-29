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
        die;
    }
    if($jenisSimpanan === 'Wajib' && $jumlahSimpanan < 75000){
        echo "<script>alert('Jumlah Simpanan Wajib minimal adalah 75000');
        document.location='simpanan.php';
        </script>";
        die;
    
    }
    if ($jenisSimpanan === 'Pokok' && $jumlahSimpanan < 20000) {
        echo "<script>alert('Jumlah Simpanan Pokok minimal adalah 20000');
        document.location='simpanan.php';
        </script>";
        
    }
    else{
        $simpan ;
        echo "<script>
        alert('Simpanan anda berhasil');
        document.location='simpanan.php';
        </script>";
    }



}

if(isset($_POST['bedit'])){

    $idSimpananToEdit = $_POST['ID_Simpanan'];
    $idAnggota = $_POST['ID_Anggota'];
    $namaAnggota = $_POST['Nama_Anggota'];
    $jumlahSimpanan = $_POST['Jumlah_Simpanan'];
    $tanggalSimpanan = $_POST['Tanggal_Simpanan'];
    $jSimpanan = $_POST['Jenis_Simpanan'];

    $query = "UPDATE simpanan SET ID_Anggota = '$idAnggota', Nama_Anggota = '$namaAnggota', Jumlah_Simpanan = '$jumlahSimpanan', Tanggal_Simpanan = '$tanggalSimpanan', Jenis_Simpanan = '$jSimpanan' WHERE ID_Simpanan = '$idSimpananToEdit'";

    $resultEditSimpanan = mysqli_query($db_connect, $query);
    if (!$resultEditSimpanan){die;
    }

}
if(isset($_POST['bhapus'])){
    $idSimpanan = $_POST['ID_Simpanan'];
    $queryDeleteSimpanan = "UPDATE simpanan SET Status_Deleted = 1 WHERE ID_Simpanan = '$idSimpanan'";
    $hapus = mysqli_query($db_connect, $queryDeleteSimpanan);
 
    if(!$hapus){
        echo "<script>
        alert('Hapus data gagal!');
        document.location='simpanan.php';
        </script>";
    }else{
        $queryTotalSimpanan = "SELECT SUM(Jumlah_Simpanan) as total_simpanan FROM simpanan";
        $resultTotalSimpanan = mysqli_query($db_connect, $queryTotalSimpanan);
        $rowTotalSimpanan = mysqli_fetch_assoc($resultTotalSimpanan);
        $totalSimpananSeluruhAnggota = $rowTotalSimpanan['total_simpanan'];
    
        // Simpan total pinjaman dalam session
        $_SESSION['totalSimpananSeluruhAnggota'] = $totalSimpananSeluruhAnggota;
        echo "<script>
        alert('Hapus data berhasil!');
        document.location='simpanan.php';
        </script>";
    }
}

header("Location:simpanan.php");
?>