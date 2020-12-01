<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    // Users Data
    public function getUserData()
    {
        $query = $this->db->get_where('tb_registrasi', ['email' => $this->session->userdata('email')]);
        return $query->row_array();
    }
    public function getUserDataAll()s
    {
        $query = $this->db->get('tb_registrasi');
        return $query->result_array();
    }

    // Login
    public function userCheckLogin($username)
    {
        $this->db->where("email =  '$username'");
        $query = $this->db->get('tb_registrasi');
        return $query->row_array();
    }
}
