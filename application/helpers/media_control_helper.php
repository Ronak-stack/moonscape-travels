<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('saveMedia')) {
    function saveMedia($fileFieldName, $respectiveName, $respectiveId, $relation)
    {
        try {            
            $config = array(
                'upload_path' => "./uploads",
                'allowed_types' => "gif|jpg|jpeg|png|3gp",
                'overwrite' => TRUE,
                'encrypt_name' => TRUE
                );

            $ci = &get_instance();
            $ci->load->library('upload', $config);
            if($ci->upload->do_upload($fileFieldName)) {
                $fileUploadedData = $ci->upload->data();
                $fileStore = [
                    'content' => $fileUploadedData['file_name'],
                    'content_name' => $respectiveName,
                    'object_id' => $respectiveId,
                    'object_type' => $relation
                ];
                $ci->load->database();
                if($ci->db->insert('media_data', $fileStore)) {
                    return $ci->db->insert_id();
                }
            } else {
                return $ci->upload->display_errors();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return false;
    }
}

if(!function_exists('getMedia')) {
    function getMedia($id, $relation) {
        $ci =& get_instance();
        $ci->load->database();
        $mediaResult = $ci->db->from('media_data')->where('object_id',$id)->where('object_type', $relation)->get()->row();
        if($mediaResult) {
            return $mediaResult->content;
        }
        return false;
    }
}