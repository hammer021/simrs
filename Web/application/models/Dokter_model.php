<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
  private $_table = "tb_dokter";
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
	function hapus_data($id){
    $this->_deleteImage($id);
    return $this->db->delete($this->_table, array("no_praktek" => $id));
  }
  public function getById($id)
    {
        return $this->db->get_where($this->_table, ["no_praktek" => $id])->row();
    }
  function _deleteImage($id)
  {
      $dokter = $this->getById($id);
      if ($dokter->foto_dokter != "default.jpg") {
        $filename = explode(".", $dokter->foto_dokter)[0];
      return array_map('unlink', glob(FCPATH."assets/images/dokter/$filename.*"));
      }
  }
    function tampil_data($data){
		return $this->db->get($data);
	}
}
