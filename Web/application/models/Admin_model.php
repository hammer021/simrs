<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
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
