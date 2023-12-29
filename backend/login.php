<?php
session_start();
require_once "../config/db.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
 
    $email = mysqli_real_escape_string($db_connect, $email);
    $password = mysqli_real_escape_string($db_connect, $password);
 
    $query = "SELECT * FROM anggota WHERE Email = '$email' AND Password = '$password'";
    $result = $db_connect->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
        $_SESSION["email"] = $user["Email"];
        $_SESSION["username"] = $user["Username"];
        $_SESSION["role"] = $user["Role"];
 
        header("Location: ./../dashboard.php");
        exit();
    } else { 
      echo "<script>
      alert('Username atau password salah!');
      document.location='./../login.php';
      </script>";
      
    }
}

$db_connect->close();
?>
