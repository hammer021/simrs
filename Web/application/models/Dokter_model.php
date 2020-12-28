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
		return $this->db->query("SELECT * FROM tb_dokter_poli LEFT JOIN tb_dokter 
    ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek LEFT JOIN tb_poli
    ON tb_dokter_poli.kd_poli = tb_poli.kd_poli LEFT JOIN tb_registrasi 
    ON tb_dokter.kd_regist=tb_registrasi.kd_regist WHERE tb_registrasi.kd_role='2'")->result();
  }
  function tampil_datadokter1(){
		return $this->db->query("SELECT * FROM tb_dokter LEFT JOIN tb_registrasi 
    ON tb_dokter.kd_regist=tb_registrasi.kd_regist WHERE tb_registrasi.kd_role='2'")->result();
  }
  public function tampils($isi){
    return $this->db->query("SELECT * FROM tb_dokter_poli LEFT JOIN tb_dokter 
    ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek LEFT JOIN tb_poli
    ON tb_dokter_poli.kd_poli = tb_poli.kd_poli LEFT JOIN tb_registrasi 
    ON tb_dokter.kd_regist=tb_registrasi.kd_regist WHERE tb_registrasi.name = $isi")->result();

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
  
	function hapus_data2($id){
    $this->_deleteImage($id);
    return $this->db->delete($this->_tableR, array("kd_regist" => $id));
  }
  function hapus_data($id){
    return $this->db->delete($this->_table, array("kd_regist" => $id));
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
    $noprktk = $this->session->userdata("kd_regist");
    return $this->db->query("SELECT * FROM tb_konsul 
    LEFT JOIN tb_resep ON tb_konsul.kd_resep = tb_resep.kd_resep 
    JOIN tb_keluhan ON tb_keluhan.no_rm = tb_konsul.no_rm 
    LEFT JOIN tb_dokter ON tb_keluhan.no_praktek = tb_dokter.no_praktek
    JOIN tb_pasien ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien 
    WHERE tb_konsul.kd_resep='' AND tb_keluhan.status = '3' AND tb_dokter.kd_regist = '$noprktk'")->result_array();

  }

  public function LapPemeriksaan()
  {
    $noprktk = $this->session->userdata("kd_regist");
    return $this->db->query("SELECT * FROM tb_konsul 
    JOIN tb_resep ON tb_konsul.kd_resep = tb_resep.kd_resep 
    JOIN tb_keluhan ON tb_keluhan.no_rm = tb_konsul.no_rm 
    LEFT JOIN tb_dokter ON tb_keluhan.no_praktek = tb_dokter.no_praktek  
    JOIN tb_pasien ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien 
    JOIN tb_registrasi ON tb_dokter.kd_regist = tb_registrasi.kd_regist
    WHERE tb_keluhan.status = '3' AND tb_dokter.kd_regist = '$noprktk'")->result_array();

  }
}
