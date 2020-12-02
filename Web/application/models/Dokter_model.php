<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
    function tampil_datadokter(){
		return $this->db->get('tb_dokter');
    }
    function input_data($data, $table){
		$this->db->insert($table, $data);
	}
	function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}
    function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
    }
    function tampil_data($data){
		return $this->db->get($data);
	}
}
