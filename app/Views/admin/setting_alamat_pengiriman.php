<?= $this->extend('layouts/admin') ?>

<?= $this->section('style') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Setting Alamat</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Alamat</h6>
        </div>
        <div class="card-body">
            <form action="<?= route_to('Admin\DashboardController::setting_alamat_pengiriman_update') ?>" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                    <input type="text" class="form-control" name="nama_pengirim" value="<?= @$alamat['nama_pengirim'] ?>">
                </div>
                <div class="form-group">
                    <label for="no_telp" class="form-label">No Telp</label>
                    <input type="text" class="form-control" name="no_telp" value="<?= @$alamat['no_telp'] ?>">
                </div>
                <div class="form-group">
                    <label for="province_id" class="form-label">Provinsi</label>
                    <select class="form-control" name="province_id" id="province_id">
                        <?php foreach ($provinsi as $item) : ?>
                            <option value="" disabled <?= @$alamat['province_id'] ? '' : 'selected' ?>></option>
                            <option <?= @$alamat['province_id'] == $item['province_id'] ? 'selected' : '' ?> value="<?= $item['province_id'] ?>"><?= $item['province'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city_id" class="form-label">Kota</label>
                    <select class="form-control" name="city_id" id="city_id">

                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control"><?= @$alamat['alamat_lengkap'] ?></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="<?= route_to('Admin\DashboardController::index') ?>" class="d-sm-inline-block btn btn-secondary shadow-sm mr-2"><i class="fas fa-save fa-sm text-white-50"></i> Batal</a>
                    <button class="d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Simpan Alamat</button>


                </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('select').select2({
        theme: 'bootstrap4',
    });

    var provinceId = $('#province_id').val();
    if (provinceId != null) {
        $.ajax({
            url: '/admin/setting-alamat-pengiriman-get-kota/' + provinceId,
            type: 'POST',
            success: function(response) {
                $('#city_id').empty();
                <?php if ($alamat && !is_null($alamat['city_id'])) : ?>
                    var selectedCityId = <?= json_encode($alamat['city_id']) ?>;
                <?php else : ?>
                    var selectedCityId = null;
                <?php endif; ?>
                response.kota.forEach(function(city) {
                    $('#city_id').append(
                        `<option ${selectedCityId == city.city_id ? 'selected' : ''} value="${city.city_id}">${city.city_name}</option>`
                    );
                });
            },
            error: function(error) {
                console.error('Error fetching cities:', error);
            }
        });
    }
    $('#province_id').on('change', function() {
        var provinceId = $(this).val();
        $.ajax({
            url: '/admin/setting-alamat-pengiriman-get-kota/' + provinceId,
            type: 'POST',
            success: function(response) {
                $('#city_id').empty();
                response.kota.forEach(function(city) {
                    $('#city_id').append(
                        `<option value="${city.city_id}">${city.city_name}</option>`
                    );
                });
            },
            error: function(error) {
                console.error('Error fetching cities:', error);
            }
        });
    });
</script>

<?= $this->endSection() ?>
