<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dokter_model');
		$this->load->model('Klinik_model');
		$this->load->model('Admin_model');
		$this->load->model('Konsul_model');
		$this->load->model('User_model');
        $this->load->model('Pasien_model');
        $this->load->model('Laporan_model');

	}
    public function laphasilkonsul()
	{
			
			$data['konsul'] = $this->Laporan_model->konsul();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();

		$this->load->view('templateLAP/header');
		$this->load->view('laporan/laphasilkonsul', $data);
		$this->load->view('templateLAP/footer');
		$this->load->helper('url');
	}
}