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

    public function update($package_id)
    {
        $id = $this->input->post('package_id');
        $name = $this->input->post('name');
        $judul = $this->input->post('judul');

        $data = [
            'package_id' => $id,
            'name' => $name,
            'judul' => $judul
        ];

        $this->db->where('package_id', $package_id);
        $this->db->update('quest_packages', $data);
        return $id;
    }

    public function insert()
    {
        $package_id = $this->input->post('package_id');
        $name = $this->input->post('name');
        $judul = $this->input->post('judul');

        $data = [
            'package_id' =>$package_id,
            'name' => $name,
            'judul' => $judul
        ];

        $this->db->insert('quest_packages', $data);
        return $this->db->insert_id();
    }

}