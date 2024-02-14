<?= $this->extend('layouts/admin') ?>

<?= $this->section('style') ?>
<link href="<?= asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
        </div>
        <div class="card-body">
            <form action="<?= route_to('Admin\ProdukController::create') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="harga" class="form-label">Harga Produk</label>
                    <input type="text" name="harga" id="harga" class="form-control">
                </div>
                <div class="form-group">
                    <label for="berat" class="form-label">Berat Produk</label>
                    <input type="text" name="berat" id="berat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="thumbnail" class="form-label">Foto Produk</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="<?= route_to('Admin\ProdukController::index') ?>" class="d-sm-inline-block btn btn-secondary shadow-sm mr-2"><i class="fas fa-save fa-sm text-white-50"></i> Batal</a>
                    <button class="d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan Produk</button>


                </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= asset('sb-admin/js/demo/datatables-demo.js') ?>"></script>
<?= $this->endSection() ?>
