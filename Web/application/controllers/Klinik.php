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
    public function hapusklinik($id=null)
    {        
        if (!isset($id)) show_404();
            
        if ($this->Klinik_model->hapus_data($id)) {
            redirect(site_url('Admin/dataklinik'));
        }
    }   

    public function updatedata(){

        $kd_poli = $this->input->post('kd_poli');
        $nama_poli = $this->input->post('klinik');
        $harga = $this->input->post('harga_poli');
        $data = array(
            'klinik' => $nama_poli,
            'harga_poli' => $harga
        );

        if($this->Klinik_model->updatedataklinik($kd_poli, $data)){
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Update Data Klinik<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect('Admin/dataklinik');
        } else {
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Update Data Klinik<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('Admin/dataklinik');
        }
    }
}
