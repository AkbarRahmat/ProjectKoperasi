<?php
session_start();
require_once "./config/db.php";

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_SESSION["email"])) {
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];

    $queryUserData = "SELECT * FROM anggota WHERE Username = '$username'";
    $resultUserData = mysqli_query($db_connect, $queryUserData);
    $userData = mysqli_fetch_assoc($resultUserData);
?>

    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'>
        <title>User Profile</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css'>
        <link rel="stylesheet" href="./component/css/style-profile.css">
    </head>

    <body>
        <header>        
            <h1>Koperasi <span>Wiatakarya Sejahtera</span></h1>
        </header>

        <main>
            <?php require_once "./component/sidebar.php";
            Sidebar::selection("dashboard"); ?>

            <div class="container">
                <h2>Profile</h2>
                <div class="card shadow mb-4">
                    <table>
                        <tr>
                            <td>Username</td>
                            <td> : </td>
                            <td><?= $userData['Username'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td> : </td>
                            <td><?= $userData['Nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td> : </td>
                            <td><?= $userData['Alamat'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td> : </td>
                            <td><?= $userData['Tanggal_Lahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> : </td>
                            <td><?= $userData['Email'] ?></td>
                        </tr>
                    


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

                        <tr>
                            <td>Total Pinjaman Seluruh Anggota</td>
                            <td> : </td>
                            <td><?= number_format($totalPinjamanSeluruhAnggota, 2) ?></td>
                        </tr>

                        <tr>
                            <td>Total Simpanan Seluruh Anggota</td>
                            <td> : </td>
                            <td><?= number_format($totalSimpananSeluruhAnggota, 2) ?></td>
                        </tr>

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
                        <tr>
                            <td>Total Pinjaman Anda</td>
                            <td> : </td>
                            <td> <?= number_format($totalPinjamanUser, 2) ?></td>
                        </tr>

                        <tr>
                            <td>Total Simpanan Anda</td>
                            <td> : </td>
                            <td><?= number_format($totalSimpananUser, 2) ?></td>
                        </tr> 

                    <?php } ?>
                    </table>
                    <br>
                    <br> 
                    <div class="logout">
                        <a href='./backend/logout.php'>Log Out</a>
                    </div>
                </div>
            </div>
        </main>
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
