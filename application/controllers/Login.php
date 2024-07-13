<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->has_userdata('id')) {
            redirect('admin');
        }
        $this->load->model('LoginModel');
        $this->checkUserIsLoggedIn();
    }

    private function checkUserIsLoggedIn($check = false, $role = null) {
        if($this->session->userdata('loggedin') && $this->session->userdata('id')) {
            if($check) {
                if(in_array($role,$this->session->userdata('user_roles'))) {
                    return true;
                } else {
                    return false;
                }
            } else {
                redirect('/admin');
            }
        }
    }

	public function index()
	{
		$this->load->view('login');
	}

    public function login() {
        $data = array(
            'username' => $this->input->post('username')
        );

        $result = $this->LoginModel->login($data);
        if($result && password_verify($this->input->post('password'), $result->password)) {
            $roles = $this->LoginModel->getLoggedInUserRoles($result->id);
            if(!empty($roles)) {
                $this->session->set_userdata([
                    'id' => $result->id,
                    'username' => $result->username,
                    'created_at' => $result->created_at,
                    'loggedin' => true,
                    'user_roles' => array_column($roles,'role_name')
                ]);
            }
            if($this->checkUserIsLoggedIn(true, 'admin')) {
                redirect('admin');
            } else {
                $this->session->set_flashdata('error', 'Login available for only admin');
                redirect('login');
            }
        }
        $this->session->set_flashdata('error', 'Invalid Credentials');
        redirect('login');
    }

    public function logout() {
        
    }
}
