<?php
session_start();
require_once "./config/db.php";

if (isset($_SESSION["email"])) {
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];
    include_once "./component/sidebar.php";
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <title>Dashboard</title>
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css">
        <link rel="stylesheet" href="./component/css/style-media.css">
        
        <style>
            .col-xl-3 {
                position: relative;
                width: 30%;
                height: 30%;
                padding-right: 0.75rem;
                padding-left: 0.75rem;
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #e3e6f0;
                border-radius: 0.35rem;
            }

            .border-left-primary {
                border-left: 0.25rem solid #4e73df !important;
            }
        </style>
    </head>

    <body>
        <?php Sidebar::selection("dashboard");


        if ($role == 'admin') {
            // Query untuk menghitung total pinjaman seluruh anggota dengan atribut Status_Deleted 0
            $queryTotalPinjaman = "SELECT SUM(Jumlah_Pinjaman) as total_pinjaman FROM pinjaman WHERE Status_Deleted = 0";
            $resultTotalPinjaman = mysqli_query($db_connect, $queryTotalPinjaman);
            $rowTotalPinjaman = mysqli_fetch_assoc($resultTotalPinjaman);
            $totalPinjamanSeluruhAnggota = $rowTotalPinjaman['total_pinjaman'];

            // Query untuk menghitung total simpanan seluruh anggota dengan atribut Status_Deleted 0
            $queryTotalSimpanan = "SELECT SUM(Jumlah_Simpanan) as total_simpanan FROM simpanan WHERE Status_Deleted = 0";
            $resultTotalSimpanan = mysqli_query($db_connect, $queryTotalSimpanan);
            $rowTotalSimpanan = mysqli_fetch_assoc($resultTotalSimpanan);
            $totalSimpananSeluruhAnggota = $rowTotalSimpanan['total_simpanan'];

            ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total pinjaman keseluruhan anggota
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp
                                    <?= number_format($totalPinjamanSeluruhAnggota, 2) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total simpanan keseluruhan anggota
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp
                                    <?= number_format($totalSimpananSeluruhAnggota, 2) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } elseif ($role == 'user') {
            //mengambil data user
            $query_user_info = "SELECT ID_Anggota, Nama FROM anggota WHERE Username = '$username'";
            $result_user_info = mysqli_query($db_connect, $query_user_info);
            $user_info = mysqli_fetch_assoc($result_user_info);
            $idAnggota = $user_info['ID_Anggota'];
            // Query untuk menghitung total pinjaman user yang sedang login
            $queryTotalPinjamanUser = "SELECT SUM(Jumlah_Pinjaman) as total_pinjaman_user FROM pinjaman WHERE ID_Anggota = '$idAnggota' AND Status_Deleted = 0";
            $resultTotalPinjamanUser = mysqli_query($db_connect, $queryTotalPinjamanUser);
            $rowTotalPinjamanUser = mysqli_fetch_assoc($resultTotalPinjamanUser);
            $totalPinjamanUser = $rowTotalPinjamanUser['total_pinjaman_user'];

            // Query untuk menghitung total simpanan user yang sedang login
            $queryTotalSimpananUser = "SELECT SUM(Jumlah_Simpanan) as total_simpanan_user FROM simpanan WHERE ID_Anggota = '$idAnggota' AND Status_Deleted = 0";
            $resultTotalSimpananUser = mysqli_query($db_connect, $queryTotalSimpananUser);
            $rowTotalSimpananUser = mysqli_fetch_assoc($resultTotalSimpananUser);
            $totalSimpananUser = $rowTotalSimpananUser['total_simpanan_user'];
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total pinjaman Anda
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp
                                    <?= number_format($totalPinjamanUser, 2) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total simpanan Anda
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp
                                    <?= number_format($totalSimpananUser, 2) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <script src="sidebar.js"></script>
        </body>

        </html>

        </html>
        <?php
        }
} else {
    header("Location: ./login.php");
    exit();
}
?>