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
                    'package_required_docs' => implode(',',$this->input->post('package_required_docs')),
                    'package_price' => $this->input->post('package_price')
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

    public function savePackageDetails($packageDatiles, $packageId = null) {
        if($packageId != null) {
            if($this->db->where('package_id', $packageId)->update('package_details', $packageDatiles)) {
                return true;
            } else {
                return false;
            }
        } elseif($this->db->insert('package_details', $packageDatiles)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function savePackageItineraryMapping($packageItineraryMappingData, $packageId = null) {
        if($packageId!=null) {
            if(!$this->db->where('package_id', $packageId)->delete('package_itinerary_mapping')) {
                return false;
            }
        }
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
            $check = $this->db->where('object_id', $lastInsertPackageId)->where('object_type', 'package')->get();
            if($check->num_rows() > 0) {
                $containt = $check->row();
                if(file_exists('./uploads/'.$containt->content)) {
                    unlink('./uploads/'.$containt->content);
                }
                if($this->db->where('id', $containt->id)->update('media_data',['content' => $fileStore['content']])) {
                    return $check->id;
                } else {
                    return false;
                }
            } else {
                if($this->db->insert('media_data', $fileStore)) {
                    return $this->db->insert_id();
                }
            }
        } else {
            return $this->upload->display_errors();
        }
    }

    public function getPackageDetails($id) {
        $this->db->select('a.package_name,a.package_details as discription,b.receiving_location,b.departure_location,b.receiving_timing,b.departure_time,b.package_days,b.package_nights,b.package_price,b.package_person_count,b.package_age_bar,b.package_required_docs, b.package_price,e.id as location_id,e.location');
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

    public function updateStatus() {
        if($this->input->post('id')) {
            $status = $this->input->post('status');
            $packageId = intval($this->input->post('id'));
            if($status == 'false') {
                $this->db->set('is_active', 0);
            } else {
                $this->db->set('is_active', 1);
            }
            $this->db->where('id', $packageId);
            if($this->db->update('packages')) {
                return true;
            } 
            return false;

        } else {
            return false;   
        }
        return false;
    }

    public function publishPackage($id, $status = true) {
        $success = false;
        $message = '';
        $this->db->trans_begin();
        if($this->db->where('package_id', $id)->get('package_days_visiting_details')->num_rows() > 0) {
            if($this->db->where('id',$id)->update('packages', ['published' => $status])) {
                $success = true;
                $message = $status ? 'Package published.' : 'Package un-published';
            } else {
                $message = 'Ooppss...somthing error.';
            }
        } else {
            $message = 'Days not included in this package.';
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $message = 'Transaction not completed successfully!';
        } else {
            $this->db->trans_commit();
            $message = 'Package published.';
        }
        return ['success' => $success, 'message' => $message];
    }
    
    public function updatePackage($id) {
        $success = false;
        $message = '';
        $this->db->trans_begin();
        $packageQuery = $this->db->where('id', $id)->get('packages');
        if($packageQuery->num_rows() > 0) {
            $package['package_name'] = $this->input->post('package_name');
            $package['package_details'] = $this->input->post('package_details');
            if($this->db->where('id',$id)->update('packages', $package)) {
                $packageDatiles = [
                    'package_location_id' => $this->input->post('package_location_id'),
                    'receiving_location' => $this->input->post('receiving_location'),
                    'departure_location' => $this->input->post('departure_location'),
                    'receiving_timing' => $this->input->post('receiving_time'),
                    'departure_time' => $this->input->post('departure_time'),
                    'package_days' => $this->input->post('package_days'),
                    'package_nights' => $this->input->post('package_nights'),
                    'package_person_count' => $this->input->post('package_person_count'),
                    'package_age_bar' => $this->input->post('package_age_bar'),
                    'package_required_docs' => implode(',',$this->input->post('package_required_docs')),
                    'package_price' => $this->input->post('package_price')
                ];
                if($this->savePackageDetails($packageDatiles, $id) == true) {
                    $packageItineraryMapping = [];
                    $itineraries = array_unique($this->input->post('package_itineraries'));
                    if(!empty($itineraries)) {
                        foreach($itineraries as $itinerary) {
                            if($this->db->where('package_id',$id)->where('itinerary_id', $itinerary)->get('package_itinerary_mapping')->num_rows() > 0) {
                                continue;
                            }
                            $packageItineraryMapping[] = [
                                'package_id' => $id,
                                'itinerary_id' => $itinerary
                            ];
                        }                    
                    }
                    $this->savePackageItineraryMapping($packageItineraryMapping);
                    if($_FILES['package_image']['tmp_name']) {
                        $this->uploadFile($package['package_name'], $id);
                    }
                } else {
                    $message = 'This package not updated yet 1.';    
                }
            } else {
                $message = 'This package not updated yet 2.';    
            }
        } else {
            $message = 'This package not updated yet 3.';
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        return ['success' => $success, 'message' => $message];
    }

}