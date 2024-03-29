<?php
session_start();
require_once "./config/db.php";
require_once "./component/modal_sidebar/modal.php";

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
} else {
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

<?php Class ModalAnggota extends Modal {
    static public function edit($row) {
        return elementModalEdit($row);
    }

}?>

<?php function elementModalEdit($row) {?>
    <div class="modal fade" id="editModal<?= $row['ID_Anggota'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editModal<?= $row['ID_Anggota'] ?>">Pinjam</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="./backend/aksi_dataAnggota.php">

                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">ID Anggota:</label>
                                                <input type="number" class="form-control" name="ID_Anggota"
                                                    value="<?= $row['ID_Anggota'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">Nama:</label>
                                                <input type="text" class="form-control" name="Nama"
                                                    value="<?= $row['Nama'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">Alamat:</label>
                                                <input type="text" class="form-control" name="Alamat"
                                                    value="<?= $row['Alamat'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">Tanggal Lahir:</label>
                                                <input type="date" class="form-control" name="Tanggal_Lahir"
                                                    value="<?= $row['Tanggal_Lahir'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">NIK:</label>
                                                <input type="number" class="form-control" name="NIK"
                                                    value="<?= $row['NIK'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">Jenis kelamin:</label>
                                                <select name="Gender" required>
                                                    <option <?= atOption($row['Gender'], "Laki-laki") ?>>Laki-laki</option>
                                                    <option <?= atOption($row['Gender'], "Perempuan") ?>>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">No Telepon:</label>
                                                <input type="number" class="form-control" name="No_Telepon"
                                                    value="<?= $row['No_Telepon'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">Email:</label>
                                                <input type="email" class="form-control" name="Email"
                                                    value="<?= $row['Email'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">Password:</label>
                                                <input type="text" class="form-control" name="Password"
                                                    value="<?= $row['Password'] ?>" required>
                                            </div>
                                            <div class="col-md-10 mx-auto p-2">
                                                <label class="form-label">Status Anggota:</label>
                                                <select name="Status" required>
                                                    <option <?= atOption($row['Status'], 'Aktif') ?>>Aktif</option>
                                                    <option <?= atOption($row['Status'], 'Non-Aktif') ?>>Non Aktif</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"
                                                    name="bedit">Edit</button>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css">
    <link rel="stylesheet" href="./component/css/style-media.css">
  	<link rel="icon" href="./bank-line.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <style>
        .search{
            width: 50%;
            display: flex;
            flex-direction: row;
        }

        .search button{
            width: 20%;
            height: 20%;
            margin: 10px 5px ;
          	font-size: 15px;
        } 

        @media (max-width: 767px) {
        .container{
          width:80%;
          height:80%;
          }
        .search{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
        }

        .search button{
            width: 50%;
            height: auto;
            margin: 20px 20px;
        }
        

        }
    </style>
</head>

<body>
    <header>
        <h1>Koperasi <span>Wiatakarya Sejahtera</span></h1>
    </header>

    <main>
        <?php
        require_once "./component/modal_sidebar/sidebar.php";
        Sidebar::selection("anggota") ?>

        <div class="container">
            <h2>Data Anggota</h2>
                <div class="card shadow mb-4">
                    <form method="POST">
                        <div class="search input-group-mb-3">
                            <br>
                            <input type="text" name="tcari" class="form-control m-3" placeholder="Cari Nama atau Nik disini!">
                            <button class="btn btn-primary p-1 " name="bcari" type="submit">
                            <i class="ri-search-line"></i>    
                            Cari</button>
                            <button class="btn btn-danger p-1 " name="breset" type="submit">
                            <i class="ri-loop-left-line"></i>
                            Reset</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered w-100" id="example" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
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
                                <?php 
                                if(isset($_POST['bcari'])){
                                    $keyword = $_POST['tcari'];
                                    $x = "SELECT * FROM anggota WHERE NIK like '%$keyword%' or Nama like '%$keyword%' order by ID_Anggota desc "; 
                                }else{
                                    $x = "SELECT * FROM anggota order by ID_Anggota desc ";
                                }
                                
                                $dataAnggota = mysqli_query($db_connect, $x);
                                ?>
                            </thead>
                            <tbody>
                                <?php foreach ($dataAnggota as $row): ?>
                                    <tr>
                                        <td>
                                            <?= $row['ID_Anggota'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Nama'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Alamat'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Tanggal_Lahir'] ?>
                                        </td>
                                        <td>
                                            <?= $row['NIK'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Gender'] ?>
                                        </td>
                                        <td>
                                            <?= $row['No_Telepon'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Email'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Password'] ?>
                                        </td>
                                        <td>
                                            <?= $row['Status'] ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal<?= $row['ID_Anggota'] ?>">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- edit -->
                    <div>
                        <?php foreach ($dataAnggota as $row): ?>
                            <?php ModalAnggota::edit($row) ?>
                        <?php endforeach; ?>
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