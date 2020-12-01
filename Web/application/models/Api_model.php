<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{
    protected $registrasi = 'tb_registrasi';
    public function login($email,$password){
        $this->db->where('email', $email);
        $q = $this->db->get($this->registrasi);

        if($q->num_rows()) {
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
    public function get($tabel,$id){
        $get = $this->db->get_where($tabel,$id);
        return $get;
    }
    
}