<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class LoginModel extends CI_Model {

    public function login($credentials) {
        $query = $this->db->from('users')->where('username',$credentials['username'])->get();
        $userData = $query->row();
        if($userData) {
            return $userData;
        }
        return false;
    }    

    public function getLoggedInUserRoles($userId) {
        $this->db->select('b.id as role_id, b.role_name');
        $this->db->from('user_role_mapping as a');
        $this->db->join('roles as b', 'b.id = a.role_id', 'left');
        $this->db->where('a.user_id', $userId);
        $query = $this->db->get();
        if($query->num_rows()) {
            return $query->result_array();
        }
        return false;
    }
}