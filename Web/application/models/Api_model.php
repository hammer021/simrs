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

    public function index($id){  
        return $this->db->get_where('tb_registrasi' , ['kd_regist' => $id])->result_array();
    }
    
    public function kode($id,$tabel,$kode,$substr)
    {
            // $query = $this->db->select($id)
            //                   ->from($tabel)
            //                   ->get();
            $this->db->select_max($id);
            $query = $this->db->get($tabel);
            $row = $query->row();
            // $row = $query->last_row();
            if($query){
                $idPostfix = (int)substr($row->$id,$substr)+1;
                $nextId = $kode.STR_PAD((string)$idPostfix,5,"0",STR_PAD_LEFT);
            }
            else{$nextId = $kode.'00001';} // For the first time
            return $nextId;
    }

    public function getKeluhan($no_rm = null)
    {
        $this->db->select('tb_keluhan.*');
        $this->db->from('tb_keluhan');
        $this->db->join('tb_pasien','tb_pasien.kd_pasien = tb_keluhan.kd_pasien');
        $this->db->where('tb_keluhan.no_rm', $no_rm);
        $income = $this->db->get()->result_array();
        return $income;
    }
}