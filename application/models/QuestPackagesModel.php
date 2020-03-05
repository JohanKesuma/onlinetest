<?php

class QuestPackagesModel extends CI_Model
{
    public function getAll() {
        $this->db->order_by('name', 'asc');
        return $this->db->get('quest_packages')->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('quest_packages', [
            'package_id' => $id
        ])->row_array();
    }

}