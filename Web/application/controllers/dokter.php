<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dokter_model');
		$this->load->model('Resep_model');
		$params = $this->session->userdata("kd_regist");

		if (!empty($params)) {
		} else {
			redirect('auth?pesan=0005');
		}
	}

	public function dashboard()
	{
		$data['riwayatp'] = $this->Dokter_model->pasien_terakhir();
		$data['totpasien'] = $this->db->query("SELECT COUNT(tb_pasien.kd_pasien) AS jmlpasien FROM tb_pasien")->result_array();
		$data['totdokter'] = $this->db->query("SELECT COUNT(tb_dokter.no_praktek) AS jmldokter FROM tb_dokter")->result_array();
		$data['bulan1'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 1 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'" ')->result_array();
		$data['bulan2'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 2 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan3'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 3 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan4'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 4 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan5'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 5 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan6'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 6 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan7'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 7 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan8'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 8 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan9'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 9 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan11'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 11 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
		$data['bulan12'] = $this->db->query('SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan join tb_dokter_poli on tb_dokter_poli.kd_dok_pol=tb_dokter_poli.kd_dok_pol join tb_dokter on tb_dokter_poli.no_praktek=tb_dokter.no_praktek WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 12 AND tb_dokter.kd_regist = "'.$this->session->userdata('kd_regist').'"')->result_array();
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
	public function resep($page="")
	{
		$isi = $this->input->post('resep');
		if($page == "resep" && !empty($isi)){
			$data['resep'] = $this->Resep_model->tampil_resep($isi);
		}else{
			$data['resep'] = $this->Resep_model->tampil_resep();
		}
		$this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('dokter/vresep', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function laporanpemeriksaan($page="")
	{
		$isi = $this->input->post('lapperiksa');
		if($page == "lperiksa" && !empty($isi)){
			$data['dataperiksa'] = $this->Dokter_model->LapPemeriksaan($isi);
		}else{
			$data['dataperiksa'] = $this->Dokter_model->LapPemeriksaan();
		}
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
