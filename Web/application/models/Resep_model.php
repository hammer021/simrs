<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep_model extends CI_Model
{
    function tampil_resep(){
        $noprktk = $this->session->userdata("kd_regist");
		return $this->db->query("SELECT * FROM tb_konsul 
        JOIN tb_resep ON tb_konsul.kd_resep = tb_resep.kd_resep  
        LEFT JOIN tb_keluhan ON tb_konsul.no_rm = tb_keluhan.no_rm  
        LEFT JOIN tb_dokter ON tb_keluhan.no_praktek = tb_dokter.no_praktek 
        WHERE tb_dokter.kd_regist = '$noprktk'")->result();
  }
  function input_data($data, $table){
    $this->db->insert($table, $data);
}
function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
}	

}