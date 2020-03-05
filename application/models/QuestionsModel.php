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

        $questionData = [
            'package_id' => $packageId,
            'text' => $text,
            'time' => $time
        ];

        $this->db->insert('questions', $questionData);

        // TODO memasukkan data ke table answers
        $answersData = [
            [

            ],
            [

            ]
        ];
        $this->load->model('AnswersModel');
        $this->AnswersModel->insertRows();
    }
}
