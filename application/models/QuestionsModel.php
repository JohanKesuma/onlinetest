<?php

class QuestionsModel extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('questions')->result_array();
    }

    public function getAllJoinQuestPackages($id)
    {
        $this->db->join('quest_packages', 'quest_packages.package_id = questions.package_id');
        return $this->db->get_where('questions', [
            'questions.package_id' => $id
        ])->result_array();
    }

    public function getById($questionsId)
    {
        return $this->db->get_where('questions', [
            'questions_id' => $questionsId
        ])->row_array();
    }

    public function getByIdJoinAnswers($questionsId)
    {
        $this->db->join('answers', 'answers.questions_id=questions.questions_id');
        return $this->db->get_where('questions', [
            'questions.questions_id' => $questionsId
        ])->result_array();
    }

    public function getByPackageId($id)
    {
        $questions = $this->db->get_where('questions', [
            'package_id' => $id
        ])->result_array();

        foreach ($questions as $i => $q) {
            $answers = $this->db->get_where('answers', [
                'questions_id' => $q['questions_id']
            ])->result_array();
            $questions[$i]['answers'] = $answers;
        }

        return $questions;
    }

    public function getByPackageIdJoinAnswers($id)
    {
        $this->db->join('answers', 'questions.questions_id = answers.questions_id', 'right');
        return $this->db->get_where('questions', [
            'package_id' => $id
        ])->result_array();
    }

    public function insert()
    {
        $packageId = $this->input->post('package_id');
        $text = $this->input->post('soal');
        $time = $this->input->post('waktu');
        $pilihan = $this->input->post('is_true');
        $pilihan1 = 0;
        $pilihan2 = 0;
        $pilihan3 = 0;
        $pilihan4 = 0;
        $pilihan5 = 0;

        switch ($pilihan) {
            case 'pilihan1':
                $pilihan1 = 1;
                break;
            case 'pilihan2':
                $pilihan2 = 1;
                break;
            case 'pilihan3':
                $pilihan3 = 1;
                break;
            case 'pilihan4':
                $pilihan4 = 1;
                break;
            case 'pilihan5':
                $pilihan5 = 1;
                break;
            
            default:
                # code...
                break;
        }

        $questionData = [
            'package_id' => $packageId,
            'text' => $text,
            'time' => $time
        ];

        $this->db->insert('questions', $questionData);
        $questionId = $this->db->insert_id();

        // TODO memasukkan data ke table answers
        $answersData = [
            [
                'questions_id' => $questionId,
                'text' => $this->input->post('pilihan1'),
                'is_true' => $pilihan1
            ],
            [
                'questions_id' => $questionId,
                'text' => $this->input->post('pilihan2'),
                'is_true' => $pilihan2
            ],
            [
                'questions_id' => $questionId,
                'text' => $this->input->post('pilihan3'),
                'is_true' => $pilihan3
            ],
            [
                'questions_id' => $questionId,
                'text' => $this->input->post('pilihan4'),
                'is_true' => $pilihan4
            ],
            [
                'questions_id' => $questionId,
                'text' => $this->input->post('pilihan5'),
                'is_true' => $pilihan5
            ]
        ];
        $this->load->model('AnswersModel');
        $this->AnswersModel->insertRows($answersData);
    }

    public function update($questions_id)
    {
        $this->load->model('AnswersModel');

        $questionText = $this->input->post('soal');
        $time = $this->input->post('waktu');

        $questionData = [
            'text' => $questionText,
            'time' => $time
        ];

        $this->db->where('questions_id', $questions_id);
        $this->db->update('questions', $questionData);

        $pilihan = $this->input->post('is_true');
        $pilihan1 = $this->_checkTrueAnswer($pilihan, 'pilihan1');
        $pilihan2 = $this->_checkTrueAnswer($pilihan, 'pilihan2');
        $pilihan3 = $this->_checkTrueAnswer($pilihan, 'pilihan3');
        $pilihan4 = $this->_checkTrueAnswer($pilihan, 'pilihan4');
        $pilihan5 = $this->_checkTrueAnswer($pilihan, 'pilihan5');

        $answersData = [
            [
                'answers_id' => $this->input->post('pilihan1_id'),
                'text' => $this->input->post('pilihan1'),
                'is_true' => $pilihan1
            ],
            [
                'answers_id' => $this->input->post('pilihan2_id'),
                'text' => $this->input->post('pilihan2'),
                'is_true' => $pilihan2
            ],
            [
                'answers_id' => $this->input->post('pilihan3_id'),
                'text' => $this->input->post('pilihan3'),
                'is_true' => $pilihan3
            ],
            [
                'answers_id' => $this->input->post('pilihan4id'),
                'text' => $this->input->post('pilihan4'),
                'is_true' => $pilihan4
            ],
            [
                'answers_id' => $this->input->post('pilihan5_id'),
                'text' => $this->input->post('pilihan5'),
                'is_true' => $pilihan5
            ]
        ];

        $this->AnswersModel->updateRows($answersData, 'answers_id');
    }

    private function _checkTrueAnswer($pilihan, $key)
    {
        if ($pilihan == $key) {
            return 1;
        }
        return 0;
    }
}
