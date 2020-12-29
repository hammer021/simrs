<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function konsul(){

        return $this->db->query("SELECT * FROM tb_konsul JOIN tb_keluhan 
		ON tb_konsul.no_rm = tb_keluhan.no_rm JOIN tb_resep 
        ON tb_konsul.kd_resep=tb_resep.kd_resep JOIN tb_pasien 
        ON tb_keluhan.kd_pasien = tb_pasien.kd_pasien LEFT JOIN tb_dokter_poli 
        ON tb_keluhan.kd_dok_pol = tb_dokter_poli.kd_dok_pol LEFT JOIN tb_dokter 
        ON tb_dokter_poli.no_praktek = tb_dokter.no_praktek LEFT JOIN tb_poli
        ON tb_dokter_poli.kd_poli = tb_poli.kd_poli LEFT JOIN tb_registrasi 
        ON tb_dokter.kd_regist=tb_registrasi.kd_regist 
        WHERE tb_konsul.kd_resep IS NOT NULL ORDER BY tb_konsul.status_kons ASC ")->result_array();
    }
}