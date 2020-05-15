<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $user_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->user_id = $this->session->identity_number;
        if (!$this->user_id || !$this->session->role == 0) {
            redirect('auth');
            exit;
        }
    }

    public function index()
    {
        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function daftarSiswa()
    {
        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['title'] = 'Daftar Siswa';
        $data['daftarSiswa'] = $this->UserModel->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/daftarsiswa', $data);
        $this->load->view('templates/footer');
    }

    public function daftarNilai()
    {
        $this->load->model('QuestPackagesModel');

        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['title'] = 'Daftar Nilai Siswa';
        $data['questPackages'] = $this->QuestPackagesModel->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/daftarnilai', $data);
        $this->load->view('templates/footer');
    }

    public function detailNilai($package_id)
    {
        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        
        $data['parentUrl'] = base_url('admin/daftarnilai');
        $data['daftarSiswa'] = $this->UserModel->getAllJoinExamsJoinQuestPackage($package_id);
        

        if (!$data['daftarSiswa']) {
            redirect('admin/daftarnilai');
            return;
        }
        $data['title'] = 'Daftar Nilai '.$data['daftarSiswa'][0]['qname'];
        foreach ($data['daftarSiswa'] as $key => $daftarSiswa) {
            if ($daftarSiswa['exam_id']) {
                $data['daftarSiswa'][$key]['nilai'] = $daftarSiswa['true_answers'] / $daftarSiswa['jumlah_soal'] * 100;
            } else {
                $data['daftarSiswa'][$key]['nilai'] = null;
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailnilai', $data);
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
            Data siswa berhasil ditambahkan.
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
            $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
            $data['title'] = 'Ubah Siswa';
            $data['parentUrl'] = base_url('admin/daftarsiswa');
    
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

    public function hapusSiswa($identity_number)
    {
        $this->db->where('identity_number', $identity_number);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data siswa berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/daftarsiswa');
    }

    /**
     *
     * Controller Reset Password siswa
     *
     * Post : Password 1 dan password 2
     */
    public function resetPassword($identity_number)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => "Password tidak cocok.",
            'min_length' => 'Password minimal 3 huruf.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'matches' => "Password tidak cocok."
        ]);

        if ($this->form_validation->run() == true) {
            $password = $this->input->post('password1');
            $this->UserModel->updatePassword($identity_number, $password);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Password berhasil diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/ubahsiswa/'.$identity_number);
            return;
        }

        $siswa = $this->UserModel->getByIdentityNumber($identity_number);

        $data['siswa'] = $siswa;
        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['title'] = 'Reset Password '. $siswa['name'];
        $data['parentUrl'] = base_url('admin/ubahsiswa/'.$identity_number);
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/resetpassword', $data);
        $this->load->view('templates/footer');
    }

    public function paketSoal()
    {
        $this->load->model('QuestPackagesModel');

        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['questPackages'] = $this->QuestPackagesModel->getAll();
        $data['title'] = 'Paket Soal';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/paketsoal', $data);
        $this->load->view('templates/footer');
    }

    public function tambahPaket()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('package_id', "ID Paket", 'required|trim|is_unique[quest_packages.package_id]', [
            'required' => 'ID Paket tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('name', "Nama", 'required|trim', [
            'required' => 'Nama Paket tidak boleh kosong'
        ]);

        $this->load->model('QuestPackagesModel');

        if ($this->form_validation->run() == true) {
            $id = $this->QuestPackagesModel->insert();
            $package_id = $id;
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Kuis berhasil ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/paketsoal');
            return;
        }

        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['title'] = 'Tambah Paket Soal';
        $data['parentUrl'] = base_url('admin/paketsoal');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tambahpaket', $data);
        $this->load->view('templates/footer');
    }

    public function editPaket($package_id)
    {
        $this->load->library('form_validation');

        $number = $this->input->post('package_id');
        if ($number) {
            if ($package_id == $number) {
                $is_unique = '';
            } else {
                $is_unique = '|is_unique[quest_packages.package_id]';
            }
        } else {
            $is_unique = '|is_unique[quest_packages.package_id]';
        }

        $this->form_validation->set_rules('package_id', "ID Paket", 'required|trim'.$is_unique, [
            'required' => 'ID Paket tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('name', "Nama", 'required|trim', [
            'required' => 'Nama Paket tidak boleh kosong'
        ]);

        $this->load->model('QuestPackagesModel');

        if ($this->form_validation->run() == true) {
            $id = $this->QuestPackagesModel->update($package_id);
            $package_id = $id;
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Kuis berhasil diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        }

        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['questPackage'] = $this->QuestPackagesModel->getById($package_id);
        $data['title'] = 'Edit Paket';
        $data['parentUrl'] = base_url('admin/paketsoal');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editpaket', $data);
        $this->load->view('templates/footer');
    }

    public function packagedetail($id)
    {
        $this->load->model('QuestionsModel');
        $this->load->model('QuestPackagesModel');

        $name = $this->QuestPackagesModel->getById($id)['name'];

        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
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
        $this->form_validation->set_rules('pilihan1', "Pilihan 1", 'required|trim', [
            'required' => 'Pilihan 1 harus diisi'
        ]);
        $this->form_validation->set_rules('pilihan2', "Pilihan 2", 'required|trim', [
            'required' => 'Pilihan 2 harus diisi'
        ]);
        $this->form_validation->set_rules('pilihan3', "Pilihan 3", 'required|trim', [
            'required' => 'Pilihan 3 harus diisi'
        ]);
        $this->form_validation->set_rules('pilihan4', "Pilihan 4", 'required|trim', [
            'required' => 'Pilihan 4 harus diisi'
        ]);
        $this->form_validation->set_rules('pilihan5', "Pilihan 5", 'required|trim', [
            'required' => 'Pilihan 5 harus diisi'
        ]);

        $this->form_validation->set_rules('waktu', "waktu", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->model('QuestPackagesModel');

            $name = $this->QuestPackagesModel->getById($packageId)['name'];
    
            $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
            $data['packageId'] = $packageId;
            $data['parentUrl'] = base_url('admin/packagedetail/'.$packageId);
            $data['title'] = 'Tambah Soal ('.$name.')';

    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambahsoal', $data);
            $this->load->view('templates/footer');
        } else {
            if (isset($_FILES['question_image'])  && $_FILES['question_image']['name'] != '') { // jika ada file yang di-upload
                $fileName = date('Y_m_d-H-i-s').'_'.$_FILES['question_image']['name'];
                $uploadReturn = $this->_doFileUpload($fileName, 'question_image');
                if ($uploadReturn['uploaded'] == true) {
                    $this->load->model('QuestionsModel');
                    $this->QuestionsModel->insert($uploadReturn['upload_data']['file_name']);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Soal ditambahkan.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Soal gagal ditambahkan. '.$uploadReturn['error'].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                }
            } else {
                $this->load->model('QuestionsModel');
                $this->QuestionsModel->insert();
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Soal ditambahkan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            }
            
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
            $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
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
            if (isset($_FILES['question_image']) && $_FILES['question_image']['name'] != '') { // jika ada file yang di-upload
                $fileName = date('Y_m_d-H-i-s').'_'.$_FILES['question_image']['name'];
                $uploadReturn = $this->_doFileUpload($fileName, 'question_image');
                if ($uploadReturn['uploaded'] == true) {
                    $this->load->model('QuestionsModel');
                    $this->QuestionsModel->update($question_id, $uploadReturn['upload_data']['file_name']);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Soal diubah.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Soal gagal ditambahkan. '.$uploadReturn['error'].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                    log_message('error', print_r($_FILES, true));
                }
            } else {
                $this->load->model('QuestionsModel');
                $this->QuestionsModel->update($question_id);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Soal diubah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            }
            $this->QuestionsModel->update($question_id);
            
            redirect('admin/editsoal/'.$question_id);
        }
    }

    /**
     *
     * Upload gambar soal
     *
     */
    private function _doFileUpload($fileName, $fieldName, $path = '')
    {
        $uploadPath = './assets/img/'.$path;
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $config['upload_path']          = $uploadPath;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['file_name']            = $fileName;

        $this->load->library('upload', $config);

        if (! $this->upload->do_upload($fieldName)) {
            $error = array('error' => $this->upload->display_errors());

            return [
                    'error' => $error['error'],
                    'uploaded' => false
                ];
        } else {
            $data = array('upload_data' => $this->upload->data());
            log_message('error', print_r($data['upload_data'], true));
            return [
                    'error' => '',
                    'upload_data' => $data['upload_data'],
                    'uploaded' => true
                ];
        }
    }

    public function hapusSoal($packageId, $questionId)
    {
        $fileName = $this->db->get_where('questions', ['questions_id' => $questionId])->row_array()['image'];
        if ($fileName != '') {
            unlink('./assets/img/'.$fileName);
        }
        $this->db->where('questions_id', $questionId);
        $this->db->delete('questions');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Soal berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/packagedetail/'.$packageId);
    }

    public function hapusPaket($package_id)
    {
        $this->db->where('package_id', $package_id);
        $this->db->delete('quest_packages');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Kuis berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin/paketsoal/');
    }

    public function togglePackage($package_id, $active=0)
    {
        $this->db->where('package_id', $package_id);
        $this->db->update('quest_packages', [
            'is_active' => $active
        ]);
        

        redirect('admin/paketsoal');
    }

    public function uploadOptionImage($answerId)
    {
        $fileName = date('Y_m_d-H-i-s').'_'.$_FILES['answer_image']['name'];
        $path = 'answers/'.$answerId.'/';
        
        $uploadReturn = $this->_doFileUpload($fileName, 'answer_image', $path);

        if ($uploadReturn['uploaded'] == true) {
            $this->load->model('AnswersModel');
            $this->AnswersModel->updateImage($answerId, $uploadReturn['upload_data']['file_name']);
            echo "Unggah gambar berhasil";
            return true;
        } else {
            echo 'Unggah gambar gagal, '.$uploadReturn['error'];
            return false;
        }
    }

    public function deleteOptionImage($answerId)
    {
        $this->load->model('AnswersModel');
        $this->AnswersModel->deleteImage($answerId);
        echo "Deleted ".$answerId;
    }

    public function deskripsiKuis()
    {
        $this->load->model('ContentsModel');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('content_form', "Deskripsi", 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->ContentsModel->updateByName('quiz_desc', $this->input->post('content_form'));
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Deskripsi berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/deskripsikuis');
            return;
        }

        $content = $this->ContentsModel->getByName('quiz_desc');
        if (!$content) {
            $this->ContentsModel->insert('quiz_desc');
            $content = $this->ContentsModel->getByName('quiz_desc');
        }


        $data['user'] = $this->UserModel->getByIdentityNumber($this->user_id);
        $data['title'] = 'Deskripsi Kuis';
        $data['content'] = $content;
        $data['parentUrl'] = base_url('admin');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/deskripsikuis', $data);
        $this->load->view('templates/footer');
    }
}
