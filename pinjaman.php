<?php
session_start();
require_once "./config/db.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}

// Get the username and role of the logged-in user
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$query_user_info = "SELECT ID_Anggota, Nama FROM anggota WHERE Username = '$username'";
$result_user_info = mysqli_query($db_connect, $query_user_info);
$user_info = mysqli_fetch_assoc($result_user_info);
$idAnggota = $user_info['ID_Anggota'];

// Query to fetch pinjaman data based on user role
if ($role === 'admin') {
    $query = "SELECT * FROM pinjaman WHERE Status_Deleted = 0";
} else {
    $query = "SELECT * FROM pinjaman WHERE Status_Deleted = 0 AND ID_Anggota = '$idAnggota'";
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query_user_info = "SELECT ID_Anggota, Nama FROM anggota WHERE Username = '$username'";
    $result_user_info = mysqli_query($db_connect, $query_user_info);
    $user_info = mysqli_fetch_assoc($result_user_info);

    $idAnggota = $user_info['ID_Anggota'];
    $namaAnggota = $user_info['Nama'];

    // Check if the latest loan is paid
    $query_latest_loan = "SELECT Status FROM pinjaman WHERE ID_Anggota = '$idAnggota' ORDER BY Tanggal_Pinjaman DESC LIMIT 1";
    $result_latest_loan = mysqli_query($db_connect, $query_latest_loan);

    // skip
    if ($result_latest_loan->num_rows > 0) {
        $latest_loan_status = mysqli_fetch_assoc($result_latest_loan)['Status'];

        // Redirect if the latest loan is not paid
        if ($latest_loan_status !== 'Dibayar') {
            echo "<script>
            alert('Tidak bisa melakukan peminjaman karena anda belum membayar pinjaman terakhir anda');
            document.location'pinjaman.php';
            </script>";
        }
    }
} else {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}
$result = mysqli_query($db_connect, $query);

// Penampungan
$dataPinjaman = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($dataPinjaman, $row);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pinjaman</title>
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
    Sidebar::selection("pinjaman"); ?>


    <div class="container">
        <h2>Data Pinjaman</h2>
        <div class="card shadow mb-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Tanggal Pinjaman</th>
                        <th>Status</th>
                        <?php if ($role === 'admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>

                    <?php foreach ($dataPinjaman as $row): ?>
                        <tr>
                            <td>
                                <?= $row['ID_Anggota'] ?>
                            </td>
                            <td>
                                <?= $row['Nama_Anggota'] ?>
                            </td>
                            <td>Rp
                                <?= $row['Jumlah_Pinjaman'] ?>
                            </td>
                            <td>
                                <?= $row['Tanggal_Pinjaman'] ?>
                            </td>
                            <td>
                                <?= $row['Status'] ?>
                            </td>

                            <?php if ($role === 'admin'): ?>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?= $row['ID_Pinjaman'] ?>">
                                        <i class="ri-pencil-line"></i>
                                    </button> 
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?= $row['ID_Pinjaman'] ?>"><i class="ri-delete-bin-line"></i>
                                    </button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>


            <!-- Modal Edit -->
            <div>
                <?php foreach ($dataPinjaman as $row): ?>
                    <div class="modal fade" id="editModal<?= $row['ID_Pinjaman'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModal<?= $row['ID_Pinjaman'] ?>">Pinjam</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form class="row g-3" method="POST" action="./backend/aksi_pinjaman.php">

                                    <input type="hidden" name="ID_Pinjaman" value="<?= $row['ID_Pinjaman'] ?>">
                                    <input type="hidden" name="ID_Anggota" value="<?= $row['ID_Anggota'] ?>">
                                    <input type="hidden" name="Nama_Anggota" value="<?= $row['Nama_Anggota'] ?>">

                                    <div class="col-md-10 mx-auto p-2">
                                        <label class="form-label">Jumlah pinjaman:</label>
                                        <input type="number" class="form-control" name="Jumlah_Pinjaman"
                                            value="<?= $row['Jumlah_Pinjaman'] ?>" required>
                                    </div>
                                    <div class="col-md-10 mx-auto p-2">
                                        <label class="form-label">Tanggal pinjaman:</label>
                                        <input type="date" class="form-control" name="Tanggal_Pinjaman"
                                            value="<?= $row['Tanggal_Pinjaman'] ?>" required>
                                    </div>
                                    <div class="col-md-10 mx-auto p-2">
                                        <label class="form-label">Status Pinjaman:</label>
                                        <select class="form-select" name="Status">
                                            <option  <?= atOption($row['Status'], "Diajukan") ?>>Diajukan</option>
                                            <option  <?= atOption($row['Status'], "Disetujui") ?>>Disetujui</option>
                                            <option  <?= atOption($row['Status'], "Ditolak") ?>>Ditolak</option>
                                            <option  <?= atOption($row['Status'], "Dibayar") ?>>Dibayar</option>
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bedit">edit</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- modal delete -->
                    <div class="modal fade" id="deleteModal<?= $row['ID_Pinjaman'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModal<?= $row['ID_Pinjaman'] ?>">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="./backend/aksi_pinjaman.php" method="POST">
                                    <div>
                                        <input type="hidden" name="ID_Pinjaman" value="<?= $row['ID_Pinjaman'] ?>">
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin menghapus data pinjaman?

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                                            name="bhapus">Hapus</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Button trigger modal -->
            <?php if ($role === 'user'): ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Pinjam sekarang?
                </button>

                <!-- Modal pinjam-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pinjam</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="./backend/aksi_pinjaman.php">
                                <div class="modal-body">

                                        <input type="hidden" name="ID_Anggota" value="<?php echo $idAnggota; ?>">
                                        <input type="hidden" name="Nama_Anggota" value="<?php echo $namaAnggota; ?>">
                                            
                                        <div class="col-md-10 mx-auto p-2">
                                            <label class="form-label">Jumlah pinjaman:</label>
                                            <input type="number" class="form-control" name="Jumlah_Pinjaman">
                                        </div>
                                        <div class="col-md-10 mx-auto p-2">
                                            <label class="form-label">Tanggal pinjaman:</label>
                                            <input type="date" class="form-control" name="Tanggal_Pinjaman">
                                        </div>
                                       
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="bpinjam">pinjam</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
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
function atOption($status, $value)
{
    $attrib = ($status == $value) ? "selected" : "";
    return "value='$value' $attrib";
}

mysqli_close($db_connect);
?>