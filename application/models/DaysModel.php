<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class DaysModel extends CI_Model {

    public function addDays() {
        $this->db->trans_begin();
        
        $packageRow = $this->db->where('id',$this->input->post('package_id'))->get('packages');
        if($packageRow->num_rows() > 0) {
            $package = $packageRow->row();
            $packageDetails = $this->db->where('package_id',$package->id)->get('package_details');
            if($packageDetails->num_rows() > 0) {
                $packageDetailsData = $packageDetails->row();
                for($i = 0; $i < $packageDetailsData->package_days; $i++) {
                    if(!empty($this->input->post('day_description_'.($i+1)))) {
                        $dayName = 'Day '.($i+1);
                        $check = $this->db->where('package_id',$package->id)->where("day_name", $dayName)->get('package_days_visiting_details');
                        if($check->num_rows() > 0) {
                            $existsData = $check->row();
                            $this->db->where('id', $existsData->id)->update('package_days_visiting_details', [
                                'day_description' => $this->input->post('day_description_'.($i+1))
                            ]);
                            if($_FILES['day_image_'.($i+1)]['tmp_name']) {
                                $this->uploadFile($package->package_name, 'day_image_'.($i+1), $existsData->id);
                            }
                        } else {
                            if($this->db->insert('package_days_visiting_details', [
                                'package_id' => $package->id,
                                'day_name' => 'Day '.($i+1),
                                'day_description' => $this->input->post('day_description_'.($i+1))
                            ])) {
                                if($_FILES['day_image_'.($i+1)]['tmp_name']) {
                                    $this->uploadFile($package->package_name, 'day_image_'.($i+1), $this->db->insert_id());
                                }
                            }
                        }
                    } else {
                        continue;
                    }
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        return false;
    }

    public function uploadFile($packageName, $fileImageName, $lastInsertId) {
        $config = array(
            'upload_path' => './uploads/',
            'allowed_types' => "gif|jpg|jpeg|png|mp4|3gp",
            'encrypt_name' => true    
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload($fileImageName)) {
            $uploaedFileData = $this->upload->data();
            $fileStore = [
                'content' => $uploaedFileData['file_name'],
                'content_name' => $packageName,
                'object_id' => $lastInsertId,
                'object_type' => 'day'
            ];
            $this->load->database();
            $check = $this->db->where('object_id',$lastInsertId)->get('media_data');
            if($check->num_rows() > 0) {
                $oldData = $check->row();
                if(file_exists('./uploads/'.$oldData->content)) {
                    unlink('./uploads/'.$oldData->content);
                }
                if($this->db->where('id', $oldData->id)->update('media_data',['content' => $fileStore['content']])) {
                    return $oldData->id;
                } else {
                    return false;
                }
            }

            if($this->db->insert('media_data', $fileStore)) {
                return $this->db->insert_id();
            }
        } else {
            return $this->upload->display_errors();
        }
    }

    // Get Days with package name all and specified
    public function getDaysWithPackages($dayId = null) {
        $this->db->select('a.*,b.package_name');
        $this->db->from('package_days_visiting_details as a');
        $this->db->join('packages as b', 'b.id = a.package_id', 'left');
        if($dayId != null && is_int($dayId)) {
            $this->db->where('a.id', $dayId);
        }
        $daysQuery = $this->db->get();
        if($daysQuery->num_rows() > 0) {
            return $daysQuery->result();
        }
        return false;
    }
}