<?php
session_start();
require_once "./config/db.php";

// Fetch data from the database
$query_anggota = "SELECT * FROM anggota";
$result_anggota = mysqli_query($db_connect, $query_anggota);
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <style>
        body {
            display: flex;
            flex-direction: row;
                }
        .container{
            display:inline-block
        }
    </style>
</head>
<body>
    <?php
    require_once"./component/sidebar.php";
    Sidebar::selection("anggota") ?>
    
    <div class="container">
    <h2>Data Anggota</h2>
        <div class="card shadow mb-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Anggota</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>NIK</th>
                            <th>Gender</th>
                            <th>Nomor <br> Telepon</th>
                            <th>Email</th>
                            <th>Status <br> Anggota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row_anggota = mysqli_fetch_assoc($result_anggota)) {
                            echo "<tr>";
                            echo "<td>{$row_anggota['ID_Anggota']}</td>";
                            echo "<td>{$row_anggota['Nama']}</td>";
                            echo "<td>{$row_anggota['Alamat']}</td>";
                            echo "<td>{$row_anggota['Tanggal_Lahir']}</td>";
                            echo "<td>{$row_anggota['NIK']}</td>";
                            echo "<td>{$row_anggota['Gender']}</td>";
                            echo "<td>{$row_anggota['No_Telepon']}</td>";
                            echo "<td>{$row_anggota['Email']}</td>";
                            echo "<td>{$row_anggota['Status']}</td>";
                            echo "<td><a href='angg_edit.php?id={$row_anggota['ID_Anggota']}'>Edit</a> | <a href='angg_hapus.php?id={$row_anggota['ID_Anggota']}'>Hapus</a></td>"; 
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>

    <?php
    mysqli_close($db_connect);
    ?>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</html>
