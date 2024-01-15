<?php
include "../config/db.php";

if (isset($_GET['id'])) {
    $idPinjaman = $_GET['id'];

    // Replace this query with your actual logic to fetch receipt data from the database
    $query = "SELECT Nama_Anggota, Jumlah_Pinjaman FROM pinjaman WHERE ID_Pinjaman = '$idPinjaman'";
    $result = mysqli_query($db_connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Build the receipt content (customize this based on your actual data)
        $receiptContent = "Nama: " . $row['Nama_Anggota'] . "\n";
        $receiptContent .= "Nominal Pinjaman: Rp " . number_format($row['Jumlah_Pinjaman'], 0) . "\n";
        $receiptContent .= "Tanggal Pembayaran: " . date("Y-m-d"); // Assuming you want today's date

        echo $receiptContent;
    } else {
        echo "Error: Data not found";
    }
} else {
    echo "Error: ID not provided";
}

mysqli_close($db_connect);
?>
