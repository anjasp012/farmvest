<?php

namespace App\Controllers;

use App\Models\BankModel;
use App\Models\DetailOrderModel;
use App\Models\DetailUserModel;
use App\Models\KeranjangModel;
use App\Models\OrderModel;
use App\Models\ProdukModel;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Request;
use Kavist\RajaOngkir\RajaOngkir;
use Tripay\Main;

class Home extends BaseController
{
    use ResponseTrait;

    // protected $main;
    protected $userModel;
    protected $keranjangModel;
    protected $BankModel;
    protected $detailUserModel;
    protected $produkModel;
    protected $orderModel;
    protected $detailOrderModel;
    protected $rajaOngkir;
    public function __construct()
    {
        $this->userModel = new User();
        $this->keranjangModel = new KeranjangModel();
        $this->BankModel = new BankModel();
        $this->detailUserModel = new DetailUserModel();
        $this->produkModel = new ProdukModel();
        $this->orderModel = new OrderModel();
        $this->detailOrderModel = new DetailOrderModel();
        // $this->main = new Main(
        //     'DEV-cZmSshU8a6Lw4YzFesr0sK9sxiP6pwGpltbzSvwd',
        //     'N1YYM-i1y9W-1KoDM-eOVHJ-9bpo6',
        //     'T24380',
        //     'sandbox' // fill for sandbox mode, leave blank if in production mode
        // );
        $this->rajaOngkir = new RajaOngkir('f211954a58b0e3a497d6da34cda1735b');
    }

    public function index()
    {
        helper(['form']);
        $data = [
            'produks' => $this->produkModel->findAll()
        ];
        // dd($data);
        return view('pages/index', $data);
    }

    public function list_agen_resmi()
    {
        $data = [
            'produks' => $this->produkModel->findAll()
        ];
        return view('pages/list_agen_resmi', $data);
    }

    public function keranjang()
    {
        $keranjang = $this->keranjangModel
            ->select('keranjang.*, produk.nama, produk.thumbnail') // Select desired columns from both tables
            ->join('produk', 'produk.id = keranjang.produk_id')
            ->where('keranjang.user_id', session()->get('id'))
            ->findAll();
        $total = 0;
        foreach ($keranjang as $key => $item) {
            $total += $item['qty'] * $item['harga'];
        };
        $data = [
            'keranjang' => $keranjang,
            'total' => $total,
            'produks' => $this->produkModel->findAll()
        ];
        return view('pages/keranjang', $data);
    }

    public function tambahKeranjang()
    {
        $produkId = $this->request->getPost('produk_id');
        $jumlah = $this->request->getPost('qty');
        $produk = $this->produkModel->find($produkId);
        $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->where('produk_id', $produkId)->first();
        $keranjangUpdate = 0;
        if ($keranjang) {
            $this->keranjangModel->update($keranjang['id'], [
                'user_id' => session()->get('id'),
                'produk_id' => $produkId,
                'qty' => $keranjang['qty'] + $jumlah,
                'harga' => $produk['harga'],
            ]);
            $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->where('produk_id', $produkId)->first();
            $keranjangUpdate = number_format($keranjang['harga'] * $keranjang['qty'], '0', '0', '.');
        } else {
            $this->keranjangModel->insert([
                'user_id' => session()->get('id'),
                'produk_id' => $produkId,
                'qty' => $jumlah,
                'harga' => $produk['harga'],
            ]);
        };
        $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->findAll();
        $total = 0;
        foreach ($keranjang as $key => $item) {
            $total += $item['qty'] * $item['harga'];
        };
        $data = [
            'keranjangUpdate' => $keranjangUpdate,
            'total' => 'Rp ' . number_format($total, '0', '0', '.'),
            'keranjang' => $keranjang
        ];
        return $this->respond($data, 200);
    }

