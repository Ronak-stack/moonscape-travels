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

    public function updateStatus() {
        $response = $this->PackageModel->updateStatus();
        if($response) {
            echo json_encode(['success' => true, 'message' => 'Package status updated.', 'data' => []]);
            return true;
        } else {
            echo json_encode(['success' => false, 'message' => 'Package statu snot updated.', 'data' => []]);
            return false;
        }
        return false;
    }

    public function publishPackage($id) {
        $response = $this->PackageModel->publishPackage($id);
        if($response['success']) {
            $this->session->set_flashdata('success', 'This package has been published now!');
        } else {
            $this->session->set_flashdata('error', $response['message']);
        }
        redirect('admin/packages/list');
    }

    public function unPublishPackage($id) {
        $response = $this->PackageModel->publishPackage($id, false);
        if($response['success']) {
            $this->session->set_flashdata('success', 'This package has been un-published now!');
        } else {
            $this->session->set_flashdata('error', $response['message']);
        }
        redirect('admin/packages/list');
    }

    public function updatePackageShow($id) {
        if(!empty($id)) {
            $details = $this->PackageModel->getPackageDetails($id);
            $itineraries = $this->ItineraryModel->getPackageItineraries($id);
            $allItineraries = $this->ItineraryModel->getItineraries($id);
            $locations = $this->PackageModel->getAllLocations();
            $this->load->view("dashboard/pages/package/update", ['package_id' => $id,'details' => $details, 'itineraries' => $itineraries, 'locations' => $locations, 'all_itineries' => $allItineraries]);
        } else {
            redirect('admin/packages/list');
        }
    }

    public function updatePackage($id) {
        if(!empty($id)) {
            $response = $this->PackageModel->updatePackage($id);
            if($response['success']) {
                $this->session->set_flashdata('success', 'Package updated.');
            } else {
                $this->session->set_flashdata('success', $response['message']);
            }
        } else {
            $this->session->set_flashdata('success', 'Ooppss...something error.');
        }
        redirect('admin/packages/list');
    }
}
