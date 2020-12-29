<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{   private $_table = "tb_registrasi";
    public function getUserRoleById($role_id)
    {
        return $this->db->get_where('tb_role', ['id' => $role_id])->row_array();
    }
    public function getUserRoleAll()
    {
        return $this->db->get('tb_role')->result_array();
    }
    public function searchUserData()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('name', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('username', $keyword);
        return $this->db->get('tb_registrasi')->result_array();
    }
    public function tampildata()
    {
        return $this->db->query(" SELECT tb_registrasi.kd_regist, tb_registrasi.name, 
		tb_registrasi.email, tb_registrasi.alamat, tb_registrasi.no_hp, 
		tb_registrasi.tgl_lahir, tb_registrasi.tempat_lahir, tb_registrasi.image 
        FROM tb_registrasi WHERE tb_registrasi.kd_role = 1")->result();

    }
    function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
  }	
  function hapus_data($id){
    $this->_deleteImage($id);
    return $this->db->delete($this->_table, array("kd_regist" => $id));
  }
  public function getById($id)
  {
      return $this->db->get_where($this->_table, ["kd_regist" => $id])->row();
  }
private function _deleteImage($id)
{
$data = $this->getById($id);
if ($data->image != "default.jpg") {
    $filename = explode(".", $data->image)[0];
    return array_map('unlink', glob(FCPATH."assets/images/admin/$filename.*"));
}
}
    public function buat_kode()
    {
        $this->db->select('RIGHT(tb_registrasi.kd_regist,4) as kode', FALSE);
        $this->db->order_by('kd_regist', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tb_registrasi');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kode_max = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kode_jadi = "RGS0" . $kode_max;
        return $kode_jadi;
    }

    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
}
