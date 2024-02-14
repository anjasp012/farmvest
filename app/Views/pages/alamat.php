<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="pages-content page-home">
    <section id="keranjang">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card border-primary bg-secondary shadow">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title">Informasi Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="fw-bold"><?= $alamatPenerimaan['nama_penerima'] ?></div>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <!-- Modal -->
                                    </div>
                                    <div><?= $alamatPenerimaan['no_telp'] ?></div>
                                    <div>krenekan, klepu, ceper, klaten</div>
                                    <div><?= $alamatPenerimaan['alamat_lengkap'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Informasi Pengiriman</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <button class="btn btn-warning w-100 mb-2">Tambah</button>
                                        <?php foreach ($detailUser as $key => $item) : ?>
                                            <div class="card mb-2 <?= $item['status'] ? 'bg-secondary' : '' ?>">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <div class="fw-bold"><?= $item['nama_penerima'] ?></div>
                                                            <div><?= $item['no_telp'] ?></div>
                                                            <div>krenekan, klepu, ceper, klaten</div>
                                                            <div><?= $item['alamat_lengkap'] ?></div>
                                                        </div>

                                                        <!-- Button trigger modal -->
                                                        <div class="flex">
                                                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                Edit
                                                            </button>
                                                            <?php if ($item['status']) : ?>
                                                                <i class="bi bi-check"></i>
                                                            <?php else : ?>
                                                                <button type="button" class="btn btn-sm btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                    Pilih
                                                                </button>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- Modal -->
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-primary">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title">Tambahkan Catatan (optional)</h5>
                        </div>
                        <div class="card-body">
                            <textarea name="Catatan" id="Catatan" rows="1" class="form-control bg-secondary border-primary"></textarea>
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
                                    <small><?= $jumlahBarang ?> barang</small>
                                </div>
                                <div class="col-6">
                                    <p class="fw-bold m-0 text-end">Rp <?= number_format($total, '0', '0', '.') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-secondary border-0">
                            <a href="<?= base_url('pengiriman') ?>" class="btn btn-success w-100">Pilih Pengiriman</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
