<?php

session_start();
if (isset($_SESSION['user'])) {
    $url = 'index.php';
    header("Location: $url");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login RENTAL MOBIL</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- SWEETALERT2 -->
    <script src="assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4 text-dark font-weight-bolder">LOGIN USER</h1>
                                    </div>
                                    <hr>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Username" name="username" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit" name="login">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <div class="text-center">
                                            <a class="small" href="register.php">Create an Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>

<?php

require 'functions/functions.php';
if (isset($_POST['login'])) {
    // ambil data pada form input login menggunakan method post
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // jika inputan kosong, tampilkan aler
    if (empty($username) || empty($password)) {
        echo    "<script>
                Swal.fire('Erorr','Form Tidak Boleh Kosong','error');
                </script>";
        exit;
    }

    // cek username, apakah ada di database
    $result = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");

    // jika ada 
    if (mysqli_num_rows($result) == 1) {
        // ambil datanya
        $row = mysqli_fetch_assoc($result);
        // kemudian cek passwordnya sama atau tidak
        if (password_verify($password, $row['password'])) {
            // kalo sama 
            //Set Session user
            $_SESSION['user'] = $row['id_user'];
            // tampilkan alert berhasil login
            echo    "<script>
                Swal.fire('Login Berhasil','','success').then(function() {
                    window.location = 'index.php';
                });;
            </script>";
        } else {
            // kalo gak sama, berarti passwordnya salah
            echo    "<script>
                Swal.fire('Login Gagal','Password Salah','warning').then(function() {
                    window.location = 'login.php';
                });;
            </script>";
        }
    } else {
        // kalo gak ada di database, berarti tidak ditemukan
        echo    "<script>
    Swal.fire('Login Gagal','Username Tidak Ditemukan','error').then(function() {
        window.location = 'login.php';
    });;
    </script>";
    }
} else {
    // digunakan untuk menampilkan informasi error database
    echo mysqli_error($db);
}

?>