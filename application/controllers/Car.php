<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[AllowDynamicProperties]

class Car extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('id')) {
            redirect('login');
        }
        $this->load->model('UserModel');
        $this->load->model('CarModel');
        $this->load->model('CategoryModel');
    }

    public function addCar() {
        if($this->input->post('car_name')) {
            $saveCarResponse = $this->CarModel->saveCar();
            if($saveCarResponse) {
                $this->session->set_flashdata('success', 'Car saved.');
            } else {
                $this->session->set_flashdata('error', 'Ooopss... something error!');
            }
            if($this->input->post('car_new_name')) {
                redirect('admin/cars/list');    
            }
            redirect('admin/cars/add');
        }
        $categories = $this->CategoryModel->getAllCarCategories();
        $this->load->view('dashboard/pages/cars/add', ['categories' => $categories]);
    }

    public function addCategory() {
        if($this->input->post('category_name')) {
            $addCategoryResponse = $this->CategoryModel->saveCategory();
            if($addCategoryResponse['success']) {
                echo json_encode(['success' => true, 'message' => 'New category added', 'data' => $addCategoryResponse['data']]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Ooppss...something error!', 'data' => []]);
            }
            return false;
        } else {
            $categories = $this->CategoryModel->getAllCarCategories();
            $this->load->view("dashboard/pages/cars/categoriesList", ['categories' => $categories]);
        }
        return true;
    }

    public function carList() {
        $carsList = $this->CarModel->getCars();
        $this->load->view('dashboard/pages/cars/list', ['cars' => $carsList]);
    }

    public function showCarCategories() {
        $categories = $this->CategoryModel->getAllCarCategories();
        if($this->input->post('ajaxCall')) {
            echo json_encode(['success' => true, 'message'=> 'All categories', 'data' => ['categories' => $categories]]);
        } else {
            $this->load->view("dashboard/pages/cars/categoriesList", ['categories' => $categories]);
        }
    }

    public function deleteCar($id) {
        $response = $this->CarModel->removeCar($id);
        if($response) {
            $this->session->set_flashdata('success', 'Car Removed!');
        } else {
            $this->session->set_flashdata('error', 'Ooppss...something error!');
        }

        redirect('admin/cars/list');
    }

    public function deleteCarCategories($id) {
        $response = $this->CategoryModel->deleteCategory($id);
        if($response) {
            $this->session->set_flashdata('success','Category Removed!');
        } else {
            $this->session->set_flashdata('error', 'Ooppss...something error!');
        }

        redirect('admin/cars/categories/list');
    }

}
