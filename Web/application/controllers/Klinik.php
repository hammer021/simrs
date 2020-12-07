<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klinik extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Klinik_model');
        $this->load->library('form_validation');
		
    }

    public function tambah_klinik(){
        $klinik = $this->Klinik_model;
        $validation = $this->form_validation;
        $validation->set_rules($klinik->rules());

        if ($validation->run()) {
            $klinik->input_data();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        redirect(site_url("Admin/dataklinik"));

    }
    public function hapusklinik($id=null){
        
        {
            if (!isset($id)) show_404();
            
            if ($this->Klinik_model->hapus_data($id)) {
                redirect(site_url('Admin/dataklinik'));
            }
        
    }
   
}
}
?>