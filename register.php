<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./component/css/style-register.css">
    <link rel="icon" href="./bank-line.png" type="image/x-icon">

</head>

<body>
    <div class="card-body p-0 mx-auto login-form shadow p-3  register">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Silahkan buat akun!</h1>
                </div>
                <form class="user-register" action="./backend/register.php" method="post">
                    <div class="form-group row gap-2">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user w-100" id="nama"
                                placeholder="Nama lengkap" name="nama" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user w-100" id="nik"
                                placeholder="NO KTP/NIK" name="nik" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user w-100" id="alamat"
                                placeholder="Alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal lahir</label>
                            <input type="date" class="form-control form-control-user w-100" id="tanggal_lahir"
                                placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <select id="gender" name="gender" class="form-select w-100" required>
                                <option disabled selected>Jenis kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user w-100" id="no_telepon"
                                name="no_telepon" placeholder="Nomor WhatsApp" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user w-100" id="email" name="email"
                                placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user w-100" id="username"
                                name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user w-100" name="password"
                                id="password" placeholder="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-login btn-block" name="regis">Register</button>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="login.php">Already have an account? Login!</a>
                    </div>
            </div>
        </div>
    </div>
</body>

</html>