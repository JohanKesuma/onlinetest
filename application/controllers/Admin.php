<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index()
    {
        $data['user'] = $this->UserModel->getByIdentityNumber(1001);
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function daftarSiswa()
    {
        $data['user'] = $this->UserModel->getByIdentityNumber(1001);
        $data['title'] = 'Daftar Siswa';
        $data['daftarSiswa'] = $this->UserModel->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/daftarsiswa', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSiswa()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nis', "NIS", 'required|trim|is_unique[user.identity_number]');
        $this->form_validation->set_rules('name', "Nama", 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => "Password tidak cocok.",
            'min_length' => 'Password minimal 3 huruf.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == true) {
            $this->UserModel->insert();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data siswa berhasil diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/tambahsiswa');
            return;
        }

        $data['user'] = $this->UserModel->getByIdentityNumber(1001); // admin
        $data['title'] = 'Tambah Siswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tambahsiswa', $data);
        $this->load->view('templates/footer');
    }

    public function ubahSiswa($nis)
    {
        $this->load->library('form_validation');

        
        $number = $this->input->post('nis');
        if ($number) {
            if ($nis == $number) {
                $is_unique = '';
            }
            else {
                $is_unique = '|is_unique[user.identity_number]';
            }
        } else {
            $is_unique = '|is_unique[user.identity_number]';
        }

        echo($is_unique);

        $this->form_validation->set_rules('nis', "NIS", 'required|trim'.$is_unique);
        $this->form_validation->set_rules('name', "Nama", 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['siswa'] = $this->UserModel->getByIdentityNumber($nis);
            $data['user'] = $this->UserModel->getByIdentityNumber(1001);
            $data['title'] = 'Ubah Siswa';
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/ubahsiswa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->UserModel->update($nis);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data siswa berhasil diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/daftarsiswa');
        }
    }
}
