<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsul_model extends CI_Model
{   private $_table = "tb_konsul";
    
    public function konsul(){

        return $this->db->query("SELECT * FROM tb_keluhan JOIN tb_pasien 
        ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien LEFT JOIN tb_dokter 
        ON tb_keluhan.no_praktek = tb_dokter.no_praktek")->result_array();
    }
    
	function hapus_data($id){
       
        return $this->db->delete($this->_table, array("no_rm" => $id));
      }
}
