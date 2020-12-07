<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinik_model extends CI_Model
{
	private $_table = "tb_poli";
	public $klinik;
	public function rules()
    {
        return [
            

            ['field' => 'klinik',
            'label' => 'klinik',
            'rules' => 'required']

        ];
    }
    function tampil_dataklinik(){
		return $this->db->get('tb_poli');
	}
	public function input_data(){
        $post = $this->input->post();
        $this->kd_poli = $this->buat_kode();
        $this->klinik = $post["klinik"];
        
        return $this->db->insert($this->_table, $this);

    }
    public function buat_kode(){
        $this->db->select('RIGHT(tb_poli.kd_poli,2) as kode',FALSE);
        $this->db->order_by('kd_poli', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('tb_poli');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,2,"0",STR_PAD_LEFT);
        $kode_jadi="POL00".$kode_max;
        return $kode_jadi;
    }
    
	function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}
    function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
    }	
    
    public function updatedataklinik($kd_poli, $data){
        $this->db->where('kd_poli', $kd_poli);
        return $this->db->update('tb_poli', $data);
    }
	function hapus_data($id){
		return $this->db->delete($this->_table, array("kd_poli" => $id));
    }
    function tampil_data($data){
		return $this->db->get($data);
	}
}
