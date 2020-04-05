<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exam extends CI_Controller
{
    private $user_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->identity_number;
        // check apakah user yang sedang login adalah siswa
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

        $package_id = $questions = $this->session->questions[0]['package_id'];
        $exam = $this->ExamsModel->getByIdentityNumber($this->session->identity_number, $package_id);

        if ($exam['is_finished'] == 1) {
            redirect('/exam/result');
        }

        $start_date = strtotime($exam['start_date']);
        $next_timeout = strtotime($exam['next_timeout']);

        $diff = $next_timeout - strtotime('now');
        if ($diff <= 0) { // waktu habis
            $this->next();
        }

        $data['remaining_time'] = $diff;

        // $this->session->set_userdata('exam_pacakage_id', );

        $this->load->view('templates/head', $data);
        $this->load->view('exam/index', $data);
        $this->load->view('templates/foot');
    }

    public function next()
    {
        $package_id = $questions = $this->session->questions[0]['package_id'];
        $exam = $this->ExamsModel->getByIdentityNumber($this->session->identity_number, $package_id);
        if ($exam['is_finished'] == 1) {
            redirect('exam/restult');
        }
        $this->session->question_index++;

        $questions = $this->session->questions;
        $question_index = $this->session->question_index;
        $current_question_timeout = 0;

        $is_finished = 0;
        
        $end_date = null;
        if ($question_index >= count($questions)) { // jika sudah menjawab semua soal
            $is_finished = 1;
            $end_date = date("Y/m/d H:i:s", strtotime("now"));
        } else {
            $current_question_timeout = $questions[$question_index]['time'];
        }

        $next_timeout = date("Y/m/d H:i:s", strtotime("+$current_question_timeout minutes"));

        // update jawaban benar
        $true_answers = $exam['true_answers'];
        $answer_id = $this->input->post('answer');
        if ($this->_checkAnswer($answer_id)) {
            $true_answers++;
        }

        // masukkan ke answers history
        $this->load->model('AnswersHistoryModel');
        $answer_data = [
            'exam_id' => $exam['exam_id'],
            'questions_id' => $questions[$question_index - 1]['questions_id'], // ambil questiion sebelum next
            'user_answer_id' => $answer_id
        ];
        $this->AnswersHistoryModel->insert($answer_data);

        $exam_data = [
            'question_index' => $question_index,
            'is_finished' => $is_finished,
            'next_timeout' => $next_timeout,
            'true_answers' => $true_answers,
            'end_date' => $end_date
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

    public function result()
    {
        $package_id = $questions = $this->session->questions[0]['package_id'];
        $exam = $this->ExamsModel->getByIdentityNumber($this->user_id, $package_id);
        if (!$exam) { // jika user belum ujian
            redirect('exam');
        }
        if ($exam['is_finished'] == 0) {
            redirect('exam');
        }

        $this->load->model('UserModel');
        $this->load->model('QuestPackagesModel');
        $this->load->model('AnswersHistoryModel');

        $user = $this->UserModel->getByIdentityNumber($this->user_id);
        $questPackageName = $this->QuestPackagesModel->getById($exam['package_id'])['name'];

        $data['title'] = 'Hasil Ujian';
        $data['exam'] = $exam;
        $data['user'] = $user;
        $data['jumlah_soal'] = count($this->session->questions);
        $data['quest_package_name'] = $questPackageName;
        $data['nilai'] = $this->_hitungNilai($exam['true_answers'], count($this->session->questions));
        $answers_history = $this->AnswersHistoryModel->getByExamId($exam['exam_id']);
        $arr = array_replace_recursive(
            array_column($this->session->questions, null, 'questions_id'),
            array_column($answers_history, null, 'questions_id')
        );
        $data['answers_history'] = $arr;
        // var_dump($arr);

        $this->load->view('templates/head', $data);
        $this->load->view('exam/result', $data);
        $this->load->view('templates/foot');
    }

    private function _hitungNilai($jumlahBenar, $jumlahSoal)
    {
        return $jumlahBenar / $jumlahSoal * 100;
    }
}
