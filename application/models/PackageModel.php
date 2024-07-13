<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class PackageModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();

    }

    public function getAllLocations() {
        $query = $this->db->from('package_locations')->get();
        $packagesData = $query->result();
        if($packagesData) {
            return $packagesData;
        }
        return false;
    }

    public function savePackage() {
        $this->db->trans_begin();
        $package['package_name'] = $this->input->post('package_name');
        $package['package_details'] = $this->input->post('package_details');
        if($this->db->insert('packages', $package)) {
            $lastInsertPackageId = $this->db->insert_id();
            if($lastInsertPackageId) {
                $packageDatiles = [
                    'package_id' => $lastInsertPackageId,
                    'package_location_id' => $this->input->post('package_location_id'),
                    'receiving_location' => $this->input->post('receiving_location'),
                    'departure_location' => $this->input->post('departure_location'),
                    'receiving_timing' => $this->input->post('receiving_time'),
                    'departure_time' => $this->input->post('departure_time'),
                    'package_days' => $this->input->post('package_days'),
                    'package_nights' => $this->input->post('package_nights'),
                    'package_person_count' => $this->input->post('package_person_count'),
                    'package_age_bar' => $this->input->post('package_age_bar'),
                    'package_required_docs' => implode(',',$this->input->post('package_required_docs'))
                ];
                $savePackageDetailsId = $this->savePackageDetails($packageDatiles);
                if($savePackageDetailsId) {
                    $packageItineraryMapping = [];
                    $itineraries = $this->input->post('package_itineraries');
                    if(!empty($itineraries)) {
                        foreach($itineraries as $itinerary) {
                            $packageItineraryMapping[] = [
                                'package_id' => $lastInsertPackageId,
                                'itinerary_id' => $itinerary
                            ];
                        }
                    
                        $this->savePackageItineraryMapping($packageItineraryMapping);
                        if($_FILES['package_image']['tmp_name']) {
                            $this->uploadFile($package['package_name'], $lastInsertPackageId);
                        }
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

    public function savePackageDetails($packageDatiles) {
        if($this->db->insert('package_details', $packageDatiles)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function savePackageItineraryMapping($packageItineraryMappingData) {
        if($this->db->insert_batch('package_itinerary_mapping', $packageItineraryMappingData)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function getPackages() {
        return $this->db->from('packages')->get()->result();
    }

    public function uploadFile($packageName, $lastInsertPackageId) {
        $config = array(
            'upload_path' => './uploads/',
            'allowed_types' => "gif|jpg|jpeg|png|mp4|3gp",
            'encrypt_name' => true    
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($this->upload->do_upload('package_image')) {
            $uploaedFileData = $this->upload->data();
            $fileStore = [
                'content' => $uploaedFileData['file_name'],
                'content_name' => $packageName,
                'object_id' => $lastInsertPackageId,
                'object_type' => 'package'
            ];
            $this->load->database();
            if($this->db->insert('media_data', $fileStore)) {
                return $this->db->insert_id();
            }
        } else {
            return $this->upload->display_errors();
        }
    }

    public function getPackageDetails($id) {
        $this->db->select('a.package_name,a.package_details as discription,b.receiving_location,b.departure_location,b.receiving_timing,b.departure_time,b.package_days,b.package_nights,b.package_price,b.package_person_count,b.package_age_bar,b.package_required_docs,e.location');
        $this->db->from('packages as a');
        $this->db->join('package_details as b', 'a.id = b.package_id', 'left');;
        $this->db->join('package_locations as e', 'e.id = b.package_location_id', 'left');
        $details = $this->db->where('a.id',$id)->get();
        if($details->num_rows() != 0) {
            return $details->row();
        }
        return false;
    }

    public function removePackage($id) {
        $this->db->trans_begin();
        if($this->db->where('id',$id)->delete('packages')) {
            $this->db->where('package_id',$id)->delete('package_itinerary_mapping');
            $this->db->where('package_id',$id)->delete('package_details');
            $mediaDataRow = $this->db->from('media_data')->where('object_id',$id)->where('object_type','package')->get();
            if($mediaDataRow->num_rows() > 0) {
                $mediaData = $mediaDataRow->row();
                unlink('./uploads/'.$mediaData->content);
                $this->db->where('object_id',$id)->where('object_type','package')->delete('media_data');
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
}