<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class CategoryModel extends CI_Model {
    public function getAllCarCategories() {
        $categoryQuery = $this->db->from('car_categories')->get();
        if($categoryQuery->num_rows() > 0) {
            return $categoryQuery->result();
        }
        return false;
    }

    public function saveCategory() {
        $success = false;
        $data = null;
        try {
            //code...
            if($this->input->post('cate_id')) {
                if($this->db->where('id', $this->input->post('cate_id'))->update('car_categories',['category' => $this->input->post('category_name')])) {
                    $success = true;
                    $data['type'] = 'update';
                }
            } else {
                if($this->input->post('category_name')) {
                    if($this->db->insert('car_categories',['category' => $this->input->post('category_name')])) {
                        $lastId = $this->db->insert_id();
                        $getlastCategory = $this->db->where('id',$lastId)->get('car_categories')->row();
                        if($getlastCategory) {
                            $success = true;
                            $data['category'] = $getlastCategory;
                            $data['type'] = 'add';
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            $success = false;
        }
        return ['success' => $success, 'data' => $data];
    }

    public function deleteCategory($id) {
        if($this->db->where('id', $id)->delete('car_categories')) {
            $this->db->where('car_category_id', $id)->update('cars_rental', ['car_category_id' => 1]);
            return true;
        }
        return false;
    }
}