<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="pages-content page-home">
    <section id="keranjang">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card border-primary bg-secondary shadow">
                        <div class="card-header  bg-secondary">
                            <h5 class="card-title">Pilih Metode Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item border-primary mb-2 border rounded-3 overflow-hidden">
                                    <h2 class="accordion-header border-primary">
                                        <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#bank" aria-expanded="true" aria-controls="bank">
                                            Transfer (Konfirmasi Manual)
                                        </button>
                                    </h2>
                                    <div id="bank" class="accordion-collapse collapse bg-light  border-primary" data-bs-parent="#accordionExample">
                                        <div class="accordion-body bg-secondary">
                                            <?php foreach ($bank as $item) : ?>
                                                <div class="row g-3 align-items-center mb-2">
                                                    <div class="col-auto">
                                                        <input class="form-check-input border-primary" type="radio" name="metodePembayaran" id="<?= $item['id'] ?>" value="<?= $item['id'] ?>">
                                                    </div>
                                                    <div style="cursor: pointer;" onclick="$('#<?= $item['id'] ?>').click()" class="col-auto">
                                                        <div class="bg-white rounded" style="height: 45px;width: 45px;background-image: url('<?= $item['thumbnail'] ?>');background-size: contain ;background-repeat: no-repeat; background-position: center">
                                                        </div>
                                                    </div>
                                                    <div style="cursor: pointer;" onclick="$('#<?= $item['id'] ?>').click()" class="col-9">
                                                        <div>
                                                            <div class="fw-bold">
                                                                <?= $item['no_rek'] ?>
                                                            </div>
                                                            <small><?= $item['bank'] ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-primary bg-secondary shadow">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title">Ringkasan Pembelian</h5>
                        </div>
                        <div class="card-body py-4">
                            <div class="row g-3 mb-2">
                                <div class="col-6">
                                    <p class="m-0">Total Harga Produk</p>
                                    <small class="text-muted">2 barang</small>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bold m-0 text-end">Rp <?= number_format($total, '0', '0', '.') ?></p>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <p class="m-0">Ongkos Kirim</p>
                                    <small class="text-muted">900 g</small>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bold m-0 text-end">Rp <?= number_format($ongkir, '0', '0', '.') ?></p>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-6">
                                    <p class="m-0">Total Harga Order</p>
                                    <!-- <small class="text-muted">900 g</small> -->
                                </div>
                                <div class="col-6">
                                    <input class="fw-bold m-0 text-end form-control-plaintext" id="totalOrder" value="Rp <?= number_format($totalOrder, '0', '0', '.') ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-secondary border-0">
                            <button id="order" class="btn btn-success w-100">Order Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $('#order').click(function() {
        var metodePembayaran = $('input[name="metodePembayaran"]:checked').val();
        var amount = '<?= $totalOrder ?>';
        var ongkir = '<?= $ongkir ?>';
        var kurir = '<?= $kurir ?>';
        $.ajax({
            url: '<?= base_url('checkout') ?>', // Ganti dengan URL yang sesuai dengan rute Anda
            type: 'POST', // Ganti dengan metode yang sesuai (GET, POST, dll.)
            data: {
                metodePembayaran: metodePembayaran,
                amount: amount,
                ongkir: ongkir,
                kurir: kurir
            },
            success: function(response) {
                // Handle respons dari server di sini
                console.log(response.data);
                location.href = response.data
            },
            error: function(xhr, status, error) {
                // Handle kesalahan jika ada
                console.error(xhr.responseText);
            }
        });
    });
</script>
<?= $this->endSection() ?>
