<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="pages-content page-home">
    <section id="keranjang">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-primary bg-secondary shadow">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title">Pilih Metode Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <div class="fw-bold">Total berat Paket</div>
                                <div class="fw-bold"><?= $berat ?> G</div>
                            </div>
                            <p>Total berat paket diambil dari angka terbesar berdasarkan hasil
                                perbandingan berat aktual (diukur menggunakan timbangan) dan berat
                                volumetrik (dihitung berdasarkan volume barang).</p>

                            <div class="accordion" id="accordionExample">
                                <?php foreach ($couriers as $key => $courier) : ?>
                                    <?php
                                    $bg = rand(100, 900);
                                    $color = 'white';
                                    $icon = 'https://placehold.co/45/' . $bg . '/' . $color . '?text=' . $courier['code']; ?>
                                    <div class="accordion-item border-primary mb-2 border rounded-3 overflow-hidden">
                                        <h2 class="accordion-header border-primary">
                                            <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#<?= str_replace(' ', '', $key) ?>" aria-expanded="true" aria-controls="<?= str_replace(' ', '', $key) ?>">
                                                <?= $courier['name'] ?>
                                            </button>
                                        </h2>
                                        <div id="<?= str_replace(' ', '', $key) ?>" class="accordion-collapse collapse bg-light  border-primary" data-bs-parent="#accordionExample">
                                            <div class="accordion-body bg-secondary">
                                                <?php foreach ($courier['costs'] as $key => $costs) : ?>
                                                    <div class="row g-3 align-items-center mb-2">
                                                        <div class="col-auto">
                                                            <input class="form-check-input border-primary" type="radio" name="pengiriman" id="<?= $courier['code'] ?><?= str_replace(' ', '', $costs['service']) ?>" data-kurir="<?= $courier['code'] ?> (<?= $costs['service'] ?>)" value="<?= number_format($costs['cost'][0]['value'], '0', '0', '.') ?>">
                                                        </div>
                                                        <div style="cursor: pointer;" onclick="$('#<?= $courier['code'] ?><?= str_replace(' ', '', $costs['service']) ?>').click()" class="col-auto">
                                                            <div class="bg-white rounded" style="height: 45px;width: 45px;background-image: url('<?= $icon ?>');background-size: contain ;background-repeat: no-repeat; background-position: center">
                                                            </div>
                                                        </div>
                                                        <div style="cursor: pointer;" onclick="$('#<?= $courier['code'] ?><?= str_replace(' ', '', $costs['service']) ?>').click()" class="col-10">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <div class="fw-bold">
                                                                        <?= $costs['service'] ?>
                                                                    </div>
                                                                    <small><?= $costs['description'] ?> (<?= $costs['cost'][0]['etd'] ?> hari) </small>
                                                                </div>
                                                                <div class="fw-bold">
                                                                    Rp <?= number_format($costs['cost'][0]['value'], '0', '0', '.') ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="<?= base_url('pembayaran') ?>" method="post">
                        <div class="card border-primary bg-secondary shadow">
                            <div class="card-header bg-secondary">
                                <h5 class="card-title">Ringkasan Pembelian</h5>
                            </div>
                            <div class="card-body py-4">
                                <div class="row g-3 mb-2">
                                    <div class="col-6">
                                        <p class="m-0">Total Harga Produk</p>
                                        <small class="text-muted"><?= $jumlahBarang ?> barang</small>
                                    </div>
                                    <div class="col-6">
                                        <p class="fw-bold m-0 text-end">Rp <?= number_format($total, '0', '0', '.') ?></p>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <p class="m-0">Ongkos Kirim</p>
                                        <small class="text-muted"><?= $berat ?> G</small>
                                    </div>
                                    <div class="col-6">
                                        <input required readonly class="fw-bold m-0 text-end form-control-plaintext" name="ongkir" id="ongkos" value="" />
                                        <input hidden required readonly class="fw-bold m-0 text-end form-control-plaintext" name="kurir" id="kurir" value="" />
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center">
                                    <div class="col-6">
                                        <p class="m-0">Total Harga Order</p>
                                    </div>
                                    <div class="col-6">
                                        <input class="fw-bold m-0 text-end form-control-plaintext" readonly id="totalOrder" value="Rp <?= number_format($total, '0', '0', '.') ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-secondary border-0">
                                <button class="btn btn-success w-100">Pilih Pembayaran</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var metodePembayaran = $('input[name="pengiriman"]').click(function() {
        var total = '<?= number_format($total, '0', '0', '.') ?>'
        $('#ongkos').val('Rp ' + $(this).val())
        $('#kurir').val($(this).data('kurir'))
        var nilai1 = parseFloat(total.replace(/\./g, '').replace(',', '.'));
        var nilai2 = parseFloat($(this).val().replace(/\./g, '').replace(',', '.'));
        var total = nilai1 + nilai2;
        var totalFormatted = total.toLocaleString('id-ID');
        $('#totalOrder').val('Rp ' + totalFormatted)
    });
</script>
<?= $this->endSection() ?>
