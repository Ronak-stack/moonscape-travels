<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class UserModel extends CI_Model {
    public function addDefaultUser($user) {
        if($this->db->insert('users', $user)) {
            return true;
        }
        return false;
    }    
}