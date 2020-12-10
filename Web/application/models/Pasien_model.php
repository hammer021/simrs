<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
public function tampil_datapasien()
    {
        return $this->db->get('tb_pasien');
    }
    public function hapus_data($id)
    {
        return $this->db->delete($this->_table, array("tb_pasien" => $id));
    }
}