    public function kurangKeranjang()
    {
        $produkId = $this->request->getPost('produk_id');
        $jumlah = $this->request->getPost('qty');
        $produk = $this->produkModel->find($produkId);
        $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->where('produk_id', $produkId)->first();
        $keranjangUpdate = 0;
        $this->keranjangModel->update($keranjang['id'], [
            'user_id' => session()->get('id'),
            'produk_id' => $produkId,
            'qty' => $keranjang['qty'] - $jumlah,
            'harga' => $produk['harga'],
        ]);
        $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->where('produk_id', $produkId)->first();
        $keranjangUpdate = number_format($keranjang['harga'] * $keranjang['qty'], '0', '0', '.');

        $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->findAll();
        $total = 0;
        foreach ($keranjang as $key => $item) {
            $total += $item['harga'] * $item['qty'];
        };
        $data = [
            'keranjangUpdate' => $keranjangUpdate,
            'total' => 'Rp ' . number_format($total, '0', '0', '.')
        ];
        return $this->respond($data, 200);
    }

    public function hapusKeranjang()
    {
        $id = $this->request->getPost('id');
        $this->keranjangModel->delete($id);
        $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->findAll();
        $total = 0;
        foreach ($keranjang as $key => $item) {
            $total += $item['harga'] * $item['qty'];
        };
        $data = [
            'total' => 'Rp ' . number_format($total, '0', '0', '.')
        ];
        return $this->respond($data, 200);
    }

    public function alamat()
    {
        $detailUser = $this->detailUserModel->where('user_id', session()->get('id'))->findAll();
        $alamatPenerimaan = $this->detailUserModel->where('user_id', session()->get('id'))->where('status', 1)->first();
        $keranjang = $this->keranjangModel->where('user_id', session()->get('id'))->findAll();
        $total = 0;
        $jumlahBarang = 0;
        foreach ($keranjang as $key => $item) {
            $total += $item['harga'] * $item['qty'];
            $jumlahBarang += $item['qty'];
        };
        $data = [
            'alamatPenerimaan' => $alamatPenerimaan,
            'total' => $total,
            'jumlahBarang' => $jumlahBarang,
            'keranjang' => $keranjang,
            'detailUser' => $detailUser,
        ];
        return view('pages/alamat', $data);
    }

    public function pengiriman()
    {
        $keranjang = $this->keranjangModel
            ->select('keranjang.*, produk.nama, produk.thumbnail, produk.berat') // Select desired columns from both tables
            ->join('produk', 'produk.id = keranjang.produk_id')
            ->where('keranjang.user_id', session()->get('id'))
            ->findAll();
        $jumlahBarang = 0;
        $total = 0;
        $berat = 0;
        foreach ($keranjang as $key => $item) {
            $total += $item['harga'] * $item['qty'];
            $jumlahBarang += $item['qty'];
            $berat += $item['berat'];
        };
        $jne = $this->rajaOngkir->ongkosKirim([
            'origin'        => 155,     // ID kota/kabupaten asal
            'destination'   => 80,      // ID kota/kabupaten tujuan
            'weight'        => $berat,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ]);
        $tiki = $this->rajaOngkir->ongkosKirim([
            'origin'        => 155,     // ID kota/kabupaten asal
            'destination'   => 80,      // ID kota/kabupaten tujuan
            'weight'        => $berat,    // berat barang dalam gram
            'courier'       => 'tiki'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ]);
        $pos = $this->rajaOngkir->ongkosKirim([
            'origin'        => 155,     // ID kota/kabupaten asal
            'destination'   => 80,      // ID kota/kabupaten tujuan
            'weight'        => $berat,    // berat barang dalam gram
            'courier'       => 'pos'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ]);
        $couriers = array_merge($jne->get(), $tiki->get(), $pos->get());
        // dd($couriers[0]);
        $data = [
            'total' => $total,
            'berat' => $berat,
            'jumlahBarang' => $jumlahBarang,
            'couriers' => $couriers
        ];
        return view('pages/pengiriman', $data);
    }

