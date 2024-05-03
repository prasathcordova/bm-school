<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stream_model
 *
 * @author docme2
 */
class Stream_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_stream_details($apikey, $query)
    {
        $this->db->flush_cache();
        if (strlen($query) > 0) {
            $stream = $this->db->query("[settings].[Stream_select] ?,?,?", array(0, $apikey, $query))->result_array();
        } else {
            $stream = $this->db->query("[settings].[Stream_select] ?,?,?", array(1, $apikey, NULL))->result_array();
        }
        return $stream;
    }

    public function add_new_stream($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $stream = $this->db->query("[settings].[Stream_save] ?,?,?", $dbparams)->result_array();
            if (!empty($stream) && is_array($stream)) {
                return $stream[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Stream not added. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Stream not added. Please check the data and try again');
        }
    }

    public function update_stream_data($dbparams)
    {
        $this->db->flush_cache();
        if (is_array($dbparams)) {
            $stream = $this->db->query("[settings].[Stream_update] ?,?,?,?,?,?", $dbparams)->result_array();
            if (!empty($stream) && is_array($stream)) {
                return $stream[0];
            } else {
                return array('ErrorStatus' => 1, 'ErrorMessage' => 'Stream not updated. Please check the data and try again');
            }
        } else {
            return array('ErrorStatus' => 1, 'ErrorMessage' => 'Stream not updated. Please check the data and try again');
        }
    }
}
