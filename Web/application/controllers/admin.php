<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
		$this->load->view('template/sidemenu');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->view('auth/login');
		$this->load->helper('url');
	}
	public function pemeriksaan()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vpemeriksaan');
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function datadokter()
	{
		$dokter['listdokter'] = $this->Dokter_model->tampil_datadokter()->result();
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdatadokter', $dokter);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function cek()
	{
		$this->load->view('auth/aktivasi');
		$this->load->helper('url');
	}	
}
