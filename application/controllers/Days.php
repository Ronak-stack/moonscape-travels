<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[AllowDynamicProperties]

class Days extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('id')) {
            redirect('login');
        }
        $this->load->model('UserModel');
        $this->load->model('PackageModel');
        $this->load->model('ItineraryModel');
        $this->load->model('DaysModel');
    }

    public function addDays() {
        $_POST ? print_r($_POST) : '';
        if($this->input->post('package_id')) {
            $saveDaysResponse = $this->DaysModel->addDays();
            if($saveDaysResponse) {
                $this->session->set_flashdata('success', 'Days added into selected package');
            } else {
                $this->session->set_flashdata('error', 'Days not save with selected package!');
            }
            redirect('admin/days/add');
        } else {
            $packages = $this->PackageModel->getPackages();
            $this->load->view('dashboard/pages/days/add', ['packages' => $packages]);
        }
    }

    public function showDays() {
        $dasyWithPackageName = $this->DaysModel->getDaysWithPackages();
        $this->load->view('dashboard/pages/days/list', ['days' => $dasyWithPackageName]);
    }

    public function findDay($id) {
        if(!empty($id)) {
            $singleDayData = $this->DaysModel->getDaysWithPackages(intval($id));
            if($singleDayData) {
                echo json_encode(['success' => true, 'message' => 'Record found!'.$id, 'data' => ['single_day_data' => $singleDayData]]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Record not found!', 'data' => []]);
            }
            return true;
        }
        echo json_encode(['success' => false, 'message' => 'Oooppss...something error!', 'data' => []]);
        return false;
    }
}
