<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsul_model extends CI_Model
{   private $_table = "tb_konsul";
    private $_table2 = "tb_keluhan";
    
    public function konsul(){

        return $this->db->query("SELECT * FROM tb_keluhan JOIN tb_pasien 
        ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien LEFT JOIN tb_dokter 
        ON tb_keluhan.no_praktek = tb_dokter.no_praktek LEFT JOIN 
        tb_registrasi ON tb_dokter.kd_regist=tb_registrasi.kd_regist")->result_array();
    }
    
	function hapus_data($id){
       
        return $this->db->delete($this->_table, array("no_rm" => $id));
        
      }
      function hapus_data2($id){
       
        
        return $this->db->delete($this->_table2, array("no_rm" => $id));
        
      }
      function input_data($data, $table){
		$this->db->insert($table, $data);
	}
    function update_data($where,$data,$table){
		$this->db->where($where);
        $this->db->update($table,$data);
        $data = array(
            'kd_konsul'=> $this->buat_kode(),
            'no_rm' => $this->input->post('no_rm')
		);
        $this->db->insert('tb_konsul', $data);
    }	
    public function buat_kode(){
        $this->db->select('RIGHT(tb_konsul.kd_konsul,2) as kode',FALSE);
        $this->db->order_by('kd_konsul', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('tb_konsul');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,2,"0",STR_PAD_LEFT);
        $kode_jadi="KONS00".$kode_max;
        return $kode_jadi;
    }
    public function konsuls($cari){

        return $this->db->query('SELECT * FROM tb_keluhan JOIN tb_pasien 
        ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien LEFT JOIN tb_dokter 
        ON tb_keluhan.no_praktek = tb_dokter.no_praktek where tb_keluhan.no_rm = "'.$cari.'"')->result_array();
    }
}
