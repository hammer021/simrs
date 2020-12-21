<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{
     public function get_data()
    {
        $kd = $this->session->userdata("kd_regist");
        return $this->db->query("SELECT * FROM tb_registrasi   
        WHERE tb_registrasi.kd_regist = '$kd'")->result();
    }
    public function get_datadok()
    {
        $kd = $this->session->userdata("kd_regist");
        return $this->db->query("SELECT * FROM tb_dokter JOIN tb_registrasi 
        ON tb_dokter.kd_regist = tb_registrasi.kd_regist   
        WHERE tb_registrasi.kd_regist = '$kd'")->result();
    }
    
}
?>