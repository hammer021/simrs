<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
    function tampil_datadokter(){
		return $this->db->get('tb_dokter');
	}
}
