<?php
session_start();
require_once "./config/db.php";

$idAnggotaToEdit = '';

if (isset($_GET['id'])) {
    $idAnggotaToEdit = $_GET['id'];

    $query_edit = "SELECT * FROM anggota WHERE ID_Anggota = '$idAnggotaToEdit'";
    $result_edit = mysqli_query($db_connect, $query_edit);

    if ($row_edit = mysqli_fetch_assoc($result_edit)) {
        $initialIdAnggota = $row_edit['ID_Anggota'];
        $initialNama = $row_edit['Nama'];
        $initialAlamat = $row_edit['Alamat'];
        $initialTanggalLahir = $row_edit['Tanggal_Lahir'];
        $initialNIK = $row_edit['NIK'];
        $initialGender = $row_edit['Gender'];
        $initialNoTelepon = $row_edit['No_Telepon'];
        $initialEmail = $row_edit['Email'];
        $initialStatusAnggota = $row_edit['Status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAnggota = $_POST['idAnggota'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $nik = $_POST['nik'];
    $gender = $_POST['gender'];
    $noTelepon = $_POST['noTelepon'];
    $email = $_POST['email'];
    $statusAnggota = $_POST['statusAnggota'];

    if (!empty($idAnggotaToEdit)) {
        $query = "UPDATE anggota SET ID_Anggota = '$idAnggota',Nama = '$nama', Alamat = '$alamat', Tanggal_Lahir = '$tanggalLahir', NIK = '$nik', Gender = '$gender', No_Telepon = '$noTelepon', Email = '$email', Status = '$statusAnggota' WHERE ID_Anggota = '$idAnggotaToEdit'";
    } else {
        $query = "INSERT INTO anggota (ID_Anggota, Nama, Alamat, Tanggal_Lahir, NIK, Gender, No_Telepon, Email, Status) VALUES ('$idAnggota', '$nama', '$alamat', '$tanggalLahir', '$nik', '$gender', '$noTelepon', '$email', '$statusAnggota')";
    }

    mysqli_query($db_connect, $query);

    header("Location: anggota.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (!empty($idAnggotaToEdit) ? 'Edit' : 'Tambah') ?> Data Anggota</title>
</head>
<body>
    <h2><?php echo (!empty($idAnggotaToEdit) ? 'Edit' : 'Tambah') ?> Data Anggota</h2>

    <form method="POST" action="">
        <table>
            <tr>
                <td>ID Anggota:</td>
                <td><input type="number" name="idAnggota" value="<?php echo (!empty($initialIdAnggota) ? $initialIdAnggota : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Nama:</td>
                <td><input type="text" name="nama" value="<?php echo (!empty($initialNama) ? $initialNama : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Alamat:</td>
                <td><input type="text" name="alamat" value="<?php echo (!empty($initialAlamat) ? $initialAlamat : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Tanggal Lahir:</td>
                <td><input type="date" name="tanggalLahir" value="<?php echo (!empty($initialTanggalLahir) ? $initialTanggalLahir : ''); ?>" required></td>
            </tr>
            <tr>
                <td>NIK:</td>
                <td><input type="text" name="nik" value="<?php echo (!empty($initialNIK) ? $initialNIK : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <select name="gender" required>
                        <option value="Laki-laki" <?php echo (!empty($initialGender) && $initialGender == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo (!empty($initialGender) && $initialGender == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>No Telepon:</td>
                <td><input type="text" name="noTelepon" value="<?php echo (!empty($initialNoTelepon) ? $initialNoTelepon : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" value="<?php echo (!empty($initialEmail) ? $initialEmail : ''); ?>" required></td>
            </tr>
            <tr>
                <td>Status Anggota:</td>
                <td>
                    <select name="statusAnggota" required>
                        <option value="Aktif" <?php echo (!empty($initialStatusAnggota) && $initialStatusAnggota == 'Aktif' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="Tidak Aktif" <?php echo (!empty($initialStatusAnggota) && $initialStatusAnggota == 'Tidak Aktif' ? 'selected' : ''); ?>>Tidak Aktif</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="<?php echo (!empty($idAnggotaToEdit) ? 'Update' : 'Tambah'); ?>"></td>
            </tr>
        </table>
    </form>

    <br>
    <a href="anggota.php">Kembali ke Data Anggota</a>
</body>
</html>
