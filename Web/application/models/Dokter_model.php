<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model
{

  public function kode($id,$tabel,$kode,$substr)
    {
            $this->db->select_max($id);
            $query = $this->db->get($tabel);
            $row = $query->row();
            if($query){
                $idPostfix = (int)substr($row->$id,$substr)+1;
                $nextId = $kode.STR_PAD((string)$idPostfix,5,"0",STR_PAD_LEFT);
            }
            else{$nextId = $kode.'00001';} // For the first time
            return $nextId;
    }

  private $_table = "tb_dokter";
  private $_tableR = "tb_registrasi";
  function tampil_datadokter(){
		return $this->db->query("SELECT * FROM tb_dokter JOIN tb_registrasi
    ON tb_dokter.kd_regist = tb_registrasi.kd_regist ")->result();
  }
  public function tampils($isi){
    return $this->db->query("SELECT * FROM tb_dokter JOIN tb_registrasi
    ON tb_dokter.kd_regist = tb_registrasi.kd_regist WHERE tb_registrasi.name = $isi")->result();

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
    return $this->db->delete($this->_tableR, array("kd_regist" => $id));
  }
  function hapus_data2($noprktk){
    return $this->db->delete($this->_table, array("no_praktek" => $noprktk));
  }
  public function getById($id)
    {
        return $this->db->get_where($this->_tableR, ["kd_regist" => $id])->row();
    }
  function _deleteImage($id)
  {
      $dokter = $this->getById($id);
      if ($dokter->image != "default.jpeg") {
        $filename = explode(".", $dokter->image)[0];
      return array_map('unlink', glob(FCPATH."assets/images/dokter/$filename.*"));
      }
  }
    function tampil_data($data){
		return $this->db->get($data);
  }
  
  public function pemeriksaan(){
    $noprktk = $this->session->userdata("no_praktek");
    return $this->db->query("SELECT * FROM tb_keluhan JOIN tb_pasien 
    ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien LEFT JOIN tb_dokter 
    ON tb_keluhan.no_praktek = tb_dokter.no_praktek WHERE tb_keluhan.no_praktek = $noprktk")->result_array();

  }
}
