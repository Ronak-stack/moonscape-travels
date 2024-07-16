<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class ItineraryModel extends CI_Model {

    public function getItineraries() {
        $query = $this->db->from('itineraries');
        $query = $this->db->get();
        if($query->num_rows()) {
            return $query->result();
        }
        return false;
    }

    public function add($itinerary) {
        if($this->db->insert('itineraries', $itinerary)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateItinerary($id, $array) {
        if($this->db->where('id',$id)->update('itineraries',$array)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteItinerary($id) {
        if($this->db->where('id',$id)->delete('itineraries')) {
            return true;
        } else {
            return false;
        }
    }

    public function getPackageItineraries($id) {
        $result = $this->db->select('b.id as itinery_id, b.itinerary_name')->from('package_itinerary_mapping as a')->join('itineraries as b', 'a.itinerary_id = b.id')->where('a.package_id',$id)->get();
        if($result->num_rows() > 0) {
            return $result->result();
        }
        return false;
    }
}