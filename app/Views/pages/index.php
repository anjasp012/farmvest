<?= $this->extend('layouts/app') ?>


<?= $this->section('content') ?>

<div class="pages-content page-home">
    <section id="jumbotron" class="text-white" style="padding-top: 100px;padding-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex flex-column">
                        <div class="text-center">
                            <img src="
                            <?= asset('farmvest-ui/images/first.png') ?>" class="w-75" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p>Mari berkenalan dengan FarmVest, sebuah cerita kehangatan dan keaslian yang berasal dari
                        peternakan lokal Indonesia. Di tengah hiruk-pikuk pasar produk kesehatan, FarmVest hadir
                        dengan keunikan tersendiri.</p>
                    <p>Dibesarkan di tangan para peternak lokal yang penuh dedikasi, susu kambing etawa FarmVest
                        adalah simbol kesegaran dan kekayaan nutrisi. Proses produksi yang teliti menghasilkan
                        susu berkualitas tinggi, yang telah teruji secara ilmiah, menyajikan manfaat luar biasa
                        untuk kesehatan. Tak hanya itu, FarmVest juga memastikan produknya tetap terjangkau,
                        memberikan keseimbangan sempurna antara kualitas dan harga.</p>
                    <p>Dengan FarmVest, Anda tak hanya menikmati nutrisi alami, tetapi juga menjadi bagian dari
                        perjalanan mendukung pertanian lokal Indonesia. Setiap teguk susu FarmVest adalah cerita
                        dari para peternak yang bekerja keras, kearifan lokal, dan komitmen terhadap kesehatan
                        yang terjangkau. FarmVest, kebaikan yang berakar dari tanah Indonesia.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="sertifikasi">
        <div class="container">
            <h3 class="text-center text-primary fw-bold mb-4">Farmvest Memiliki Sertifikasi Lengkap <br class="d-none d-lg-block"> Dengan
                Uji
                Lab
                yang Sudah
                Terbukti</h3>
            <div class="row g-0 align-items-center" style="background: #3E71B3;">
                <div class="col-md-4 d-flex">
                    <img src="<?= asset('farmvest-ui/images/ujilab.png') ?>" class="w-100" alt="">
                </div>
                <div class="col-md-4 d-flex" style="background: #3E71B3;">
                    <ul class="text-white">
                        <li>HALAL MUI
                            MUI-LPPOM-1204650323
                        </li>
                        <li>Original BPOM RI MD
                            071111001200063</li>
                        <li>Cokelat BPOM RI MD
                            071111001500063</li>
                        <li>Stroberi BPOM RI MD
                            071111001700063</li>
                    </ul>
                </div>
                <div class="col-md-4 d-flex">
                    <img src="<?= asset('farmvest-ui/images/sertifikasi.png') ?>" class="w-100" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="katalog">
        <div class="container">
            <h3 class="text-center text-primary fw-bold mb-4">Order Farmvest Melalui Official Store</h3>
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
                                <?php if (session()->get('logged_in')) : ?>
                                    <button class="btn btn-primary rounded-pill w-100" data-bs-toggle="modal" data-bs-target="#<?= $produk['id'] ?>" style="font-size: 13px;">Beli</button>
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
                                                                    location.reload();
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
                                <?php else : ?>
                                    <button class="btn btn-primary rounded-pill w-100" data-bs-toggle="modal" data-bs-target="#loginModal" style="font-size: 13px;">Beli</button>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="login" method="post">
                                    <div class="mb-3">
                                        <label for="InputForEmail" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="InputForPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="InputForPassword">
                                    </div>
                                    <button type="submit" class="btn btn-primary float-center">Login</button>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-warning">Daftar Baru</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Register Pelanggan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formRegister" method="post">
                                    <div class="mb-3">
                                        <label for="InputForname" class="form-label">Nama</label>
                                        <input type="name" name="name" class="form-control" id="InputForName" value="<?= set_value('name') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="InputForEmail" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="InputForPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="InputForPassword">
                                    </div>
                                    <div class="mb-3">
                                        <label for="InputForConfPassword" class="form-label">Confirm Password</label>
                                        <input type="password" name="confpassword" class="form-control" id="InputForConfPassword">
                                    </div>
                                    <button type="submit" class="btn btn-primary float-center">Daftar</button>
                                </form>
                                <?= $this->section('script') ?>
                                <script>
                                    $(document).ready(function() {
                                        $('#formRegister').submit(function(event) {
                                            // Prevent the default form submission
                                            event.preventDefault();

                                            // Serialize the form data
                                            var formData = $(this).serialize();

                                            // Send the form data via Ajax
                                            $.ajax({
                                                type: 'POST',
                                                url: '<?= route_to('AuthController::save') ?>', // Replace 'your_php_script.php' with the URL of your PHP script
                                                data: formData,
                                                success: function(response) {
                                                    // Handle the success response
                                                    location.href = response.link;
                                                    // For example, you can display a success message
                                                },
                                                error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error(xhr.responseText);
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <?= $this->endSection() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <h4 class="text-center text-primary fw-bold">👇Klik untuk pesan melalui mitra resmi kami👇</h4>
                <a href="<?= route_to('Home::list_agen_resmi') ?>" class="btn btn-success btn-lg fw-bold mt-2 text-white px-4 py-3">PESAN
                    SEKARANG</a>
            </div>
        </div>
    </section>
    <section id="manfaat">
        <div class="container">
            <div class="row g-4 align-lg-items-center ">
                <div class="col-12 mb-4">
                    <h3 class="fw-bold text-center text-primary">Kenapa Memilih Farmvest</h3>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <ol>
                            <li>Sertifikasi Lengkap: Lulus uji BPOM, bersertifikat Halal, dan terverifikasi
                                oleh Lab
                                UGM. Kualitas dan keamanan produk terjamin.</li>
                            <li>Kualitas Premium: Diolah dari susu kambing pilihan, menjamin rasa dan
                                kualitas yang unggul.
                            </li>
                            <li>Kesegaran Maksimal: Diproduksi setiap hari untuk menjamin susu selalu fresh.
                            </li>
                            <li>Proses Produksi Higienis: Teknologi terbaru digunakan untuk memastikan
                                proses yang bersih dan higienis.
                            </li>
                            <li>Nutrisi Terbukti: Kandungan Kalsium & Vitamin tinggi, dibuktikan dengan hasil
                                uji lab.
                            </li>
                            <li>Rasa Lezat: Nikmati rasa dan aroma yang enak, ringan, tanpa bau perengus.
                            </li>
                            <li>Cocok untuk Semua: Aman untuk ibu hamil & menyusui, serta bagi penderita
                                diabetes, kolesterol, atau yang sedang diet.
                            </li>
                            <li>Peternakan Berkualitas: Berasal dari kambing yang sehat dan terawat di
                                peternakan terbaik.</li>
                            <li>
                                Inovasi Berkelanjutan: Komitmen pada peningkatan kualitas makanan ternak dan
                                lingkungan peternakan.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mitra">
        <div class="container">
            <h3 class="text-center fw-bold mb-4">Bergabung Menjadi Mitra/Reseller dan Program Afiliasi FarmVest
            </h3>
            <p>FarmVest membuka kesempatan emas bagi Anda untuk bergabung dalam jaringan distribusi produk susu
                kambing berkualitas. Sebagai mitra atau reseller FarmVest, Anda akan menjadi bagian dari misi
                kesehatan dan nutrisi, menyebarkan kebaikan susu kambing etawa ke lebih banyak orang.</p>
            <h4 class="fw-bold">Manfaat Bergabung:</h4>
            <ol>
                <li><b>Mendapat Produk Berkualitas</b>: Menawarkan susu kambing etawa yang segar dan bernutrisi
                </li>
                <li><b>Dukungan Penuh</b>: Kami memberikan dukungan pemasaran, pelatihan dan penjualan untuk
                    memastikan kesuksesan Anda.
                </li>
                <li><b>Margin Keuntungan Menarik</b>: Nikmati margin keuntungan yang kompetitif.
                </li>
                <li><b>Membangun Jaringan</b>: Gabung dalam jaringan distribusi yang luas dan terus berkembang.
                </li>
                <li><b>Misi Sosial</b>: Berkontribusi pada pertanian lokal dan kesehatan masyarakat.
                </li>
                <li><b>Program Afiliasi FarmVest</b>: nikmati komisi menarik dari setiap penjualan yang Anda
                    referensikan, kebebasan mempromosikan di platform digital Anda, dan akses lengkap ke bahan
                    pemasaran termasuk link afiliasi.</li>
            </ol>
            <p>Ambil langkah pertama Anda dalam perjalanan sukses bersama FarmVest. Jadilah bagian dari revolusi
                kesehatan dengan menjadi mitra resmi kami. Hubungi kami sekarang untuk informasi lebih lanjut!
            </p>
            <div class="text-center mt-5">
                <h4 class="text-center text-white fw-bold">👇Bermitra Dengan Kami👇</h4>
                <a class="btn btn-success mt-2 text-white px-4 py-3" href="https://wa.me/6285860590765?text=Hallo%20saya%20tertarik%20untuk%20menjadi%20reseller.%20Bisakah%20Anda%20berikan%20informasi%20lebih%20lanjut%20tentang%20program%20reseller%20yang%20Anda%20tawarkan%3F%20Terima%20kasih%21" target="_blank"> <i class="fab fa-whatsapp"></i>
                    Chat Admin</a>
            </div>
        </div>
    </section>
    <section id="testimoni">
        <div class="container">
            <h3 class="fw-bold text-center text-primary mb-4">
                Testimoni
            </h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/1.png') ?>" class="w-100" alt="">
                            </div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/2.png') ?>" class="w-100" alt="">
                            </div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/3.png') ?>" class="w-100" alt="">
                            </div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/4.png') ?>" class="w-100" alt="">
                            </div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/5.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/6.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/7.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/8.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/9.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/10.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/11.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/12.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/13.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/14.png') ?>" class="w-100" alt=""></div>
                            <div class="swiper-slide"><img src="<?= asset('farmvest-ui/images/testimoni/15.png') ?>" class="w-100" alt="">
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="video">
        <div class="container">
            <h3 class="text-center fw-bold text-white mb-4">
                Temani harimu dengan Susu Farmvest
            </h3>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/S-eAtfDZi_I?si=r6QPnicNRYwALvyq&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/TR77Vg9CjiU?si=UoPDWqy2iRwVFKea&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/E_6lc8vn7ic?si=9UjMHEWFsW8OIdt_&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/kH-NbEm1498?si=1HCJbjaI8EzEvZdM&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="pertanyaan">
        <div class="container">
            <h3 class="text-center text-primary fw-bold mb-4">
                Pertanyaan Seputar Farmvest
            </h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion accordion-flush accordion-farmvest" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between align-lg-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <span>
                                        Apa itu FarmVest?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">FarmVest adalah merek susu kambing etawa premium yang berasal dari peternakan lokal Indonesia. Kami menyediakan susu kambing segar dengan kualitas terbaik yang telah teruji BPOM, bersertifikat Halal, dan diverifikasi oleh Lab UGM.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <span>
                                        Apakah semua produk FarmVest telah disertifikasi?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Ya, semua produk kami telah mendapatkan persetujuan BPOM, sertifikasi Halal dari MUI, dan telah terverifikasi keamanannya oleh laboratorium independen UGM.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <span>
                                        Dari mana FarmVest mendapatkan susu kambing?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Kami bersumber langsung dari peternakan lokal terpilih di Indonesia yang mematuhi standar tertinggi dalam kesejahteraan hewan dan praktek pertanian yang berkelanjutan.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    <span>
                                        Bagaimana cara FarmVest menjamin kesegaran produknya?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Kami memproduksi susu kambing setiap hari dan menjaga rantai dingin yang ketat dari peternakan hingga ke tangan konsumen untuk memastikan kesegaran maksimal.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    <span>
                                        Apakah susu FarmVest aman untuk ibu hamil dan menyusui?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Ya, susu FarmVest aman dan bermanfaat bagi ibu hamil dan menyusui, memberikan nutrisi penting yang mendukung kesehatan ibu dan bayi.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSx" aria-expanded="false" aria-controls="flush-collapseSx">
                                    <span>
                                        Apakah FarmVest memiliki pilihan rasa?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseSx" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Tentu, kami menawarkan berbagai rasa seperti original, cokelat, dan stroberi untuk memenuhi selera berbeda dari pelanggan kami.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    <span>
                                        Bagaimana saya bisa menjadi mitra atau reseller FarmVest?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Untuk menjadi mitra atau reseller, silakan hubungi kami melalui formulir kontak di website atau melai WA kami dan tim kami akan memberikan informasi lebih lanjut.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                    <span>
                                        Apakah ada program afiliasi yang bisa saya ikuti?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Ya, kami memiliki program afiliasi yang menawarkan komisi kompetitif. Anda dapat mendaftar melalui website kami dan mendapatkan akses ke bahan pemasaran untuk memulai.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                    <span>
                                        Bagaimana saya bisa mendapatkan FarmVest untuk konsumsi pribadi saya?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Anda bisa membeli susu FarmVest melalui official store kami atau mitra resmi terdekat. Kunjungi halaman 'Cara Pembelian' di website kami untuk informasi lebih lanjut.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                                    <span>
                                        Apa kebijakan pengembalian produk FarmVest?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Jika ada masalah dengan produk yang Anda terima, silakan hubungi layanan pelanggan kami dalam waktu 24 jam setelah penerimaan untuk mendiskusikan pengembalian atau pertukaran.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="btn btn-primary btn-lg rounded-0 fw-bold w-100 text-start rounded-1 collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                                    <span>
                                        Di mana saya bisa menemukan informasi nutrisi produk FarmVest?
                                    </span>
                                    <span class="accordion-icon">
                                        <i aria-hidden="true" class="fa-fw fas fa-plus"></i>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Informasi nutrisi untuk semua produk kami dapat ditemukan di label produk dan di website kami. Anda juga dapat menghubungi layanan pelanggan kami untuk informasi lebih detail.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<footer class="footer bg-primary">
    <div class="container py-4">
        <div class="d-flex text-white justify-content-between align-items-center">
            <p class="p-0 m-0" style="font-size: 14px;">Copyright © 2024 Farmvest - All rights Reserved</p>
            <div class="d-flex align-items-center gap-5">

                <p class="p-0 m-0" style="font-size: 14px;">Follow Our Social Media :
                </p>
                <span style="font-size: 30px;">
                    <i class="fab fa-instagram me-2"></i>
                    <i class="fab fa-tiktok me-2"></i>
                    <i class="fab fa-youtube"></i>
                </span>
            </div>
        </div>
    </div>
    <div style=" background-color: #F6F6F6; font-size: 13px;text-align: center;">
        <div class="container py-3">
            <h6 class="text-center fw-bold mb-4">Important: Medical and Legal Disclaimers</h6>
            <p>The content provided by FarmVest on our website is intended for general informational purposes
                only. While we strive to offer accurate and up-to-date information, no guarantee of
                completeness, accuracy, or reliability is provided. Use of our website and reliance on any
                information on it is solely at your own risk. We are not liable for any losses or damages
                incurred from such usage.</p>
            <p>Please note that our website does not offer medical or health advice. The health-related
                information is for educational purposes and should not replace professional advice. We recommend
                consulting relevant professionals for specific advice or concerns.</p>
            <p>The website may feature user testimonials about our products. These reflect individual
                experiences and opinions and may not necessarily represent the experiences of all users.
                Individual results may vary.</p>
        </div>
    </div>
</footer>
<?= $this->endSection() ?>
