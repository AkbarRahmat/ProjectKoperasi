<?php
session_start();
require_once "./config/db.php";

$idSimpananToEdit = '';

if (isset($_GET['id'])) {
    $idSimpananToEdit = $_GET['id'];
    $jenisSimpananOptions = ['Pokok', 'Wajib', 'Sukarela'];

    $query_edit = "SELECT * FROM simpanan WHERE ID_Simpanan = '$idSimpananToEdit'";
    $result_edit = mysqli_query($db_connect, $query_edit);

    if ($row_edit = mysqli_fetch_assoc($result_edit)) {
        $initialIdAnggota = $row_edit['ID_Anggota'];
        $initialNamaAnggota = $row_edit['Nama_Anggota'];
        $initialJumlahSimpanan = $row_edit['Jumlah_Simpanan'];
        $initialTanggalSimpanan = $row_edit['Tanggal_Simpanan'];
        $initialJenisSimpanan = $row_edit['Jenis_Simpanan'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAnggota = $_POST['idAnggota'];
    $namaAnggota = $_POST['namaAnggota'];
    $jumlahSimpanan = $_POST['jumlahSimpanan'];
    $tanggalSimpanan = $_POST['tanggalSimpanan'];
    $jenisSimpanan = $_POST['jenisSimpanan']; 

    if (!empty($idSimpananToEdit)) {
        $query = "UPDATE simpanan SET ID_Anggota = '$idAnggota', Nama_Anggota = '$namaAnggota', Jumlah_Simpanan = '$jumlahSimpanan', Tanggal_Simpanan = '$tanggalSimpanan', Jenis_Simpanan = '$jenisSimpanan' WHERE ID_Simpanan = '$idSimpananToEdit'";
    } else {
        $query = "INSERT INTO simpanan (ID_Anggota, Nama_Anggota, Jumlah_Simpanan, Tanggal_Simpanan, Jenis_Simpanan) VALUES ('$idAnggota', '$namaAnggota', '$jumlahSimpanan', '$tanggalSimpanan', '$jenisSimpanan')";
    }

    mysqli_query($db_connect, $query);

    header("Location: simpanan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (!empty($idSimpananToEdit) ? 'Edit' : 'Tambah') ?> Data Simpanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css">
    <style>
        body{
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
    <h2><?php echo (!empty($idSimpananToEdit) ? 'Edit' : 'Tambah') ?> Data Simpanan</h2>

    <form method="POST" action="">
        <table>
            <tr>
                <td>ID Anggota:</td>
                <td><input type="text" name="idAnggota" value="<?php echo (!empty($initialIdAnggota) ? $initialIdAnggota : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Nama Anggota:</td>
                <td><input type="text" name="namaAnggota" value="<?php echo (!empty($initialNamaAnggota) ? $initialNamaAnggota : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Jumlah Simpanan:</td>
                <td><input type="text" name="jumlahSimpanan" value="<?php echo (!empty($initialJumlahSimpanan) ? $initialJumlahSimpanan : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Tanggal Simpanan:</td>
                <td><input type="date" name="tanggalSimpanan" value="<?php echo (!empty($initialTanggalSimpanan) ? $initialTanggalSimpanan : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Jenis Simpanan:</td>
                <td>
                    <select name="jenisSimpanan" required>
                        <?php foreach ($jenisSimpananOptions as $option): ?>
                            <option value="<?php echo $option; ?>" <?php echo (!empty($initialJenisSimpanan) && $initialJenisSimpanan === $option ? 'selected' : ''); ?>><?php echo $option; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="<?php echo (!empty($idSimpananToEdit) ? 'Update' : 'Tambah'); ?>"></td>
            </tr>
        </table>
    </form>
</body>
</html>