    public function pembayaran()
    {
        $alamatPenerimaan = $this->detailUserModel->where('user_id', session()->get('id'))->where('status', 1)->first();
        $kurir = $this->request->getPost('kurir');
        $ongkir = str_replace('.', '', str_replace('Rp ', '', $this->request->getPost('ongkir')));
        $keranjang = $this->keranjangModel
            ->select('keranjang.*, produk.nama, produk.thumbnail, produk.berat') // Select desired columns from both tables
            ->join('produk', 'produk.id = keranjang.produk_id')
            ->where('keranjang.user_id', session()->get('id'))
            ->findAll();
        $jumlahBarang = 0;
        $total = 0;
        $berat = 0;
        foreach ($keranjang as $key => $item) {
            $total += $item['harga'] * $item['qty'];
            $jumlahBarang += $item['qty'];
            $berat += $item['berat'];
        };
        // $main = $this->main;
        // $init = $main->initMerchantChannelPembayaran('');
        // $data = $init->getData();
        // $unique_groups = [];
        // foreach ($data as $entry) {
        //     $group = $entry->group;
        //     if (!isset($unique_groups[$group])) {
        //         $unique_groups[$group] = [];
        //     }
        //     $unique_groups[$group][] = $entry;
        // }
        $bank = $this->BankModel->findAll();
        $data = [
            'alamatPenerimaan' => $alamatPenerimaan,
            'total' => $total,
            'kurir' => $kurir,
            'ongkir' => $ongkir,
            'totalOrder' => $total + $ongkir,
            'berat' => $berat,
            'jumlahBarang' => $jumlahBarang,
            // 'methods' => $unique_groups,
            'bank' => $bank,
        ];
        return view('pages/pembayaran', $data);
    }

    public function checkout()
    {
        $user = $this->userModel->find(session()->get('id'));
        $alamatPengiriman = $this->detailUserModel->where('user_id', session()->get('id'))->where('status', 1)->first();
        $method = $this->request->getPost('metodePembayaran');
        $kurir = $this->request->getPost('kurir');
        $ongkir = $this->request->getPost('ongkir');
        $amount = $this->request->getPost('amount');
        die(print_r($this->request->getPost()));
        // $items = [];
        // foreach ($sessionKeranjang as $key => $item) {
        //     $produk = $this->produkModel->find($item['produk_id']);
        //     $items[] = [
        //         'name' => $produk['nama'],
        //         'price' => $produk['harga'],
        //         'quantity' => $item['qty'],
        //         'product_url' => base_url('detail-produk/') . $produk['slug'],
        //         'image_url'   => asset('uploads/images/produk/') . $produk['thumbnail'],
        //     ];
        // }
        // $items[] = [
        //     'name' => 'ongkir',
        //     'price' => $ongkir,
        //     'quantity' => 1
        // ];

        $merchantRef = 'CIFARMVEST-' . rand(1000, 9999); //your merchant reference
        // $main = $this->main;
        // $init = $main->initTransaction($merchantRef);
        // $init->setAmount($amount);
        // $transaction = $init->closeTransaction(); // define your transaction type, for close transaction use `closeTransaction()`
        // $transaction->setPayload([
        //     'method'            => $method, // IMPORTANT, dont fill by `getMethod()`!, for more code method you can check here https://tripay.co.id/developer
        //     'merchant_ref'      => $merchantRef,
        //     'amount'            => $init->getAmount(),
        //     'customer_name'     => $nama,
        //     'customer_email'    => $email,
        //     'customer_phone'    => $phone,
        //     'order_items'       => $items,
        //     'callback_url'      => base_url('callback'),
        //     'return_url'        => base_url('order/') . $merchantRef,
        //     'expired_time'      => (time() + (24 * 60 * 60)), // 24 jam
        //     'signature'         => $init->createSignature()
        // ]);
        // $getData = $transaction->getData();
        // $this->orderModel->insert(
        //     [
        //         'no_invoice' => $getData->merchant_ref,
        //         'no_ref' => $getData->reference,
        //         'nama' => $nama,
        //         'email' => $email,
        //         'phone' => $phone,
        //         'total_harga' => $amount,
        //         'catatan' => '',
        //         'status' => 'menunggu pembayaran',
        //     ]
        // );
        $data = [
            'data' => $getData
        ];
        return $this->respond($data, 200);
    }

    public function order($order)
    {
        $order = $this->orderModel->where('no_invoice', $order)->first();
        $main = $this->main;
        $init = $main->initTransaction($order['no_invoice']);
        $transaction = $init->closeTransaction();
        $detail = $transaction->getDetail($order['no_ref']);
        $detail = $detail->getJson()->data;
        $data = [
            'data' => $detail
        ];
        // dd($data);
        return view('pages/detailOrder', $data);
    }
}
