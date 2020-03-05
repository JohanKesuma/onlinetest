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
}
