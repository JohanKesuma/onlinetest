<?php

class ContentsModel extends CI_Model
{
    public function getByName($name)
    {
        return $this->db->get_where('contents', [
            'name' => $name
        ])->row_array();
    }

    public function insert($name) {
        $this->db->insert('contents', [
            'name' => $name,
            'content' => ''
        ]);
        return $this->db->insert_id();
    }

    public function updateByName($name, $content) {
        $this->db->where('name', $name);
        return $this->db->update('contents', [
            'content' => $content
        ]);
    }
}