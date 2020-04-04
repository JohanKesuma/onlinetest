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
        $this->form_validation->set_rules('nis', "NIS", 'required|trim', [
            'required' => 'NIS harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password harus diisi'
        ]);

        $this->load->model('QuestPackagesModel');
        $quest_package = $this->QuestPackagesModel->getById($package_id);
        if ($quest_package) {
            $data['package_name'] = $quest_package['name'];
        }

        if ($this->form_validation->run() == false) {
            $data['title'] = "Login";
            $data['package_id'] = $package_id;

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
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                            Paket tidak sesuai.
                            </div>');
                        redirect('auth/index/'.$package_id);
                        exit;
                    }

                    $this->_createExam($questions, $nis, $package_id);

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

    private function _createExam($questions, $identity_number, $package_id)
    {
        $question_index = 0;

        $this->load->model('ExamsModel');

        // cek apakah user saat ini sedang melakukan ujian
        $exam = $this->ExamsModel->getByIdentityNumber($identity_number);
        if (!$exam) {
            /// jika belum. buat ujian di database
            $firstQuestionTime = $questions[0]['time'];
            $exam_data = [
                'identity_number' => $identity_number,
                'package_id' => $package_id,
                'start_date' => date('Y-m-d H:i:s'),
                'is_finished' => 0,
                'next_timeout' => date("Y/m/d H:i:s", strtotime("+$firstQuestionTime minutes")),
                'question_index' => 0 // mulai dengan soal pertama
            ];
            $this->ExamsModel->insert($exam_data);
        } else {
            if ($exam['package_id'] != $package_id) {
                $this->_unsetUserData();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Paket tidak sesuai.
                    </div>');
                redirect('auth');
                exit;
            }
            $question_index = $exam['question_index'];
        }

        $exam_data = [
            'questions' => $questions,
            'question_index' => $question_index
        ];
        $this->session->set_userdata($exam_data);
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
