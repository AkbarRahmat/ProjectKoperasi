<?php
session_start();
require_once "./config/db.php";

if (!isset($_SESSION['username'])) {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}

// Fetch data from the database
$query = "SELECT * FROM anggota WHERE Status_Deleted = 0";

$result = mysqli_query($db_connect, $query);


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query_user_info = "SELECT ID_Anggota, Nama FROM anggota WHERE Username = '$username'";
    $result_user_info = mysqli_query($db_connect, $query_user_info);
    $user_info = mysqli_fetch_assoc($result_user_info);

    $idAnggota = $user_info['ID_Anggota'];
    $namaAnggota = $user_info['Nama'];

    $query_latest_loan = "SELECT Status FROM anggota WHERE ID_Anggota = '$idAnggota' ORDER BY Create_Date DESC LIMIT 1";
    $result_latest_loan = mysqli_query($db_connect, $query_latest_loan);
}else {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}
$result = mysqli_query($db_connect, $query);

$dataAnggota = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataAnggota, $row);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                            <th>Password</th>
                            <th>Status <br> Anggota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($dataAnggota as $row) :?>
                    <tr>
                        <td><?= $row['ID_Anggota'] ?></td>
                        <td><?= $row['Nama'] ?></td>
                        <td><?= $row['Alamat'] ?></td>
                        <td><?= $row['Tanggal_Lahir'] ?></td>
                        <td><?= $row['NIK'] ?></td>
                        <td><?= $row['Gender'] ?></td>
                        <td><?= $row['No_Telepon'] ?></td>
                        <td><?= $row['Email'] ?></td>
                        <td><?= $row['Password'] ?></td>
                        <td><?= $row['Status'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['ID_Anggota'] ?>">
                            Edit
                            </button> |<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['ID_Anggota'] ?>">
                            Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
                </table>
            </div>
            <!-- edit -->
             <div>
             <?php foreach ($dataAnggota as $row) : ?>
             <div class="modal fade" id="editModal<?= $row['ID_Anggota'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                     <div class="modal-header">
                         <h1 class="modal-title fs-5" id="editModal<?= $row['ID_Anggota'] ?>">Pinjam</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                            <form method="POST" action="aksi_dataAnggota.php">
                            <table>
                                <tr>
                                    <td>ID Anggota:</td>
                                    <td><input type="number" name="ID_Anggota" value="<?= $row['ID_Anggota']?>" required></td>
                                </tr>
                                <tr>
                                    <td>Nama:</td>
                                    <td><input type="text" name="Nama" value="<?= $row['Nama']?>" required></td>
                                </tr>
                                <tr>
                                    <td>Alamat:</td>
                                    <td><input type="text" name="Alamat" value="<?= $row['Alamat']?>" required></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir:</td>
                                    <td><input type="date" name="Tanggal_Lahir" value="<?= $row['Tanggal_Lahir'] ?>" required></td>
                                </tr>
                                <tr>
                                    <td>NIK:</td>
                                    <td><input type="text" name="NIK" value="<?= $row['NIK'] ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td>
                                        <select name="Gender" required>
                                            <option <?= atOption($row['Gender'], "Laki-laki")  ?>>Laki-laki</option>
                                            <option <?= atOption($row['Gender'], "Perempuan") ?>>Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No Telepon:</td>
                                    <td><input type="text" name="No_Telepon" value="<?= $row['No_Telepon']?>" required></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><input type="text" name="Email" value="<?= $row['Email'] ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Password:</td>
                                    <td><input type="text" name="Password" value="<?= $row['Password'] ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Status Anggota:</td>
                                    <td>
                                        <select name="Status" required>
                                            <option <?= atOption($row['Status'],'Aktif') ?>>Aktif</option>
                                            <option <?= atOption($row['Status'],'Non-Aktif') ?>>Non Aktif</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="bedit">Edit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                 </div>
                        </form>
                     </div>
                 </div>
             </div>
              <!-- modal delete --> 
         <div class="modal fade" id="deleteModal<?= $row['ID_Anggota'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="deleteModal<?= $row['ID_Anggota'] ?>">Modal title</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <form action="aksi_dataAnggota.php" method="POST">
                 <div>
                     <input type="hidden" name="ID_Anggota" value="<?= $row['ID_Anggota'] ?>">
                 </div>
                 <div class="modal-body">
                         Apakah anda yakin menghapus data pinjaman? 
                 </div>
                 <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="bhapus">Hapus</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                 </form>
                 </div>
                   
                </div>
             </div>
             <?php endforeach; ?>
         </div>
        </div>
    </div>
                    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })

    </script>
</body>
</html>
<?php
function atOption($status, $value) {
    $attrib = ($status == $value) ? "selected" : "";
    return "value='$value' $attrib";
}


mysqli_close($db_connect);
?>