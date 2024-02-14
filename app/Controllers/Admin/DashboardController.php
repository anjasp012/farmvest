<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlamatModel;
use CodeIgniter\HTTP\ResponseInterface;
use Kavist\RajaOngkir\RajaOngkir;
use CodeIgniter\API\ResponseTrait;

class DashboardController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('admin/dashboard');
    }

    public function setting_alamat_pengiriman()
    {
        $rajaOngkir = new RajaOngkir('f211954a58b0e3a497d6da34cda1735b');
        $alamatModel = new AlamatModel();
        $data = [
            'provinsi' => $rajaOngkir->provinsi()->all(),
            'alamat' => $alamatModel->first(),
        ];
        return view('admin/setting_alamat_pengiriman', $data);
    }

    public function setting_alamat_pengiriman_get_kota($province_id)
    {
        $rajaOngkir = new RajaOngkir('f211954a58b0e3a497d6da34cda1735b');
        $daftarKota = $rajaOngkir->kota()->dariProvinsi($province_id)->get();
        return $this->respond(['kota' => $daftarKota], 200);
    }

    public function setting_alamat_pengiriman_update()
    {
        helper(['form', 'url']);

        //define validation
        $validation = $this->validate([
            'nama_pengirim' => 'required',
            'no_telp' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'alamat_lengkap' => 'required',
        ]);

        if (!$validation) {
            //render view with error validation message
            return redirect()->back()->withInput()->with('validation', $this->validator);
        } else {
            //insert data into database
            $alamatModel = new AlamatModel();
            $alamat = $alamatModel->first();
            $alamatModel->update($alamat['id'], [
                'nama_pengirim'   => $this->request->getPost('nama_pengirim'),
                'no_telp' => $this->request->getPost('no_telp'),
                'province_id' => $this->request->getPost('province_id'),
                'city_id' => $this->request->getPost('city_id'),
                'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Alamat Berhasil Diupdate');

            return redirect()->route('Admin\DashboardController::index');
        }
    }
}
