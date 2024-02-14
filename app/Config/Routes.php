<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/list-agen-resmi', 'Home::list_agen_resmi');
$routes->get('/login', 'AuthController::index', ['filter' => 'guest']);
$routes->post('/register', 'AuthController::save', ['filter' => 'guest']);
$routes->post('/login', 'AuthController::auth', ['filter' => 'guest']);
$routes->post('/logout', 'AuthController::logout', ['filter' => 'auth']);
$routes->get('/keranjang', 'Home::keranjang', ['filter' => 'auth']);
$routes->post('/tambah-keranjang', 'Home::tambahKeranjang', ['filter' => 'auth']);
$routes->post('/kurang-keranjang', 'Home::kurangKeranjang', ['filter' => 'auth']);
$routes->post('/hapus-keranjang', 'Home::hapusKeranjang', ['filter' => 'auth']);
$routes->get('/alamat', 'Home::alamat', ['filter' => 'auth']);
$routes->get('/pengiriman', 'Home::pengiriman', ['filter' => 'auth']);
$routes->post('/pembayaran', 'Home::pembayaran', ['filter' => 'auth']);
$routes->post('/checkout', 'Home::checkout', ['filter' => 'auth']);
$routes->get('/order/(:segment)', 'Home::order/$1', ['filter' => 'auth']);
$routes->get('/pesanan-saya', 'Home::pesanan_saya', ['filter' => 'auth']);

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->get('setting-alamat-pengiriman', 'Admin\DashboardController::setting_alamat_pengiriman');
    $routes->post('setting-alamat-pengiriman-get-kota/(:segment)', 'Admin\DashboardController::setting_alamat_pengiriman_get_kota/$1');
    $routes->put('setting-alamat-pengiriman', 'Admin\DashboardController::setting_alamat_pengiriman_update');
    $routes->resource('manajemen-produk', ['controller' => 'Admin\ProdukController']);
});
