<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="pages-content page-home">
    <section id="keranjang">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card border-primary bg-secondary shadow">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title">Keranjang Saya</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <?php foreach ($keranjang as $key => $item) : ?>
                                    <tr class="align-middle" id="tr<?= $item['id'] ?>">
                                        <!-- <td>
                                                                <input type="checkbox" class="form-check-input">
                                                            </td> -->
                                        <td style=" width: 12%;" class="text-center">
                                            <img src="<?= asset('uploads/images/produk/' . $item['thumbnail']) ?>" class="w-75 rounded-3" alt="">
                                        </td>
                                        <td>
                                            <div class="fw-bold"><?= $item['nama'] ?></div>
                                            <small>Rp <?= number_format($item['harga'], '0', '0', '.') ?></small>

                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button id="qty-min<?= $item['produk_id'] ?>" class="btn btn-outline-dark" <?= $item['qty'] <= 1 ? 'disabled' : '' ?>><i class="bi bi-dash"></i></button>
                                                <input name="qty" type="button" class="btn btn-white px-3" value="<?= $item['qty'] ?>" id="qty-val<?= $item['produk_id'] ?>">
                                                <button id="qty-plus<?= $item['produk_id'] ?>" class="btn btn-outline-dark"><i class="bi bi-plus"></i></button>
                                            </div>
                                            <?= $this->section('script') ?>
                                            <script>
                                                $('#qty-min<?= $item['produk_id'] ?>').click(function() {
                                                    var qty = 1;
                                                    $.ajax({
                                                        url: '<?= base_url('kurang-keranjang ') ?>', // Ganti dengan URL yang sesuai dengan rute Anda
                                                        type: 'POST', // Ganti dengan metode yang sesuai (GET, POST, dll.)
                                                        data: {
                                                            produk_id: '<?= $item['produk_id'] ?>',
                                                            qty: qty,
                                                        },
                                                        success: function(response) {
                                                            if ($('#qty-val<?= $item['produk_id'] ?>').val() <= 2) {
                                                                $('#qty-min<?= $item['produk_id'] ?>').prop('disabled', true);
                                                            }
                                                            $('#sum<?= $item['produk_id'] ?>').text('Rp. ' + response.keranjangUpdate);
                                                            $('#qty-val<?= $item['produk_id'] ?>').val(+$('#qty-val<?= $item['produk_id'] ?>').val() - 1);
                                                            $('#total').html(response.total)
                                                        },
                                                        error: function(xhr, status, error) {
                                                            // Handle kesalahan jika ada
                                                            console.error(xhr.responseText);
                                                        }
                                                    });
                                                })
                                                $('#qty-plus<?= $item['produk_id'] ?>').click(function() {
                                                    var qty = 1;
                                                    $.ajax({
                                                        url: '<?= base_url('tambah-keranjang ') ?>', // Ganti dengan URL yang sesuai dengan rute Anda
                                                        type: 'POST', // Ganti dengan metode yang sesuai (GET, POST, dll.)
                                                        data: {
                                                            produk_id: '<?= $item['produk_id'] ?>',
                                                            qty: qty,
                                                        },
                                                        success: function(response) {
                                                            // Handle respons dari server di sini
                                                            if ($('#qty-val<?= $item['produk_id'] ?>').val() > 0) {
                                                                $('#qty-min<?= $item['produk_id'] ?>').removeAttr('disabled');
                                                            }
                                                            $('#qty-val<?= $item['produk_id'] ?>').val(+$('#qty-val<?= $item['produk_id'] ?>').val() + 1);
                                                            $('#sum<?= $item['produk_id'] ?>').text('Rp. ' + response.keranjangUpdate);
                                                            $('#total').html(response.total)
                                                        },
                                                        error: function(xhr, status, error) {
                                                            // Handle kesalahan jika ada
                                                            console.error(xhr.responseText);
                                                        }
                                                    });
                                                })
                                            </script>
                                            <?= $this->endSection() ?>
                                        </td>
                                        <td>
                                            <div class="fw-bold" id="sum<?= $item['produk_id'] ?>">Rp <?= number_format($item['harga'] * $item['qty'], '0', '0', '.') ?></div>
                                        </td>
                                        <td>
                                            <button id="delKeranjang<?= $item['id'] ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            <?= $this->section('script') ?>
                                            <script>
                                                $('#delKeranjang<?= $item['id'] ?>').click(function() {
                                                    $.ajax({
                                                        url: '<?= base_url('hapus-keranjang ') ?>', // Ganti dengan URL yang sesuai dengan rute Anda
                                                        type: 'POST', // Ganti dengan metode yang sesuai (GET, POST, dll.)
                                                        data: {
                                                            id: '<?= $item['id'] ?>',
                                                        },
                                                        success: function(response) {
                                                            // Handle respons dari server di sini
                                                            $('#tr<?= $item['id'] ?>').remove()
                                                            $('#total').html(response.total)
                                                        },
                                                        error: function(xhr, status, error) {
                                                            // Handle kesalahan jika ada
                                                            console.error(xhr.responseText);
                                                        }
                                                    });
                                                })
                                            </script>
                                            <?= $this->endSection() ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-primary bg-secondary shadow">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title">Ringkasan Pembelian</h5>
                        </div>
                        <div class="card-body py-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-6">
                                    <p class="m-0">Total Harga Produk</p>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bold m-0 text-end" id="total">Rp <?= number_format($total, '0', '0', '.') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-secondary border-0">
                            <a href="<?= base_url('alamat') ?>" class="btn btn-success w-100">Order Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="container border-primary my-0">
    <section id="katalog" style="padding-top:40px">
        <div class="container">
            <h5 class="fw-bold mt-0 mb-4">Katalog Produk</h5>
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
                                        <div class="btn-group" role="group" aria-label="Basic example" id="qty-modal<?= $produk['id'] ?>">
                                            <button type="button" class="btn btn-primary" id="qty-modal-min<?= $produk['id'] ?>"><i class="fa-fw fas fa-minus"></i></button>
                                            <input name="qty" type="button" class="btn btn-white px-4" value="1" id="qty-modal-val<?= $produk['id'] ?>">
                                            <button type="button" class="btn btn-primary" id="qty-modal-plus<?= $produk['id'] ?>"><i class="fa-fw fas fa-plus"></i></button>
                                        </div>
                                        <?= $this->section('script') ?>
                                        <script>
                                            $('#qty-modal-min<?= $produk['id'] ?>').click(function() {
                                                $('#qty-modal-val<?= $produk['id'] ?>').val(+$('#qty-modal-val<?= $produk['id'] ?>').val() - 1);
                                            })
                                            $('#qty-modal-plus<?= $produk['id'] ?>').click(function() {
                                                $('#qty-modal-val<?= $produk['id'] ?>').val(+$('#qty-modal-val<?= $produk['id'] ?>').val() + 1);
                                            })
                                        </script>
                                        <?= $this->endSection() ?>

                                    </div>
                                    <button type="button" class="btn btn-primary w-100" id="btn-keranjang<?= $produk['id'] ?>">Tambah Ke Keranjang</button>
                                    <?= $this->section('script') ?>
                                    <script>
                                        $('#btn-keranjang<?= $produk['id'] ?>').click(function() {
                                            var qty = $('#qty-modal-val<?= $produk['id'] ?>').val();
                                            console.log(qty);
                                            stop();
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
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
