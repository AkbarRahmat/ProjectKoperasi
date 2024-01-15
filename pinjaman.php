<?php
session_start();
require_once "./config/db.php";
require_once "./component/modal_sidebar/modal.php";

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
    $query = "SELECT * FROM pinjaman WHERE Status_Deleted = 0  ORDER BY Tanggal_Pinjaman DESC";
} else {
    $query = "SELECT * FROM pinjaman WHERE Status_Deleted = 0 AND ID_Anggota = '$idAnggota'  ORDER BY Tanggal_Pinjaman DESC";
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
<?php Class ModalPinjaman extends Modal {
    static public function edit($row) {
        return elementModalEdit($row);
    }

}?>
<?php function elementModalEdit($row) {?>
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
                                                <option <?= atOption($row['Status'], "Diajukan") ?>>Diajukan</option>
                                                <option <?= atOption($row['Status'], "Disetujui") ?>>Disetujui</option>
                                                <option <?= atOption($row['Status'], "Ditolak") ?>>Ditolak</option>
                                                <option <?= atOption($row['Status'], "Dibayar") ?>>Dibayar</option>
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
                                        <h1 class="modal-title fs-5" id="deleteModal<?= $row['ID_Pinjaman'] ?>">Modal title
                                        </h1>
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
                         <!-- Modal for confirmation -->
                        <div class="modal fade" id="confirmModal<?= $row['ID_Pinjaman'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- ... Modal content for confirmation ... -->
                                    <form action="./backend/aksi_pinjaman.php" method="POST">
                                        <div>
                                            <input type="hidden" name="ID_Pinjaman" value="<?= $row['ID_Pinjaman'] ?>">
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin mengkonfirmasi pinjaman ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" name="bkonfirmasi">Konfirmasi</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php }?>

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
    <style>
        .search{
            width: 200%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            margin: 15px 0;
        }

        .search input{
            width: 150%;
            height: 50%;
            margin: auto 5px;
        }

        .search button{
            width: 30%;
            height: auto;
            margin: 5px 5px;
        }

        .tambah{
            width: 20%;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
        }

        .upbar{
            display: flex;
            flex-direction: row;
        }

        @media (max-width: 767px) {
            .container{
          width:80%;
          height: 100%;
          }

        .search{
            width: 100%;
            height: auto;
            margin: -10px auto;
            display: flex;
            align-items: center;
            flex-direction: row;
            padding: 5px;
            margin-bottom: -15px;
        }
        
        .search input{
            width: 80%;
            height: 50%;
            margin-right: 5px;
        }

        .search button{
            width: 15%;
            height: auto;
            margin: 20px 1px;
        }

        .search button span{
            display: none;
        }
        
        .tambah{
            width: 95%;
            height: auto;
            display: flex;
            align-self: center;
            text-align: center;
            
        }

        .upbar{
            display: flex;
            flex-direction: column;
        }
        }

    </style>
</head>

<body>
    <header>
        <h1>Koperasi <span>Wiatakarya Sejahtera</span></h1>
    </header>

    <main>
        <?php require_once "./component/modal_sidebar/sidebar.php";
        Sidebar::selection("pinjaman"); ?>


        <div class="container">
            <h2>Data Pinjaman</h2>
            <div class="card shadow mb-4 overflow-auto">
            <div class="upbar justify-content-between">
                <!-- Masih search anggota belum pinjaman -->
                    <form method="POST">
                        <div class="search input-group-mb-3">
                            <input type="text" name="tcari" class="form-control" placeholder="Cari Nama atau Nik disini!">
                            <button class="btn btn-primary p-1 h-25" name="bcari" type="submit">
                            <i class="ri-search-line"></i><span> Cari</span> 
                            </button>
                            <button class="btn btn-danger p-1 h-25" name="breset" type="submit">
                            <i class="ri-loop-left-line"></i><span> Reset</span>
                            </button>
                        </div>
                    </form>
            
                    <!-- Button trigger modal -->
                    <?php if ($role === 'user'): ?>
                        <button type="button" class="tambah btn btn-primary m-1 mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Pinjaman
                        </button>

                    <!-- Modal pinjam-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pinjam</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="bpinjam">pinjam</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>                
                    <?php endif; ?>
                </div>
                
                <?php if ($role === 'admin'): ?>
                    <br>
                <?php endif; ?>

                
                <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0"> 
                        <thead>
                        <tr class="text-center">
                            <th>ID Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Tanggal Pinjaman</th>
                            <th>Status</th>
                            <?php if ($role === 'admin'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                         	<?php if ($role === 'user'): ?>
                                <th>Cetak Pembayaran</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
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
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal<?= $row['ID_Pinjaman'] ?>">
                                            <i class="ri-pencil-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?= $row['ID_Pinjaman'] ?>"><i
                                                class="ri-delete-bin-line"></i>
                                        </button>
                                        <?php if ($row['Status'] === 'Diajukan'): ?>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $row['ID_Pinjaman'] ?>">
                                        <i class="ri-check-line"></i>
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                              
                                <?php if ($role === 'user'): ?>
                              	 <td class="text-center">
                                    <?php if ($row['Status'] === 'Dibayar'): ?>
                                        <button type="button" class="btn btn-success w-50" data-bs-toggle="modal" data-bs-target="#printModal<?= $row['ID_Pinjaman'] ?>">
                                        <i class="ri-download-line"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                              	<?php endif; ?>
                              
                               
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>


                <!-- Modal Edit -->
                <div>
                    <?php foreach ($dataPinjaman as $row): ?>
                        <?php ModalPinjaman::edit($row) ?>
                    <?php endforeach; ?>
                </div>

                <!-- Modal for printing -->
                <div class="modal fade" id="printModal<?= $row['ID_Pinjaman'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Nama: <?= $row['Nama_Anggota'] ?></p>
                                <p>Nominal Pinjaman: Rp <?= number_format($row['Jumlah_Pinjaman'], 0) ?></p>
                                <!-- Add other relevant information -->
                                <!-- ... -->
                            </div>
                            <div class="modal-footer">
                                <!-- Add a button to download the payment receipt -->
                                <button type="button" class="btn btn-primary" onclick="printReceipt(<?= $row['ID_Pinjaman'] ?>)">Download Bukti Pembayaran</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for printing -->
                <div class="modal fade" id="printModal<?= $row['ID_Pinjaman'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Nama: <?= $row['Nama_Anggota'] ?></p>
                                    <p>Nominal Pinjaman: Rp <?= number_format($row['Jumlah_Pinjaman'], 0) ?></p>
                                    <!-- Add other relevant information -->
                                    <!-- ... -->
                                </div>
                                <div class="modal-footer">
                                    <!-- Add a button to download the payment receipt -->
                                    <button type="button" class="btn btn-primary" onclick="printReceipt(<?= $row['ID_Pinjaman'] ?>)">Download Bukti Pembayaran</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
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
        
        <script>
        function printReceipt(idPinjaman) {
            // Use AJAX to fetch receipt data from the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var receiptContent = xhr.responseText;
                    
                    // Open a new window and print the receipt
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write('<html><head><title>Bukti Pembayaran</title></head><body>');
                    printWindow.document.write('<pre>' + receiptContent + '</pre>');
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                }
            };
            xhr.open('GET', './backend/get_receipt.php?id=' + idPinjaman, true);
            xhr.send();
        }
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

