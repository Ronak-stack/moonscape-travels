<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[AllowDynamicProperties]

class Dashboard extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('id')) {
            redirect('login');
        }
        $this->load->model('UserModel');
    }

    /**
     * add default user
     */
    public function addDefaultUser() {
        $data = array(
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT)
        );

        $this->UserModel->addDefaultUser($data);
        echo "Default user added successfully!";
    }
    
    public function index()
	{
		$this->load->view('dashboard/dashboard');
	}

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
