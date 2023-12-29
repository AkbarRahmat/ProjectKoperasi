<?php
session_start();
require_once "./config/db.php";

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_SESSION["email"])) {
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];
    ?>

    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'>
        <title>User Profile</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css'>
        <style>
            body {
                display: flex;
                flex-direction: row;
            }
        </style>
    </head>

    <body>
        <?php require_once "./component/sidebar.php";
         Sidebar::selection("dashboard"); ?>

        <div>
            <h1>Selamat datang di profil</h1>
            <p>Username: <?= $username ?></p>
            <p>Role: <?= $role ?></p>

            <?php
            if ($role == 'admin') {
                $queryTotalPinjaman = "SELECT SUM(Jumlah_Pinjaman) as total_pinjaman FROM pinjaman";
                $resultTotalPinjaman = mysqli_query($db_connect, $queryTotalPinjaman);
                $rowTotalPinjaman = mysqli_fetch_assoc($resultTotalPinjaman);
                $totalPinjamanSeluruhAnggota = $rowTotalPinjaman['total_pinjaman'];

                $queryTotalSimpanan = "SELECT SUM(Jumlah_Simpanan) as total_simpanan FROM simpanan";
                $resultTotalSimpanan = mysqli_query($db_connect, $queryTotalSimpanan);
                $rowTotalSimpanan = mysqli_fetch_assoc($resultTotalSimpanan);
                $totalSimpananSeluruhAnggota = $rowTotalSimpanan['total_simpanan'];
                ?>

                <br>
                <p>Total Pinjaman Seluruh Anggota: <?= number_format($totalPinjamanSeluruhAnggota, 2) ?></p>
                <p>Total Simpanan Seluruh Anggota: <?= number_format($totalSimpananSeluruhAnggota, 2) ?></p>
                <br>

            <?php } else {
                $queryTotalPinjamanUser = "SELECT SUM(Jumlah_Pinjaman) as total_pinjaman_user FROM pinjaman WHERE Nama_Anggota = '$username'";
                $resultTotalPinjamanUser = mysqli_query($db_connect, $queryTotalPinjamanUser);
                $rowTotalPinjamanUser = mysqli_fetch_assoc($resultTotalPinjamanUser);
                $totalPinjamanUser = $rowTotalPinjamanUser['total_pinjaman_user'];

                $queryTotalSimpananUser = "SELECT SUM(Jumlah_Simpanan) as total_simpanan_user FROM simpanan WHERE Nama_Anggota = '$username'";
                $resultTotalSimpananUser = mysqli_query($db_connect, $queryTotalSimpananUser);
                $rowTotalSimpananUser = mysqli_fetch_assoc($resultTotalSimpananUser);
                $totalSimpananUser = $rowTotalSimpananUser['total_simpanan_user'];
                ?>

                <p>Total Pinjaman Anda: <?= number_format($totalPinjamanUser, 2) ?></p>
                <p>Total Simpanan Anda: <?= number_format($totalSimpananUser, 2) ?></p>
                <br>

            <?php } ?>

            <a href='simpanan.php'>Simpanan</a><br>
            <a href='pembayaran_pinjaman.php'>Pembayaran Pinjaman</a><br>
            <br>
            <a href='./backend/logout.php'>Logout</a>
        </div>
    </body>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>
    <script src='sidebar.js'></script>

    </html>

<?php
} else {
    header("Location: ./login.php");
    exit();
}
?>
