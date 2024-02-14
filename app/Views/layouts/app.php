<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Farmvest</title>
    <link href="<?= asset('farmvest-ui/style/main.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>
    <?= $this->renderSection('script-atas') ?>
</head>

<body class="<?= request()->uri->getSegment(1) != null ? 'bg-secondary' : ''; ?>">
    <div id="app">
        <nav class="navbar navbar-farmvest navbar-expand-lg navbar-dark py-3 <?= request()->uri->getSegment(1) != null ? 'bg-primary' : 'fixed-top'; ?>">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="<?= asset('farmvest-ui/images/logo.png') ?>" width="200px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto align-lg-items-center ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('#katalog') ?>">Order Sekarang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#mitra">Join Mitra</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-lg-auto align-lg-items-center gap-3">

                        <?php if (session()->get('logged_in')) : ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-warning fw-bold rounded-circle py-2" aria-current="page" href="<?= base_url('keranjang') ?>"><i class="bi bi-bag"></i></a>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="btn btn-outline-warning fw-bold rounded-circle py-2" aria-current="page" href="#" type="button" data-bs-toggle="dropdown"><i class="bi bi-person"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Hi, <?= session()->get('name') ?></a></li>
                                        <li><a class="dropdown-item" href="<?= route_to('Home::pesanan_saya') ?>">Pesanan Saya</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-warning fw-bold rounded-circle py-2" aria-current="page" href="#" type="button" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="bi bi-person"></i></a>
                            </li>
                        <?php endif; ?>
                        <!-- <li class="nav-item">
                            <a class="btn btn-outline-warning fw-bold rounded-pill px-4 py-2"
                            aria-disabled="true">Login</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <a href="https://api.whatsapp.com/send?phone=6285860590765&text=Hallo" class="float" target="_blank">
            <i class="fab fa-whatsapp my-float"></i>
        </a>
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Yakin Logout ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url('logout') ?>" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="<?= base_url('logout') ?>" method="POST" class="d-none">

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->renderSection('content') ?>
    </div>
    <link href="<?= asset('farmvest-ui/style/main.css') ?>" rel="stylesheet" />
    <script src="<?= asset('farmvest-ui/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= asset('farmvest-ui/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= asset('farmvest-ui/script/navbar.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>
