<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <div class="card-body p-0 mx-auto login-form shadow p-3 mb-5 bg-body-tertiary"
        style="width: max-content; height: max-content">
        <!-- Nested Row within Card Body -->
        <div class="p-5 ">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Selamat datang Silahkan login!</h1>
            </div>
            <form class="user mx-auto login" action="./backend/login.php" method="post">
                <div class="form-group">
                    <input type="email" class="form-control form-login-user" id="email" name="email"
                        aria-describedby="emailHelp" placeholder="Masukkan Email ...">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-login-user" id="password" name="password"
                        placeholder="Masukkan Password">
                </div>
                <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-login btn-block" >Login</button>
                </div>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="register.php">Buat Akun</a>
            </div>
        </div>
        </shadow>
</body>

</html>