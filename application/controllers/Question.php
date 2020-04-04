<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function hapusGambar($question_id)
    {
        // hanya admin yang boleh akses controller ini
        $this->load->model('UserModel');
        $user_id = $this->session->identity_number;
        if (!$user_id || !$this->session->role == 0) {
            redirect('auth'); // arahkan ke halaman login
            exit;
        }

        $this->load->model('QuestionsModel');
        $this->QuestionsModel->deleteImage($question_id);

        redirect('admin/editsoal/'.$question_id);
    }
}