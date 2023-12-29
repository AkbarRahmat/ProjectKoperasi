<?php
session_start();
require_once "./config/db.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pinjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.6.0/remixicon.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: row;
        }
    </style>
</head>
<body>
    <?php
    require_once "./component/sidebar.php";
    Sidebar::selection("pembayaran_pinjaman");

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];

    // Retrieve user information
    $query_user_info = "SELECT ID_Anggota FROM anggota WHERE Username = '$username'";
    $result_user_info = mysqli_query($db_connect, $query_user_info);
    $user_info = mysqli_fetch_assoc($result_user_info);
    
    $idAnggota = $user_info['ID_Anggota'];

    // if (!$result_user_info || mysqli_num_rows($result_user_info) == 0) {
    //     // Handle the case when user information is not found
    //     die("User information not found");
    // }


    // Retrieve the latest unpaid loan
    $query_latest_loan = "SELECT * FROM pinjaman WHERE ID_Anggota = '$idAnggota' AND Status != 'Dibayar' ORDER BY Tanggal_Pinjaman DESC LIMIT 1";
    $result_latest_loan = mysqli_query($db_connect, $query_latest_loan);

    if (!$result_latest_loan || mysqli_num_rows($result_latest_loan) == 0) {
        // No unpaid loan found
        echo "<div>Tidak ada pinjaman yang harus dibayar</div>";
        echo "<br>";
        echo "<br>";
        echo "<a href='profile.php'>Back</a>";
        exit();
    }

    $latest_loan = mysqli_fetch_assoc($result_latest_loan);

    if ($latest_loan['Status'] != 'Disetujui') {
        // The loan is not approved yet; payment form not allowed
        echo "<div>Pembayaran tidak dapat dilakukan karena status pinjaman belum disetujui.</div>";
        echo "<br>";
        echo "<br>";
        echo "<a href='profile.php'>Back</a>";
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nominal_pembayaran = $_POST['nominal_pembayaran'];
    
        // Update the loan status to 'Dibayar'
        $query_update_status = "UPDATE pinjaman SET Status = 'Dibayar' WHERE ID_Pinjaman = '{$latest_loan['ID_Pinjaman']}'";
        mysqli_query($db_connect, $query_update_status);
    
        // Add a record to the payment history (you may need a separate table for this)
        $query_insert_payment = "INSERT INTO pembayaran_pinjaman (ID_Pinjaman, Nominal_Pembayaran, Tanggal_Pembayaran) VALUES ('{$latest_loan['ID_Pinjaman']}', '$nominal_pembayaran', NOW())";
        mysqli_query($db_connect, $query_insert_payment);
    
        header("Location: pinjaman.php");
        exit();
    }
    ?>

    <div>
        <h2>Pembayaran Pinjaman</h2>

        <form method="POST" action="">
            <table>
                <tr>
                    <td>Tanggal Peminjaman:</td>
                    <td><?php echo $latest_loan['Tanggal_Pinjaman']; ?></td>
                </tr>
                <tr>
                    <td>Jumlah Pinjaman:</td>
                    <td><?php echo $latest_loan['Jumlah_Pinjaman']; ?></td>
                </tr>
                <tr>
                    <td>Nominal Pembayaran:</td>
                    <td><input type="text" name="nominal_pembayaran" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Bayar"></td>
                </tr>
            </table>
        </form>


        <br>
        <a href="pinjaman.php">Kembali ke Data Pinjaman</a>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</html>
<?php
mysqli_close($db_connect);
?>


