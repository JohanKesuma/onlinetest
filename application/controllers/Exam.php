<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exam extends CI_Controller
{
    private $user_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->identity_number;
        if (!$this->user_id || !$this->session->role == 1) {
            redirect('auth');
            exit;
        }

        $this->load->model("QuestionsModel");
    }

    public function index()
    {
        $data['title'] = 'Ujian';

        $this->session->set_userdata('exam_pacakage_id', );

        $this->load->view('templates/head', $data);
        $this->load->view('exam/index', $data);
        $this->load->view('templates/foot');
    }
}
