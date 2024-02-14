<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        helper(['form']);
        return view('auth/login');
    }

    public function save()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role'     => 0
            ];
            $id = $model->save($data);
            $ses_data = [
                'id'       => $id,
                'name'     => $data['name'],
                'email'    => $data['email'],
                'role'    => $data['role'],
                'logged_in'     => TRUE
            ];
            $session = session();
            $session->set($ses_data);
            if ($data['role'] == '1') {
                return $this->respond(['link' => base_url('admin/dashboard')]);
            }
            return $this->respond(['link' => base_url('/')]);
        } else {
            $data['validation'] = $this->validator;
            return $this->respond($data, 200);
        }
    }

    public function authApi($email, $password)
    {
        $session = session();
        $model = new UserModel();
        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id'       => $data['id'],
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'role'    => $data['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                if ($data['role'] == '1') {
                    return $this->respond(['link' => base_url('admin/dashboard')]);
                }
                return $this->respond(['link' => base_url('/')]);
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return $this->respond(['msg' => 'Wrong Password']);
            }
        } else {
            return $this->respond(['msg' => 'Email Not Found']);
        }
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id'       => $data['id'],
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'role'    => $data['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                if ($data['role'] == '1') {
                    return redirect()->to('admin/dashboard');
                }
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
