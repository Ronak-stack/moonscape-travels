<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[AllowDynamicProperties]
class CarModel extends CI_Model
{

    public function saveCar()
    {
        $status = false;
        try {
            $this->db->trans_begin();
            if ($this->input->post('car_name')) {
                $carRow = $this->db->where('car_name', $this->input->post('car_name'))->where('car_category_id', $this->input->post('car_category_id'))->get('cars_rental');
                if ($carRow->num_rows() > 0) {
                    $carData = $carRow->row();
                    if ($this->db->where('id', $carData->id)->update('cars_rental', [
                        'car_name' => $this->input->post('car_new_name'),
                        'car_category_id' => $this->input->post('new_car_category_id')
                    ])) {
                        if ($_FILES['car_image']['tmp_name']) {
                            $this->uploadFile('car', 'car_image', $carData->id);
                        }
                        $status = true;
                    }
                } else {
                    if ($this->db->insert('cars_rental', ['car_name' => $this->input->post('car_name'), 'car_category_id' => $this->input->post('car_category_id')])) {
                        if ($_FILES['car_image']['tmp_name']) {
                            $this->uploadFile('car', 'car_image', $this->db->insert_id());
                        }
                        $status = true;
                    }
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $status = true;
            }
        } catch (\Throwable $th) {
            $status = false;
        }

        return $status;
    }

    public function uploadFile($packageName, $fileImageName, $lastInsertId)
    {
        $config = array(
            'upload_path' => './uploads/',
            'allowed_types' => "gif|jpg|jpeg|png|mp4|3gp",
            'encrypt_name' => true
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($fileImageName)) {
            $uploaedFileData = $this->upload->data();
            $fileStore = [
                'content' => $uploaedFileData['file_name'],
                'content_name' => $packageName,
                'object_id' => $lastInsertId,
                'object_type' => 'car'
            ];
            $this->load->database();
            $check = $this->db->where('object_id', $lastInsertId)->get('media_data');
            if ($check->num_rows() > 0) {
                $oldData = $check->row();
                if (file_exists('./uploads/' . $oldData->content)) {
                    unlink('./uploads/' . $oldData->content);
                }
                if ($this->db->where('id', $oldData->id)->update('media_data', ['content' => $fileStore['content']])) {
                    return $oldData->id;
                } else {
                    return false;
                }
            }

            if ($this->db->insert('media_data', $fileStore)) {
                return $this->db->insert_id();
            }
        } else {
            return $this->upload->display_errors();
        }
    }

    public function getCars() {
        $this->db->select('a.*,b.category');
        $this->db->from('cars_rental as a');
        $this->db->join('car_categories as b', 'a.car_category_id = b.id', 'left');
        $carsQuery = $this->db->get();
        if($carsQuery->num_rows() > 0) {
            return $carsQuery->result();
        }
        return false;
    }

    public function removeCar($id) {
        if($this->db->where('id', $id)->delete('cars_rental')) {
            return true;
        }
        return false;
    }
}
