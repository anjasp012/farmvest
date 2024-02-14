<?= $this->extend('layouts/app') ?>


<?= $this->section('content') ?>

<div class="pages-content page-mitra">
    <section id="agen-mitra">
        <div class="container">
            <h3 class="fw-bold text-primary text-center mb-4">
                DAPATKAN FARVEST MELALUI AGEN RESMI DENGAN <br class="d-none d-lg-block"> ONGKIR DAN HARGA LEBIH
                MURAH​​
            </h3>
            <div class="row g-3 justify-content-center">
                <?php foreach ($produks as $key => $produk) : ?>
                    <div class="col-md-2 col-6">
                        <div class="card card-farmvest shadow">
                            <img src="<?= asset('uploads/images/produk/' . $produk['thumbnail']) ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 13px;"><?= $produk['nama'] ?>
                                </h5>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-warning mb-2 rounded-pill w-100" style="font-size: 13px;">Rp
                                    <?= number_format($produk['harga'], '0', '0', '.') ?></button>
                                <button class="btn btn-primary rounded-pill w-100" data-bs-toggle="modal" data-bs-target="#<?= $produk['id'] ?>" style="font-size: 13px;">Beli</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="<?= $produk['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class=" modal-content">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ke keranjang</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body border-0">
                                    <div class="d-flex gap-4 align-items-center px-3 py-3">
                                        <img src="<?= asset('uploads/images/produk/' . $produk['thumbnail']) ?>" class="w-25" alt="">
                                        <div>
                                            <h6><?= $produk['nama'] ?></h6>
                                            <p>Rp <?= number_format($produk['harga'], '0', '0', '.') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <div class="d-flex justify-content-center text-center w-100">
                                        <div class="btn-group" role="group" aria-label="Basic example" id="qty<?= $produk['id'] ?>">
                                            <button type="button" class="btn btn-primary" id="qty-min<?= $produk['id'] ?>"><i class="fa-fw fas fa-minus"></i></button>
                                            <input name="qty" type="button" class="btn btn-white px-4" value="1" id="qty-val<?= $produk['id'] ?>">
                                            <button type="button" class="btn btn-primary" id="qty-plus<?= $produk['id'] ?>"><i class="fa-fw fas fa-plus"></i></button>
                                        </div>
                                        <?= $this->section('script') ?>
                                        <script>
                                            $('#qty-min<?= $produk['id'] ?>').click(function() {
                                                $('#qty-val<?= $produk['id'] ?>').val(+$('#qty-val<?= $produk['id'] ?>').val() - 1);
                                            })
                                            $('#qty-plus<?= $produk['id'] ?>').click(function() {
                                                $('#qty-val<?= $produk['id'] ?>').val(+$('#qty-val<?= $produk['id'] ?>').val() + 1);
                                            })
                                        </script>
                                        <?= $this->endSection() ?>

                                    </div>
                                    <button type="button" class="btn btn-primary w-100" id="btn-keranjang<?= $produk['id'] ?>">Tambah Ke Keranjang</button>
                                    <?= $this->section('script') ?>
                                    <script>
                                        $('#btn-keranjang<?= $produk['id'] ?>').click(function() {
                                            var qty = $('#qty-val<?= $produk['id'] ?>').val();
                                            $.ajax({
                                                url: '<?= base_url('tambah-keranjang ') ?>', // Ganti dengan URL yang sesuai dengan rute Anda
                                                type: 'POST', // Ganti dengan metode yang sesuai (GET, POST, dll.)
                                                data: {
                                                    produk_id: '<?= $produk['id'] ?>',
                                                    qty: qty,
                                                },
                                                success: function(response) {
                                                    // Handle respons dari server di sini
                                                    console.log(response);
                                                },
                                                error: function(xhr, status, error) {
                                                    // Handle kesalahan jika ada
                                                    console.error(xhr.responseText);
                                                }
                                            });
                                        })
                                    </script>
                                    <?= $this->endSection() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <img src="<?= asset('farmvest-ui/images/map-1.png') ?>" class="w-100" alt="">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-5">
                    <p class="text-primary">
                        Dapatkan Hotto melalui mitra resmi terdekat dengan <strong>HARGA TERMURAH</strong> dan
                        <strong>DISKON ONGKIR</strong>
                    <ol class="text-primary fw-semibold">
                        <li>Cari kota kamu</li>
                        <li>Pesan Farmvest melalui agen terdekat</li>
                        <li>Produk Dijamin Original</li>
                    </ol>
                    </p>
                </div>
            </div>
            <div class="list-agen">
                <h4 class="border-start border-5 px-3 ms-4 border-warning fw-semibold text-primary my-3">
                    BANTEN
                </h4>
                <div class="accordion accordion-flush accordion-farmvest-agen" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between align-lg-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#banten1" aria-expanded="false" aria-controls="banten1">
                                <span>
                                    Serang Banten
                                </span>
                                <span class="accordion-icon">
                                    <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                </span>
                            </button>
                        </h2>
                        <div id="banten1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="">
                                    <h5 class="mb-4"><span class="fw-bold text-primary">F</span><span class="mx-2">|</span><span class="fw-semibold">Dika</span></h5>
                                    <p class="mt-4">
                                        <img src="<?= asset('farmvest-ui/images/Wa-logo-100px.webp') ?>" width="33px" height="33px" alt="">
                                        085817624189
                                    </p>
                                    <a class="text-decoration-none" target="_blank" href="https://api.whatsapp.com/send?phone=6285817624189&text=Halo%20min,%20saya%20dapat%20info%20dari%20website.%20Mau%20pesan%20produk%20farmvest,%20apakah%20bisa%20dibantu?">Klik
                                        untuk pesan disini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="border-start border-5 px-3 ms-4 border-warning fw-semibold text-primary my-3">JAWA
                    BARAT
                </h4>
                <div class="accordion accordion-flush accordion-farmvest-agen" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between align-lg-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#jawabarat1" aria-expanded="false" aria-controls="jawabarat1">
                                <span>
                                    Bogor
                                </span>
                                <span class="accordion-icon">
                                    <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                </span>
                            </button>
                        </h2>
                        <div id="jawabarat1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h5 class="mb-4"><span class="fw-bold text-primary">F</span><span class="mx-2">|</span><span class="fw-semibold">SANDI</span></h5>
                                <p>
                                    <img src="<?= asset('farmvest-ui/images/Wa-logo-100px.webp') ?>" width="33px" height="33px" alt="">
                                    081287361524
                                </p>
                                <a class="text-decoration-none" target="_blank" href="https://api.whatsapp.com/send?phone=6281287361524&text=Halo%20min,%20saya%20dapat%20info%20dari%20website.%20Mau%20pesan%20produk%farmvest,%20apakah%20bisa%20dibantu?">Klik
                                    untuk pesan disini</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between align-lg-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#jawabarat2" aria-expanded="false" aria-controls="jawabarat2">
                                <span>
                                    Depok
                                </span>
                                <span class="accordion-icon">
                                    <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                </span>
                            </button>
                        </h2>
                        <div id="jawabarat2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <h5 class="mb-4"><span class="fw-bold text-primary">F</span><span class="mx-2">|</span><span class="fw-semibold">HJ. HELMI</span></h5>
                                <a href="" class="mb-4 text-decoration-none">
                                    <img src="<?= asset('farmvest-ui/images/shopee-100px.webp') ?>" width="33px" height="33px" alt="">
                                    peternaklokalmendunia
                                </a>
                                <p class="mt-4">
                                    <img src="<?= asset('farmvest-ui/images/Wa-logo-100px.webp') ?>" width="33px" height="33px" alt="">
                                    081374432609
                                </p>
                                <a class="text-decoration-none" target="_blank" href="https://api.whatsapp.com/send?phone=6281374432609&text=Halo%20min,%20saya%20dapat%20info%20dari%20website.%20Mau%20pesan%20produk%farmvest,%20apakah%20bisa%20dibantu?">Klik
                                    untuk pesan disini</a>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="border-start border-5 px-3 ms-4 border-warning fw-semibold text-primary my-3">
                    SUMATERA BARAT
                </h4>
                <div class="accordion accordion-flush accordion-farmvest-agen" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between align-lg-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#sumaterabarat1" aria-expanded="false" aria-controls="sumaterabarat1">
                                <span>
                                    Sijunjung
                                </span>
                                <span class="accordion-icon">
                                    <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                </span>
                            </button>
                        </h2>
                        <div id="sumaterabarat1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="">
                                    <h5 class="mb-4"><span class="fw-bold text-primary">F</span><span class="mx-2">|</span><span class="fw-semibold">Mira</span></h5>
                                    <p class="mt-4">
                                        <img src="<?= asset('farmvest-ui/images/Wa-logo-100px.webp') ?>" width="33px" height="33px" alt="">
                                        082173048741
                                    </p>
                                    <a class="text-decoration-none" target="_blank" href="https://api.whatsapp.com/send?phone=6282173048741&text=Halo%20min,%20saya%20dapat%20info%20dari%20website.%20Mau%20pesan%20produk%farmvest,%20apakah%20bisa%20dibantu?">Klik
                                        untuk pesan disini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#sumaterabarat2" aria-expanded="false" aria-controls="sumaterabarat2">
                                <span>
                                    Padang
                                </span>
                                <span class="accordion-icon">
                                    <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                </span>
                            </button>
                        </h2>
                        <div id="sumaterabarat2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="">
                                    <h5 class="mb-4"><span class="fw-bold text-primary">F</span><span class="mx-2">|</span><span class="fw-semibold">Rika</span></h5>
                                    <a href="" class="mb-4 text-decoration-none">
                                        <img src=" <?= asset('farmvest-ui/images/shopee-100px.webp') ?>" width="33px" height="33px" alt="">
                                        Farmvest_Padang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="apa-itu">
        <div class="container">
            <h3 class="text-primary text-center fw-bold mb-4">
                Apa itu Farmvest?<br class="d-none d-lg-block">
                Tonton penjelasannya melalui<br class="d-none d-lg-block">
                video di bawah ini
            </h3>
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/o__24I85B_U?si=xTugUNJpPBNhEDfA&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h4 class="text-center text-primary fw-bold mb-4">Butuh Bantuan?</h4>
                <div class="text-center">
                    <a href="https://api.whatsapp.com/send?phone=6285860590765&text=Hallo" target="_blank" class="btn btn-success py-3 px-4 text-white"><i class="fab fa-whatsapp"></i>
                        Chat Admin</a>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
