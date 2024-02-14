<?= $this->extend('layouts/admin') ?>

<?= $this->section('style') ?>
<link href="<?= asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk</h1>
        <a href="<?= route_to('Admin\ProdukController::new') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $no => $item) : ?>
                            <tr>
                                <td><?= $no + 1 ?></td>
                                <td><?= $item['nama'] ?></td>
                                <td style="max-width: 5%;"><img src="<?= asset('uploads/images/produk/' . $item['thumbnail']) ?>" width="50px" alt=""></td>
                                <td>Rp.<?= number_format($item['harga'], '0', '0', '.') ?></td>
                                <td>
                                    <form action="<?= route_to('Admin\ProdukController::delete', $item['id']) ?>" method="POST">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <a href="<?= route_to('Admin\ProdukController::edit', $item['id']) ?>" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-pen fa-sm text-white-50"></i> Edit</a>
                                        <button class="d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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
