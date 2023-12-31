<?php
session_start();
require_once "./config/db.php";

if (!isset($_SESSION['username'])) {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}
// Get the username and role of the logged-in user
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Fetch user-specific data
$query_user_info = "SELECT ID_Anggota, Nama FROM anggota WHERE Username = '$username'";
$result_user_info = mysqli_query($db_connect, $query_user_info);
$user_info = mysqli_fetch_assoc($result_user_info);
$idAnggota = $user_info['ID_Anggota'];
// Query to fetch pinjaman data based on user role
if ($role === 'admin') {
    $query = "SELECT * FROM simpanan WHERE Status_Deleted = 0";
} else {
    $query = "SELECT * FROM simpanan WHERE Status_Deleted = 0 AND ID_Anggota = '$idAnggota' ORDER BY Tanggal_Simpanan DESC";
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query_user_info = "SELECT ID_Anggota, Nama FROM anggota WHERE Username = '$username'";
    $result_user_info = mysqli_query($db_connect, $query_user_info);
    $user_info = mysqli_fetch_assoc($result_user_info);
    $idAnggota = $user_info['ID_Anggota'];
    $namaAnggota = $user_info['Nama'];

    // Check if the latest loan is paid
    $query_latest_loan = "SELECT Jenis_Simpanan FROM simpanan WHERE ID_Anggota = '$idAnggota' ORDER BY Tanggal_Simpanan DESC LIMIT 1";
    $result_latest_loan = mysqli_query($db_connect, $query_latest_loan);



    // skip
} else {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}
$result = mysqli_query($db_connect, $query);

$dataSimpanan = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataSimpanan, $row);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Simpanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./component/css/style-media.css">
</head>

<body>
    <header>
        <h1>Koperasi <span>Wiatakarya Sejahtera</span></h1>
    </header>
    <main>
    <?php require_once "./component/sidebar.php";
    Sidebar::selection("simpanan"); ?>

    <div class="container">
        <h2>Data Simpanan</h2>
        <div class="card shadow mb-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID Simpanan</th>
                        <th>ID Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Jumlah Simpanan</th>
                        <th>Tanggal Simpanan</th>
                        <th>Jenis Simpanan</th>
                        <?php if ($role === 'admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>

                    <?php foreach ($dataSimpanan as $row): ?>
                        <tr>
                            <td>
                                <?= $row['ID_Simpanan'] ?>
                            </td>
                            <td>
                                <?= $row['ID_Anggota'] ?>
                            </td>
                            <td>
                                <?= $row['Nama_Anggota'] ?>
                            </td>
                            <td> Rp
                                <?= $row['Jumlah_Simpanan'] ?>
                            </td>
                            <td>
                                <?= $row['Tanggal_Simpanan'] ?>
                            </td>
                            <td>
                                <?= $row['Jenis_Simpanan'] ?>
                            </td>

                            <?php if ($role === 'admin'): ?>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editSimpan<?= $row['ID_Simpanan'] ?>">
                                        <i class="ri-pencil-line"></i>
                                    </button>  
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?= $row['ID_Simpanan'] ?>">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
            <div>
                <?php foreach ($dataSimpanan as $row): ?>
                    <div class="modal fade" id="editSimpan<?= $row['ID_Simpanan'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editSimpan<?= $row['ID_Simpanan'] ?>">Simpan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="./backend/aksi_simpanan.php">
                                    <input type="hidden" name="ID_Simpanan" value="<?= $row['ID_Simpanan'] ?>">
                                    <input type="hidden" name="ID_Anggota" value="<?= $row['ID_Anggota'] ?>">
                                    <input type="hidden" name="Nama_Anggota" value="<?= $row['Nama_Anggota'] ?>">
                                    
                                    <div class="col-md-10 mx-auto p-2">
                                        <label class="form-label">Jumlah Simpanan:</label>
                                        <input type="number" class="form-control" name="Jumlah_Simpanan"
                                            value="<?= $row['Jumlah_Simpanan'] ?>" required>
                                    </div>
                                    <div class="col-md-10 mx-auto p-2">
                                        <label class="form-label">Tanggal Simpanan:</label>
                                        <input type="date" class="form-control" name="Tanggal_Simpanan"
                                            value="<?= $row['Tanggal_Simpanan'] ?>" required>
                                    </div>

                                    <div class="col-md-10 mx-auto p-2">
                                        <label class="form-label">Status Simpanan:</label>
                                        <select class="form-select" name="Jenis_Simpanan">
                                            <option <?= atOption($row['Jenis_Simpanan'], "Pokok") ?>>Pokok</option>
                                            <option <?= atOption($row['Jenis_Simpanan'], "Sukarela") ?>>Sukarela</option>
                                            <option <?= atOption($row['Jenis_Simpanan'], "Wajib") ?>>Wajib</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bedit">edit</button>
                                        <button type="button" class="btn btn-danger"data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- modal delete -->

                    <div class="modal fade" id="deleteModal<?= $row['ID_Simpanan'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModal<?= $row['ID_Simpanan'] ?>">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="./backend/aksi_simpanan.php" method="POST">
                                    <div>
                                        <input type="hidden" name="ID_Simpanan" value="<?= $row['ID_Simpanan'] ?>">
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin menghapus data pinjaman?

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                                            name="bhapus">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($role === 'user'): ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Simpanan
                </button>

                <!-- Modal tambah simpanan -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Simpanan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="./backend/aksi_simpanan.php">
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td>ID Anggota:</td>
                                            <td>
                                                <input type="text" name="ID_Anggota" value="<?php echo $idAnggota; ?>"
                                                    readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Anggota:</td>
                                            <td>
                                                <input type="text" name="Nama_Anggota" value="<?php echo $namaAnggota; ?>"
                                                    readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Simpanan:</td>
                                            <td>Rp<input type="number" name="Jumlah_Simpanan" required></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Simpanan:</td>
                                            <td><input type="date" name="Tanggal_Simpanan" required></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Simpanan:</td>
                                            <td>
                                                <select name="Jenis_Simpanan" required>
                                                    <option disabled selected>Pilih jenis simpanan anda</option>
                                                    <option value="Pokok">Simpanan Pokok</option>
                                                    <option value="Wajib">Simpanan Wajib</option>
                                                    <option value="Sukarela">Simpanan Sukarela</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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
    </main>
</body>

</html>

<?php

function atOption($jsimpanan, $value)
{
    $attrib = ($jsimpanan == $value) ? "selected" : "";
    return "value='$value' $attrib";
}
mysqli_close($db_connect);
?>