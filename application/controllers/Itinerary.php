<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[AllowDynamicProperties]

class Itinerary extends CI_Controller {
	
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


    public function add() {
        if($this->input->post('itinerary_name')) {
            $itineraryName = $this->input->post('itinerary_name');
            $itineraryDetails = $this->input->post('itinerary_details');
            if($this->ItineraryModel->add(['itinerary_name' => strtoupper($itineraryName), 'itinerary_discription' => $itineraryDetails])) {
                $this->session->set_flashdata('success', 'Itinerary added successfully');
                redirect('admin/itineraries/add');
            }
        } else {
            $this->load->view('dashboard/pages/itinerary/add');
        }
    }

    public function index() {
        $itineraries = $this->ItineraryModel->getItineraries();
        $this->load->view('dashboard/pages/itinerary/list', ['itineraries' => $itineraries]);
    }

    public function update() {
        try {
            //code...
            $array = [
                'itinerary_name' => $this->input->post('itinerary_name'), 
                'itinerary_discription' => $this->input->post('itinerary_discription')
            ];
            
            $response = $this->ItineraryModel->updateItinerary($this->input->post('itinerary_id'), $array);
            if($response) {
                $this->session->set_flashdata('success', 'Itinerary updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Oooppss... Itinerary not updated!');
            }
        } catch (\Throwable $th) {
            $this->session->set_flashdata('error', 'Oooppss... Itinerary not updated!', $th->getMessage());
        }
        redirect('admin/itineraries/list');
    }

    public function delete($id) {
        if($this->ItineraryModel->deleteItinerary($id)) {
            $this->session->set_flashdata('success', 'Itinerary removed successfully');
        } else {
            $this->session->set_flashdata('error', 'Oooppss... Itinerary not removed!');
        }
        redirect('admin/itineraries/list');
    }
}
