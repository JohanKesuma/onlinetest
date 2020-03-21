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

    public function index($package_id="")
    {

        // Form Validation
        $this->form_validation->set_rules('nis', "NIS", 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Login";

            $this->load->view('auth/login', $data);
        } else {
            $this->_login($package_id);
        }
    }
    
    private function _login($package_id="")
    {
        $nis = $this->input->post('nis');
        $password = $this->input->post('password');

        $user = $this->UserModel->getByIdentityNumber($nis);

        if ($user) { // jika user ada
            // cek password
            if (password_verify($password, $user['password'])) {
                // login berhasil
                $user_data = [
                    'identity_number' => $nis,
                    'role' => $user['role']
                ];
                $this->session->set_userdata($user);
                if ($user['role'] == 0) {
                    // jika admin
                    redirect('admin');
                } else {
                    # jika siswa
                    $this->load->model('QuestionsModel');
                    $questions = $this->QuestionsModel->getByPackageId($package_id);
                    if (!$questions) {
                        $this->_unsetUserData();
                        redirect('auth');
                        exit;
                    }
                    $exam_data = [
                        'questions' => $questions,
                        'question_current_index' => 0
                    ];

                    redirect('exam');
                }
            } else { // password salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Password Salah!
                        </div>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->_unsetUserData();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out!
            </div>');

        redirect('auth');
    }

    public function _unsetUserData()
    {
        $this->session->unset_userdata('identity_number');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('questions');
        $this->session->unset_userdata('question_current_index');
    }
}
