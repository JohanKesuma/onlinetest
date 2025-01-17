<?php

class AnswersModel extends CI_Model
{
    public function insertRows($data)
    {
        $this->db->insert_batch('answers', $data);
    }

    public function getByQuestionsId($questionsId)
    {
        return $this->db->get_where('answers', [
            'questions_id' => $questionsId
        ])->result_array();
    }

    public function getById($answer_id)
    {
        return $this->db->get_where('answers', [
            'answers_id' => $answer_id
        ])->row_array();
    }

    public function updateRows($answersData, $key)
    {
        $this->db->update_batch('answers', $answersData, $key);
    }

    public function updateImage($answerId, $imageFileName)
    {
        $this->db->where('answers_id', $answerId);
        $this->db->update('answers', [
            'image' => $imageFileName
        ]);
        return true;
    }

    public function deleteImage($answerId) {

        // delete file gambar di storage
        $fileName = $this->getById($answerId)['image'];
        unlink('./assets/img/answers/'.$answerId.'/'.$fileName);

        $this->db->where('answers_id', $answerId);
        $this->db->update('answers', [
            'image' => ''
        ]);
        return true;
    }
}
