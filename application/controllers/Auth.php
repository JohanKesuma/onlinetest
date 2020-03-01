<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("UserModel");
        $this->load->library('form_validation');
    }

    public function index()
    {

        // Form Validation
        $this->form_validation->set_rules('nis', "NIS", 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Login";

            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }
    
    private function _login()
    {
        $nis = $this->input->post('nis');
        $password = $this->input->post('password');

        $user = $this->UserModel->getByIdentityNumber($nis);

        if ($user) { // jika user ada
            // cek password
            if (password_verify($password, $user['password'])) {
                // login berhasil
                if ($user['role'] == 0) {
                    // jika admin
                    redirect('admin');
                }
            }
        }
        
    }
}
