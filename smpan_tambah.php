<?php
session_start();
require_once "./config/db.php";

// Assuming the user is logged in, get the username and retrieve corresponding ID Anggota and Nama
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query_user_info = "SELECT ID_Anggota, Nama FROM anggota WHERE Username = '$username'";
    $result_user_info = mysqli_query($db_connect, $query_user_info);
    $user_info = mysqli_fetch_assoc($result_user_info);

    $idAnggota = $user_info['ID_Anggota'];
    $namaAnggota = $user_info['Nama'];
} else {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming the user is logged in, use the retrieved ID Anggota and Nama
    $idAnggota = $user_info['ID_Anggota'];
    $namaAnggota = $user_info['Nama'];

    $jumlahSimpanan = $_POST['jumlahSimpanan'];
    $tanggalSimpanan = $_POST['tanggalSimpanan'];
    $jenisSimpanan = $_POST['jenisSimpanan']; // Menambah field jenisSimpanan

    // Cek jika jenis simpanan adalah "Simpanan Wajib" dan jumlah simpanan kurang dari 45 ribu
    if ($jenisSimpanan === 'Wajib' && $jumlahSimpanan < 75000) {
        echo "<script>alert('Jumlah Simpanan Wajib minimal adalah 75 ribu.');</script>";
    } 
    elseif ($jenisSimpanan === 'Pokok' && $jumlahSimpanan < 20000) {
        echo "<script>alert('Jumlah Simpanan Pokok minimal adalah 20 ribu.');</script>";
    } else {
        $query = "INSERT INTO simpanan (ID_Anggota, Nama_Anggota, Jumlah_Simpanan, Tanggal_Simpanan, Jenis_Simpanan) VALUES ('$idAnggota', '$namaAnggota', '$jumlahSimpanan', '$tanggalSimpanan', '$jenisSimpanan')";
        mysqli_query($db_connect, $query);

        header("Location: simpanan.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Simpanan</title>
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
    <h2>Tambah Data Simpanan</h2>

    <form method="POST" action="">
        <table>
            <tr>
                <td>ID Anggota:</td>
                <td>
                    <input type="text" name="idAnggota" value="<?php echo $idAnggota; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Nama Anggota:</td>
                <td>
                    <input type="text" name="namaAnggota" value="<?php echo $namaAnggota; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Jumlah Simpanan:</td>
                <td><input type="text" name="jumlahSimpanan" required></td>
            </tr>
            <tr>
                <td>Tanggal Simpanan:</td>
                <td><input type="date" name="tanggalSimpanan" required></td>
            </tr>
            <tr>
                <td>Jenis Simpanan:</td>
                <td>
                    <select name="jenisSimpanan" required>
                        <option disabled selected>Pilih jenis simpanan anda</option>
                        <option value="Pokok">Simpanan Pokok</option>
                        <option value="Wajib">Simpanan Wajib</option>
                        <option value="Sukarela">Simpanan Sukarela</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
    <br>
    <a href="simpanan.php">Kembali ke Data Simpanan</a>
</body>
</html>
