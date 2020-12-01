<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{
    public function login($email,$password){
        $q = $this->db->where('tb_registrasi', $email)->num_rows();

        if($q > 0) {
            $akun_pass = $q->row('password');
            if(md5($password) === $akun_pass) {
                return $q->row();
            }
            return FALSE;
        } else {
            return FALSE;
        }
    }
    public function insert($tabel, $arr)
    {
        $cek = $this->db->insert($tabel, $arr);
        return $cek;
        
    }
    public function get($id,$tabel){
        $get = $this->db->get_where($tabel,$id);
        return $get;
    }
    
}