<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dokter_model');
		$this->load->model('Resep_model');
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
	public function profiledok()
	{
		redirect('Profile/tampildok');
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
		$periksa['dataperiksa'] = $this->Dokter_model->pemeriksaan();
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vdatapemeriksaan', $periksa);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function resep()
	{
		$data['resep'] = $this->Resep_model->tampil_resep();
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vresep', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function laporanpemeriksaan()
	{
		$data['dataperiksa'] = $this->Dokter_model->LapPemeriksaan();
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vlaporanpemeriksaan',$data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function cek()
	{
		$this->load->view('auth/aktivasi');
		$this->load->helper('url');
	}	
}
