<?php

class ExamsModel extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('exams', $data);
        return $this->db->insert_id();
    }

    public function getByIdentityNumber($identityNumber, $package_id)
    {
        return $this->db->get_where('exams', [
            'identity_number' => $identityNumber,
            'package_id' => $package_id
        ])->row_array();
    }

    public function update($exam_id, $exam_data)
    {
        $this->db->where('exam_id', $exam_id);
        $this->db->update('exams', $exam_data);
    }
}