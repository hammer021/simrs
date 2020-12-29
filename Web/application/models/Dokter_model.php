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
  private $_tableJadwal = "tb_dokter_poli";
  function tampil_datadokter(){
		return $this->db->query("SELECT * FROM tb_dokter_poli LEFT JOIN tb_dokter 
    ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek LEFT JOIN tb_poli
    ON tb_dokter_poli.kd_poli = tb_poli.kd_poli LEFT JOIN tb_registrasi 
    ON tb_dokter.kd_regist=tb_registrasi.kd_regist WHERE tb_registrasi.kd_role='2' ORDER BY tb_dokter_poli.kd_poli")->result();
  }
  function filter_datadokter($isi){
		return $this->db->query("SELECT * FROM tb_dokter_poli LEFT JOIN tb_dokter 
    ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek LEFT JOIN tb_poli
    ON tb_dokter_poli.kd_poli = tb_poli.kd_poli LEFT JOIN tb_registrasi 
    ON tb_dokter.kd_regist=tb_registrasi.kd_regist WHERE tb_registrasi.kd_role='2' AND tb_dokter_poli.kd_poli = '$isi' 
    ORDER BY tb_dokter_poli.kd_poli")->result();
  }
  function tampil_datadokter1(){
		return $this->db->query("SELECT * FROM tb_dokter LEFT JOIN tb_registrasi 
    ON tb_dokter.kd_regist=tb_registrasi.kd_regist WHERE tb_registrasi.kd_role='2'")->result();
  }
  public function tampils($isi){
    return $this->db->query("SELECT * FROM tb_dokter LEFT JOIN tb_registrasi 
    ON tb_dokter.kd_regist=tb_registrasi.kd_regist WHERE tb_registrasi.name='$isi'")->result();

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
  function hapus_data_jadwalperpraktek($id){
    return $this->db->delete($this->_tableJadwal, array("no_praktek" => $id));
  }
  function hapus_data_jadwal($id){
    return $this->db->delete($this->_tableJadwal, array("kd_dok_pol" => $id));
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
    JOIN tb_dokter_poli ON tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol 
    LEFT JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek  
    JOIN tb_pasien ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien 
    WHERE  tb_konsul.kd_resep IS NULL AND tb_keluhan.status = '0' AND tb_dokter.kd_regist = '$noprktk'")->result_array();

  }

  public function LapPemeriksaan($search="")
  {
    $noprktk = $this->session->userdata("kd_regist");
    if(!empty($search)){
      return $this->db->query("SELECT * FROM chat 
      JOIN tb_konsul ON chat.send_to = tb_konsul.no_rm
          JOIN tb_resep ON tb_konsul.kd_resep = tb_resep.kd_resep 
          JOIN tb_keluhan ON tb_keluhan.no_rm = tb_konsul.no_rm
          JOIN tb_dokter_poli ON tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol 
          LEFT JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek  
          JOIN tb_pasien ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien 
          JOIN tb_registrasi ON tb_dokter.kd_regist = tb_registrasi.kd_regist
      WHERE tb_keluhan.status = '0' AND tb_dokter.kd_regist = '$noprktk' AND tb_keluhan.no_rm='$search'")->result_array();
    }else{
      return $this->db->query("SELECT * FROM chat 
      JOIN tb_konsul ON chat.send_to = tb_konsul.no_rm
          JOIN tb_resep ON tb_konsul.kd_resep = tb_resep.kd_resep 
          JOIN tb_keluhan ON tb_keluhan.no_rm = tb_konsul.no_rm
          JOIN tb_dokter_poli ON tb_dokter_poli.kd_dok_pol = tb_keluhan.kd_dok_pol 
          LEFT JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek  
          JOIN tb_pasien ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien 
          JOIN tb_registrasi ON tb_dokter.kd_regist = tb_registrasi.kd_regist
      WHERE tb_keluhan.status = '0' AND tb_dokter.kd_regist = '$noprktk'")->result_array();
    }

  }
  
  public function pasien_terakhir(){
    $noprktk = $this->session->userdata("kd_regist");
    return  $this->db->query('SELECT tb_pasien.nama_pasien, tb_keluhan.no_rm, tb_pasien.foto, tb_pasien.no_tlp
    FROM `tb_dokter_poli` 
    JOIN tb_dokter ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek 
    JOIN tb_keluhan ON tb_dokter_poli.kd_dok_pol =tb_keluhan.kd_dok_pol 
    JOIN tb_pasien ON tb_keluhan.kd_pasien=tb_pasien.kd_pasien 
    where tb_dokter.kd_regist="'.$noprktk.'"')->result_array();
  }
}
