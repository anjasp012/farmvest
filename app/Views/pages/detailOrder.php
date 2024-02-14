<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="pages-content page-home">
    <section id="keranjang">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-7">
                    <div class="card border-primary bg-secondary shadow mb-4">
                        <div class="card-header bg-secondary">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">No Order: <span class="text-primary fw-bold"><?= $data['no_invoice'] ?></span></h5>
                                <p class="text-danger fw-bold"><?= $data['status'] ?></p>
                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                    <div class="accordion mb-4 shadow" id="accordionRincian">
                        <div class="accordion-item border-primary mb-2 border rounded-3 overflow-hidden">
                            <h2 class="accordion-header border-primary">
                                <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#rincian" aria-expanded="true" aria-controls="rincian">
                                    <h5 class="card-title">Rincian Pembelian</h5>
                                </button>
                            </h2>
                            <div id="rincian" class="accordion-collapse collapse bg-light  border-primary" data-bs-parent="#accordionRincian">
                                <div class="accordion-body bg-secondary">
                                    <table class="table table-borderless">
                                        <?php foreach ($order_items as $key => $item) : ?>
                                            <tr>
                                                <!-- <td>
                                                                <input type=" checkbox" class="form-check-input">
                                                </td> -->
                                                <td style=" width: 10%;" class="text-center">
                                                    <img src="<?= asset('uploads/images/produk/' . $item['thumbnail']) ?>" class="w-100 rounded-1" alt="">
                                                </td>
                                                <td>
                                                    <div class="fw-bold"><?= $item['nama'] ?></div>
                                                    <small>Rp <?= number_format($item['harga'], '0', '0', '.') ?></small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <input name="qty" type="button" class="btn btn-white px-3" value="<?= $item['qty'] ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="fw-bold text-end">Rp <?= number_format($item['harga'] * $item['qty'], '0', '0', '.') ?></div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr class="border-top border-primary">
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="fw-bold text-end">Total</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-end">Rp <?= number_format($data['total_harga'], '0', '0', '.') ?></div>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion shadow" id="accordionInformasi">
                        <div class="accordion-item border-primary mb-2 border rounded-3 overflow-hidden">
                            <h2 class="accordion-header border-primary">
                                <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#informasi" aria-expanded="true" aria-controls="informasi">
                                    <h5 class="card-title">Informasi Pengiriman</h5>
                                </button>
                            </h2>
                            <div id="informasi" class="accordion-collapse collapse bg-light  border-primary" data-bs-parent="#accordionInformasi">
                                <div class="accordion-body bg-secondary">
                                    <?php
                                    $bg = rand(100, 900);
                                    $color = 'white';
                                    $icon = 'https://placehold.co/55/' . $bg . '/' . $color . '?text=' . 'jne'; ?>
                                    <div class="d-flex gap-3 w-100 align-items-center">
                                        <div>
                                            <div class="bg-white rounded" style="height: 55px;width: 55px;background-image: url('<?= $icon ?>');background-size: contain ;background-repeat: no-repeat; background-position: center">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <div>
                                                <div class="fw-bold">JNE OK (2-4 hari) </div>
                                                <small>
                                                    Rp 20.000
                                                </small>
                                            </div>
                                            <div class="fw-bold text-end text-danger">BELUM DIKIRIM</div>
                                        </div>
                                    </div>
                                    <hr class="mx-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <small>Nama Penerima</small>
                                                <div class="fw-semibold"><?= $data['nama'] ?></div>
                                            </div>
                                            <div class="mb-2">
                                                <small>Nomor HP Penerima</small>
                                                <div class="fw-semibold"><?= $data['phone'] ?></div>
                                            </div>
                                            <div class="mb-2">
                                                <small>Email Penerima</small>
                                                <div class="fw-semibold"><?= $data['email'] ?></div>
                                            </div>
                                            <div class="mb-2">
                                                <small>Alamat Penerima</small>
                                                <div class="fw-semibold">Klaten</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <small>Nama Pengirim</small>
                                                <div class="fw-semibold">FARMVEST ID</div>
                                            </div>
                                            <div class="mb-2">
                                                <small>Nomor HP Pengirim</small>
                                                <div class="fw-semibold">085274441530</div>
                                            </div>
                                            <div class="mb-2">
                                                <small>Alamat Pengirim</small>
                                                <div class="fw-semibold">Meadow Green Residence No 3. Jl. Taman Makam Pahlawan RT 02 RW 01, Kalimulya, Kec. Cilodong
                                                    KOTA DEPOK - CILODONG</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-primary bg-secondary shadow">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title">Instruksi Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
