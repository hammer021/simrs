<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdatadokter');
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function cek()
	{
		$this->load->view('auth/aktivasi');
		$this->load->helper('url');
	}	
}
