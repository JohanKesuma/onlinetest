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
        $data['parentUrl'] = base_url('admin/daftarsiswa');

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
            } else {
                $is_unique = '|is_unique[user.identity_number]';
            }
        } else {
            $is_unique = '|is_unique[user.identity_number]';
        }

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

    public function hapusSiswa($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data siswa berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/daftarsiswa');
    }

    public function paketSoal()
    {
        $this->load->model('QuestPackagesModel');

        $data['user'] = $this->UserModel->getByIdentityNumber(1001);
        $data['questPackages'] = $this->QuestPackagesModel->getAll();
        $data['title'] = 'Soal';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/paketsoal', $data);
        $this->load->view('templates/footer');
    }

    public function packagedetail($id)
    {
        $this->load->model('QuestionsModel');
        $this->load->model('QuestPackagesModel');

        $name = $this->QuestPackagesModel->getById($id)['name'];

        $data['user'] = $this->UserModel->getByIdentityNumber(1001);
        $data['questions'] = $this->QuestionsModel->getByPackageId($id);
        $data['title'] = $name;
        $data['parentUrl'] = base_url('admin/paketsoal');
        $data['packageId'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/packagedetail', $data);
        $this->load->view('templates/footer');
    }

    public function tambahSoal($packageId)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('soal', "Soal", 'required|trim');
        $this->form_validation->set_rules('pilihan1', "Pilihan 1", 'required|trim');
        $this->form_validation->set_rules('pilihan2', "Pilihan 2", 'required|trim');
        $this->form_validation->set_rules('pilihan3', "Pilihan 3", 'required|trim');
        $this->form_validation->set_rules('pilihan4', "Pilihan 4", 'required|trim');
        $this->form_validation->set_rules('pilihan5', "Pilihan 5", 'required|trim');
        $this->form_validation->set_rules('waktu', "waktu", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->model('QuestPackagesModel');

            $name = $this->QuestPackagesModel->getById($packageId)['name'];
    
            $data['user'] = $this->UserModel->getByIdentityNumber(1001);
            $data['packageId'] = $packageId;
            $data['parentUrl'] = base_url('admin/packagedetail/'.$packageId);
            $data['title'] = 'Tambah Soal ('.$name.')';

    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambahsoal', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->model('QuestionsModel');
            $this->QuestionsModel->insert();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Soal ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/tambahsoal/'.$packageId);
        }
    }

    public function editSoal($question_id)
    {
        $this->load->library('form_validation');
        

        $this->form_validation->set_rules('soal', "Soal", 'required|trim');
        $this->form_validation->set_rules('pilihan1', "Pilihan 1", 'required|trim');
        $this->form_validation->set_rules('pilihan2', "Pilihan 2", 'required|trim');
        $this->form_validation->set_rules('pilihan3', "Pilihan 3", 'required|trim');
        $this->form_validation->set_rules('pilihan4', "Pilihan 4", 'required|trim');
        $this->form_validation->set_rules('pilihan5', "Pilihan 5", 'required|trim');
        $this->form_validation->set_rules('waktu', "waktu", 'required');

        $this->load->model('QuestionsModel');
        if ($this->form_validation->run() == false) {
            $this->load->model('AnswersModel');
            $data['user'] = $this->UserModel->getByIdentityNumber(1001);
            $data['question'] = $this->QuestionsModel->getById($question_id);
            $data['answers'] = $this->AnswersModel->getByQuestionsId($question_id);
            $data['title'] = 'Edit Soal';
            $data['parentUrl'] = base_url('admin/packagedetail/'.$data['question']['package_id']);

    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editsoal', $data);
            $this->load->view('templates/footer');
        } else {
            $this->QuestionsModel->update($question_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Soal diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/editsoal/'.$question_id);
        }
    }
}
