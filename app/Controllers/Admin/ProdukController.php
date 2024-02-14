<?php

namespace App\Controllers\Admin;

use Dotenv\Util\Str;
use App\Models\ProdukModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{
    protected $produkModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'produk' => $this->produkModel->findAll()
        ];
        return view('admin/manajemen-produk/index', $data);
    }

    public function new()
    {
        return view('admin/manajemen-produk/create');
    }

    public function create()
    {

        helper(['form', 'url']);

        //define validation
        $validation = $this->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'berat' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        if (!$validation) {
            //render view with error validation message
            return redirect()->route('Admin\ProdukController::new')->withInput()->with('validation', $this->validator);
        } else {
            //insert data into database
            $this->produkModel->insert([
                'nama'   => $this->request->getPost('nama'),
                'berat' => $this->request->getPost('berat'),
                'harga' => $this->request->getPost('harga'),
                'deskripsi' => $this->request->getPost('deskripsi'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Produk Berhasil Diupdate');

            return redirect()->route('Admin\ProdukController::index');
        }
    }

    public function edit($id)
    {
        $data = [
            'item' => $this->produkModel->find($id),
        ];
        return view('admin/manajemen-produk/edit', $data);
    }

    public function update($id)
    {

        helper(['form', 'url']);

        //define validation
        $validation = $this->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'berat' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        if (!$validation) {
            //render view with error validation message
            return redirect()->route('Admin\ProdukController::edit', $id)->withInput()->with('validation', $this->validator);
        } else {
            //insert data into database
            $this->produkModel->update($id, [
                'nama'   => $this->request->getPost('nama'),
                'berat' => $this->request->getPost('berat'),
                'harga' => $this->request->getPost('harga'),
                'deskripsi' => $this->request->getPost('deskripsi'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Produk Berhasil Diupdate');

            return redirect()->route('Admin\ProdukController::index');
        }
    }

    public function delete($id)
    {
        $this->produkModel->delete($id);

        session()->setFlashdata('message', 'Post Berhasil Dihapus');

        return redirect()->route('Admin\ProdukController::index');
    }
}
