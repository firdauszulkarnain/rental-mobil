<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Mobil</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Css Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
    <!-- Template Style -->
    <link rel="stylesheet" href="assets/toko/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/toko/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="assets/toko/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets/toko/css/slicknav.min.css" type="text/css">
    <!-- DATATABLE -->
    <link rel="stylesheet" href="assets/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/toko/css/style.css" type="text/css">
    <!-- jQuery -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">

        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li>
                    <div class="humberger__menu__widget">
                        <div class="header__top__right__auth">
                            <a href="#"><i class="fa fa-user"></i> Login</a>
                        </div>
                    </div>
                </li>
                <li>

                </li>
            </ul>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>

                <li>
                    <a href="">Peminjaman Saya</a>
                </li>


                <li>
                    <a href="#">Logout</a>
                </li>

            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> KATALOG</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li style="font-size: 18px !important;"><a href="index.php" class="text-decoration-none text-dark font-weight-bolder"><i class="fas fa-fw fa-car"></i>KATALOG MOBIL</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </div>
                            <div class="header__top__right__auth">
                                <?php if (isset($_SESSION['user'])) : ?>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <span class="text-capitalize"><i class="fa fa-user"></i><?= $user['nama_lengkap'] ?></span>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="background-color: black;">
                                            <a class="dropdown-item" id="user-dropdown" href="logout.php"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
                                        </div>
                                    </div>
                                <?php else : ?>

                                    <a href="login.php"><i class="fa fa-user"></i> Login</a>
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href=""><img src="" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center">
                    <nav class="header__menu">

                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->