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
        $this->load->model('ExamsModel');
    }

    public function index()
    {
        $data['title'] = 'Ujian';
        $data['questions'] = $this->session->questions;
        $data['questions_index'] = $this->session->question_index;

        $exam = $this->ExamsModel->getByIdentityNumber($this->session->identity_number);

        $start_date = strtotime($exam['start_date']);
        $next_timeout = strtotime($exam['next_timeout']);

        $diff = $next_timeout - strtotime('now');
        if ($diff <= 0) { // waktu habis
            $this->next();
        }

        $data['remaining_time'] = $diff;

        $this->session->set_userdata('exam_pacakage_id', );

        $this->load->view('templates/head', $data);
        $this->load->view('exam/index', $data);
        $this->load->view('templates/foot');
    }

    public function next()
    {
        
        $exam = $this->ExamsModel->getByIdentityNumber($this->session->identity_number);
        $this->session->question_index++;

        $questions = $this->session->questions;
        $question_index = $this->session->question_index;
        $current_question_timeout = $questions[$question_index]['time'];

        $is_finished = 0;
        $next_timeout = date("Y/m/d H:i:s", strtotime("+$current_question_timeout minutes"));
        if ($question_index > 10) { // jika sudah menjawab semua soal
            $is_finished = 1;
        }

        // update jawaban benar
        $true_answers = $exam['true_answers'];
        $answer_id = $this->input->post('answer');
        if ($this->_checkAnswer($answer_id)) {
            $true_answers++;
        }

        echo ('jawaban : '.$answer_id);
        $exam_data = [
            'question_index' => $question_index,
            'is_finished' => $is_finished,
            'next_timeout' => $next_timeout,
            'true_answers' => $true_answers
        ];
        $this->ExamsModel->update($exam['exam_id'], $exam_data);

        redirect('exam');
    }

    private function _checkAnswer($answer_id)
    {
        if (!$answer_id) {
            return false;
        }
        $this->load->model('AnswersModel');
        $answer = $this->AnswersModel->getById($answer_id);
        if ($answer['is_true'] == 1) {
            return true;
        }
        return false;
    }
}
