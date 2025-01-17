<?php

class UserModel extends CI_Model
{
    /**
     * Get user by identity_number
     *
     * @param string $email email user
     *
     */
    public function getByIdentityNumber($number = '')
    {
        return $this->db->get_where('user', [
            'identity_number' => $number
        ])->row_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('user', [
            'user_id' => $id
        ])->row_array();
    }

    public function getAll($role = 1)
    {
        $this->db->where([
            'role' => $role
            ]);
        $this->db->order_by('identity_number', 'ASC');
        return $this->db->get('user')->result_array();
    }

    public function getAllJoinExamsJoinQuestPackage($package_id, $role = 1)
    {
        $this->db->select('u.identity_number, u.name, e.exam_id, e.question_index, e.true_answers, q.name as qname, count(qs.questions_id) as jumlah_soal');
        $this->db->join('exams e', 'e.identity_number=u.identity_number AND e.package_id='.$package_id, 'left');
        $this->db->join('quest_packages q', 'q.package_id=e.package_id', 'left');
        $this->db->join('questions qs', 'qs.package_id=e.package_id', 'left');
        $this->db->group_by('u.identity_number');
        $this->db->where([
            'u.role' => $role
            ]);
        return $this->db->get('user u')->result_array();
    }

    public function deleteById($user_id)
    {
    }

    public function insert($role = 1)
    {
        $identity_number = $this->input->post('nis');
        $name = $this->input->post('name');
        $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

        $data = [
            'identity_number' => $identity_number,
            'name' => $name,
            'role' => $role,
            'password' => $password
        ];

        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * update nis dan nama saja, tidak dengan password
     *
     */
    public function update($identity_number)
    {
        $number = $this->input->post('nis');
        $name = $this->input->post('name');

        $data = [
            'identity_number' => $number,
            'name' => $name
        ];

        $this->db->where('identity_number', $identity_number);
        $this->db->update('user', $data);
    }

    public function updatePassword($identity_number, $password)
    {
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->where('identity_number', $identity_number);
        $this->db->update('user', $data);
    }
}
