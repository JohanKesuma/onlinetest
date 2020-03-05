<?php

class AnswersModel extends CI_Model
{
    public function insertRows($data)
    {
        $this->db->insert_batch('answers', $data);
    }
}
