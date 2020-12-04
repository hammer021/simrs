<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dokter_model');
	}

	public function dashboard()
	{
		$data['totpasien'] = $this->db->query("SELECT COUNT(tb_pasien.kd_pasien) AS jmlpasien FROM tb_pasien")->result_array();
		$data['totdokter'] = $this->db->query("SELECT COUNT(tb_dokter.no_praktek) AS jmldokter FROM tb_dokter")->result_array();
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/dashboard', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function index()
	{
		$this->dashboard();
	}
	public function chatdokter()
	{
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vchatdokter');
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function datapemeriksaan()
	{
		$dokter['listdokter'] = $this->Dokter_model->tampil_datadokter()->result();
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vdatapemeriksaan', $dokter);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function resep()
	{
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vresep');
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function tindakanmedis()
	{
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vtindakanmedis');
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function cek()
	{
		$this->load->view('auth/aktivasi');
		$this->load->helper('url');
	}	
}
