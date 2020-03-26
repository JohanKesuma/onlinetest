<?php

class AnswersHistoryModel extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('answers_history', $data);
        return $this->db->insert_id();
    }

    public function getByExamId($examId)
    {
        return $this->db->get_where('answers_history', [
            'exam_id' => $examId
        ])->result_array();
    }
}