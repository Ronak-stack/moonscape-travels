<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[AllowDynamicProperties]

class Package extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('id')) {
            redirect('login');
        }
        $this->load->model('UserModel');
        $this->load->model('PackageModel');
        $this->load->model('ItineraryModel');
    }

    /**
     * Add package
     */
    public function add() {
        if($this->input->post('package_name') !== null) {
            $result = $this->PackageModel->savePackage();
            if($result) {
                $this->session->set_flashdata('success','Your new package:'.$this->input->post('package_name').' has been saved');
            } else {
                $this->session->set_flashdata('error','Package not added successfully!');
            }
            redirect('admin//packages/add');
        } else {
            $packages = $this->PackageModel->getAllLocations();
            $itineraries = $this->ItineraryModel->getItineraries();
            $this->load->view('dashboard/pages/package/add', ['packages' => $packages, 'itineraries' => $itineraries]);
        }
    }

    public function index() {
        $packages = $this->PackageModel->getPackages();
        $this->load->view('dashboard/pages/package/list', ['packages' => $packages]);
    }

    public function details($id) {
        $details = $this->PackageModel->getPackageDetails($id);
        if($details != false) {
            $itineraries = $this->ItineraryModel->getPackageItineraries($id);
            echo json_encode(['success' => true, 'message' => 'OK', 'data' => ['details' => $details,'itineraries' => $itineraries]]);
            return true;
        } else {
            echo json_encode(['success' => false, 'message' => 'Record not fatched', 'data' => []]);
            return false;
        }
        return false;
    }

    public function delete($id) {
        $deletePackageStatus = $this->PackageModel->removePackage($id);
        if($deletePackageStatus) {
            $this->session->set_flashdata('success', 'Package Remove Successfully!');
        } else {
            $this->session->set_flashdata('error', 'Ooppss..Something error!');
        }
        redirect('admin/packages/list');
    }
}
