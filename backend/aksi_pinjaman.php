<?php

include "../config/db.php";

if(isset($_POST['bpinjam'])){
    $idAnggota = $_POST['ID_Anggota'];
    $namaAnggota = $_POST['Nama_Anggota'];
    $jumlahPinjaman = $_POST['Jumlah_Pinjaman'];
    $tanggalPinjaman = $_POST['Tanggal_Pinjaman'];
    
    $query_wajib_simpanan = "SELECT * FROM simpanan WHERE ID_Anggota = '$idAnggota' AND Jenis_Simpanan = 'Wajib' LIMIT 1";
    $result_wajib_simpanan = mysqli_query($db_connect, $query_wajib_simpanan);
    $data_wajib_simpanan = mysqli_fetch_assoc($result_wajib_simpanan);
    
    $queryTotalSimpananUser = "SELECT SUM(Jumlah_Simpanan) as total_simpanan_user FROM simpanan WHERE ID_Anggota = '$idAnggota'";
    $resultTotalSimpananUser = mysqli_query($db_connect, $queryTotalSimpananUser);
    $rowTotalSimpananUser = mysqli_fetch_assoc($resultTotalSimpananUser);
    $totalSimpananUser = $rowTotalSimpananUser['total_simpanan_user'];
    
    if ($totalSimpananUser <= 75000 ){
        $totalSimpananUser = $totalSimpananUser - $jumlahPinjaman;
        echo "<script>
        alert('Lakukan simpanan wajib dengan nominal Rp 75000!');
        document.location='../pinjaman.php';
        </script>";
        die;

    }   if(!$tanggalPinjaman){
        echo "<script>
        alert('Pinjaman anda berhasil!');
        document.location='../pinjaman.php';
        </script>";
        die;
    }

    if (!$data_wajib_simpanan){
        echo "<script>
        alert('Lakukan simpanan wajib terlebih dahulu!');
        document.location='../pinjaman.php';
        </script>";
    }else {
        $query = "INSERT INTO `pinjaman` (ID_Anggota, Nama_Anggota, Jumlah_Pinjaman, Tanggal_Pinjaman) VALUES ('$idAnggota', '$namaAnggota', '$jumlahPinjaman', '$tanggalPinjaman')";

    $berhasil = mysqli_query($db_connect, $query);
        echo "<script>
        alert('Pinjaman anda berhasil!');
        document.location='../pinjaman.php';
        </script>";
    }
 
}
// $query_enum = "SHOW COLUMNS FROM pinjaman LIKE 'Status'";
// $result_enum = mysqli_query($db_connect, $query_enum);
// $row_enum = mysqli_fetch_assoc($result_enum);
// $enum_values = explode("','", substr($row_enum['Type'], 6, -2));

if(isset($_POST['bedit'])){

    $idPinjamanToEdit = $_POST['ID_Pinjaman'];
    $idAnggota = $_POST['ID_Anggota'];
    $namaAnggota = $_POST['Nama_Anggota'];
    $jumlahPinjaman = $_POST['Jumlah_Pinjaman'];
    $tanggalPinjaman = $_POST['Tanggal_Pinjaman'];
    $status = $_POST['Status'];

    $query = "UPDATE pinjaman SET ID_Anggota = '$idAnggota', Nama_Anggota = '$namaAnggota', Jumlah_Pinjaman = '$jumlahPinjaman', Tanggal_Pinjaman = '$tanggalPinjaman', Status = '$status' WHERE ID_Pinjaman = '$idPinjamanToEdit'";

    $resultEditPinjaman = mysqli_query($db_connect, $query);
    if (!$resultEditPinjaman){die;}

}


if(isset($_POST['bhapus'])){
    $idPinjaman = $_POST['ID_Pinjaman'];
    $queryDeletePinjaman = "UPDATE pinjaman SET Status_Deleted = 1 WHERE ID_Pinjaman = '$idPinjaman'";
    $hapus = mysqli_query($db_connect, $queryDeletePinjaman);
 
    if(!$hapus){
        echo "<script>
        alert('Hapus data gagal!');
        document.location='../pinjaman.php';
        </script>";
    }else{
        $queryTotalPinjaman = "SELECT SUM(Jumlah_Pinjaman) as total_pinjaman FROM pinjaman";
        $resultTotalPinjaman = mysqli_query($db_connect, $queryTotalPinjaman);
        $rowTotalPinjaman = mysqli_fetch_assoc($resultTotalPinjaman);
        $totalPinjamanSeluruhAnggota = $rowTotalPinjaman['total_pinjaman'];
    
        // Simpan total pinjaman dalam session
        $_SESSION['totalPinjamanSeluruhAnggota'] = $totalPinjamanSeluruhAnggota;
        echo "<script>
        alert('Hapus data berhasil!');
        document.location='../pinjaman.php';
        </script>";
    }
}

header("Location:../pinjaman.php");
?>
