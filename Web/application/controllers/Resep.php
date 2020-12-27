<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('Resep_model');
        $this->load->library('form_validation');
		
    }
    public function buat_kode(){
        $this->db->select('RIGHT(tb_resep.kd_resep,2) as kode',FALSE);
        $this->db->order_by('kd_resep', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('tb_resep');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,2,"0",STR_PAD_LEFT);
        $kode_jadi="RES00".$kode_max;
        return $kode_jadi;
    }

    public function tambahresep(){
        $no_rm = $this->input->post('no_rm');
        $resep = $this->input->post('resep');
        $kd_resep = $this->buat_kode();
        if(!empty($resep)){
            $data = array(
				'resep '            => $resep,
                'kd_resep'             => $kd_resep
					
                );
            $where = array(
                    'no_rm '            => $no_rm
                        
                    );
            $data2 = array(
                    'kd_resep'             => $kd_resep,
                    'status'             => "0"
                        
                    );
                $this->Resep_model->input_data($data, 'tb_resep');
                $this->Resep_model->update_data($where, $data2, 'tb_konsul');
                redirect('Dokter/datapemeriksaan');
        }
        else{
            echo "Resep harus terisi";
        }


    }
}