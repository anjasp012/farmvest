<?= $this->extend('layouts/app') ?>


<?= $this->section('content') ?>

<div class="pages-content page-mitra">
    <section id="agen-mitra">
        <div class="container">
            <h3 class="fw-bold text-primary text-center mb-4">
                PESANAN SAYA
            </h3>
            <?php foreach ($pesanans as $key => $pesanan) : ?>
                <div class="card border-0 shadow-sm mb-2">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-2"><?= $pesanan['no_invoice'] ?></div>
                            <div class="col-md-2 text-center"><?= $pesanan['nama'] ?></div>
                            <div class="col-md-2 text-center"><?= $pesanan['total_harga'] ?></div>
                            <div class="col-md-2 text-center"><?= $pesanan['nama'] ?></div>
                            <div class="col-md-3 text-center"><?= $pesanan['status'] ?></div>
                            <div class="col-md-1 text-end"><i class="bi bi-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
