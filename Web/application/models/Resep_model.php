<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep_model extends CI_Model
{
    function tampil_resep($search = ""){
        $noprktk = $this->session->userdata("kd_regist");
        if(!empty($search)){
            return $this->db->query("SELECT * FROM tb_konsul 
            JOIN tb_resep ON tb_konsul.kd_resep = tb_resep.kd_resep  
            LEFT JOIN tb_keluhan ON tb_konsul.no_rm = tb_keluhan.no_rm  
            JOIN tb_dokter_poli ON tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol 
            LEFT JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek  
            WHERE tb_dokter.kd_regist = '$noprktk' AND tb_konsul.kd_resep='$isi'")->result();
        }else{
            return $this->db->query("SELECT * FROM tb_konsul 
            JOIN tb_resep ON tb_konsul.kd_resep = tb_resep.kd_resep  
            LEFT JOIN tb_keluhan ON tb_konsul.no_rm = tb_keluhan.no_rm  
            JOIN tb_dokter_poli ON tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol 
            LEFT JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek  
            WHERE tb_dokter.kd_regist = '$noprktk'")->result();
        }
		
  }
  function input_data($data, $table){
    $this->db->insert($table, $data);
}
function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
}	

}
