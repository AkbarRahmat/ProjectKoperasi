<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card-body p-0 mx-auto login-form shadow p-3 mb-5 bg-body-tertiary register">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Silahkan buat akun!</h1>
                </div>
                <form class="user-register" action="./backend/register.php" method="post">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" id="nama"
                                placeholder="Nama lengkap" name="nama">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" id="nik" placeholder="NO KTP/NIK"
                                name="nik">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" id="alamat"
                                placeholder="NO KTP/NIK" name="alamat">
                        </div>
                        <div class="col-sm-6">
                            <label for="tanggal_lahir">Tanggal lahir</label>
                            <input type="date" class="form-control form-control-user" id="tanggal_lahir"
                                placeholder="Tanggal Lahir" name="tanggal_lahir">
                        </div>
                        <div class="col-md-4">
                            <select id="gender" name="gender"  class="form-select">
                                <option disabled selected>Jenis kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="no_telepon"name="no_telepon"
                            placeholder="Nomor WhatsApp">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="email"name="email"
                            placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="username"name="username"
                            placeholder="Username">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" name="password" id="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-login btn-block" >Register</button>
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