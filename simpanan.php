<?php
session_start();
require_once "./config/db.php";
require_once "./component/modal_sidebar/modal.php";

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
    $query = "SELECT * FROM simpanan WHERE Status_Deleted = 0 ORDER BY Tanggal_Simpanan DESC";
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
<?php Class ModalSimpanan extends Modal {
    static public function edit($row) {
        return elementModalEdit($row);
    }

}?>
<?php function elementModalEdit($row) {?>
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
                                            <select class="form-select" name="Jenis_Simpanan" required>
                                                <option <?= atOption($row['Jenis_Simpanan'], "Pokok") ?>>Pokok</option>
                                                <option <?= atOption($row['Jenis_Simpanan'], "Sukarela") ?>>Sukarela</option>
                                                <option <?= atOption($row['Jenis_Simpanan'], "Wajib") ?>>Wajib</option>
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
<?php } ?>
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
    <link rel="icon" href="./bank-line.png" type="image/x-icon">
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
        Sidebar::selection("simpanan"); ?>

        <div class="container">
            <h2>Data Simpanan</h2>
            <div class="card shadow mb-4">

            <div class="upbar justify-content-between">
            <form method="POST">
                        <div class="search input-group-mb-3 d-flex flex-row">
                            <input type="text" name="tcari" class="form-control" placeholder="Cari Nama atau Nik disini!">
                            <button class="btn btn-primary p-1 h-25" name="bcari" type="submit">
                            <i class="ri-search-line"></i><span> Cari</span> 
                            </button>
                            <button class="btn btn-danger p-1 h-25" name="breset" type="submit">
                            <i class="ri-loop-left-line"></i><span> Reset</span>
                            </button>
                        </div>
                    </form>

            <?php if ($role === 'user'): ?>
                    <button type="button" class="tambah btn btn-primary m-1 mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Simpanan
                    </button>

                    <!-- Modal tambah simpanan -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Simpanan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="./backend/aksi_simpanan.php">
                                    <div class="modal-body">

                                        <input type="hidden" name="ID_Anggota" value="<?php echo $idAnggota; ?>">
                                        <input type="hidden" name="Nama_Anggota" value="<?php echo $namaAnggota; ?>">
                                        <div class="col-md-10 mx-auto p-2">
                                            <label class="form-label">Jumlah Simpanan:</label>
                                            <input type="number" class="form-control" name="Jumlah_Simpanan" required>
                                        </div>
                                        <div class="col-md-10 mx-auto p-2">
                                            <label class="form-label">Tanggal Simpanan:</label>
                                            <input type="date" class="form-control" name="Tanggal_Simpanan" required>
                                        </div>
                                        <div class="col-md-10 mx-auto p-2">
                                            <label class="form-label">Status Simpanan:</label>
                                            <select name="Jenis_Simpanan" required>
                                                <option disabled selected>Pilih jenis simpanan anda</option>
                                                <option value="Pokok">Simpanan Pokok</option>
                                                <option value="Wajib">Simpanan Wajib</option>
                                                <option value="Sukarela">Simpanan Sukarela</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
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
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
                <div>
                    <?php foreach ($dataSimpanan as $row): ?>
                        <?php ModalSimpanan::edit($row) ?>
                        

                        <!-- modal delete -->

                        <div class="modal fade" id="deleteModal<?= $row['ID_Simpanan'] ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteModal<?= $row['ID_Simpanan'] ?>">Modal title
                                        </h1>
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