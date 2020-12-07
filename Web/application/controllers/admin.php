<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dokter_model');
		$this->load->model('Klinik_model');
		$this->load->model('Admin_model');
		$this->load->model('Konsul_model');
		
	}

	
	public function dashboard()
	{
		$data['totpasien'] = $this->db->query("SELECT COUNT(tb_pasien.kd_pasien) AS jmlpasien FROM tb_pasien")->result_array();
		$data['totdokter'] = $this->db->query("SELECT COUNT(tb_dokter.no_praktek) AS jmldokter FROM tb_dokter")->result_array();
		$data['bulan1'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 1")->result_array();
		$data['bulan2'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 2")->result_array();
		$data['bulan3'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 3")->result_array();
		$data['bulan4'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 4")->result_array();
		$data['bulan5'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 5")->result_array();
		$data['bulan6'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 6")->result_array();
		$data['bulan7'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 7")->result_array();
		$data['bulan8'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 8")->result_array();
		$data['bulan9'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 9")->result_array();
		$data['bulan10'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 10")->result_array();
		$data['bulan11'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 11")->result_array();
		$data['bulan12'] = $this->db->query("SELECT COUNT(EXTRACT(MONTH FROM tgl_kunjungan)) as aaa FROM tb_keluhan WHERE EXTRACT(MONTH FROM tgl_kunjungan) = 12")->result_array();
		$data['dokter'] = $this->db->query("SELECT * FROM tb_dokter")->result_array();
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
		$data['konsul'] = $this->Konsul_model->konsul();
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vpemeriksaan',$data);
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
	public function update_dokter()
	{
		$no_praktek = $this->input->post('no_praktek');
		$nama_dokter = $this->input->post('nama_dokter');
		$jadwal_praktek = $this->input->post('jadwal_praktek');
		$no_hp_dokter = $this->input->post('no_hp_dokter');
		$imgtarget = $this->input->post('foto_dokter');
		$file_ext = pathinfo($_FILES['foto_dokter']['name'], PATHINFO_EXTENSION);
		$target = ('assets/images/dokter' . $imgtarget);

		$config['upload_path']		=	'assets/images/dokter';
		$config['allowed_types']	=	'jpg|png|jpeg';
		$config['max_size']			=	2048;
		$config['file_name']		=	'picture-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

		echo $imgtarget;

		$this->load->library('upload', $config);
		if (@$_FILES['foto_dokter']['name'] != null) {
			if ($this->upload->do_upload('foto_dokter')) {
				if ($imgtarget != null) {

					unlink($target);
				}
				$where = array(
					'no_praktek' => $no_praktek
				);
				$data = array(
					'Nama_dokter' => $nama_dokter,
					'jadwal_praktek' => $jadwal_praktek,
					'no_hp_dokter' => $no_hp_dokter,
					'foto_dokter' => $config['file_name'] . "." . $file_ext
				);
				$this->Dokter_model->update_data($where, $data, 'tb_dokter');
				redirect('admin/datadokter');
			}
		} else {
			$where = array(
				'no_praktek' => $no_praktek
			);


			$data = array(
				'Nama_dokter' => $nama_dokter,
				'jadwal_praktek' => $jadwal_praktek,
				'no_hp_dokter' => $no_hp_dokter
			);
			$this->Dokter_model->update_data($where, $data, 'tb_dokter');
			redirect('admin/datadokter');
		}
	}
	public function tambah_dokter() 
	{
		$no_praktek = $this->input->post('no_praktek');
		$nama_dokter = $this->input->post('nama_dokter');
		$jadwal_praktek = $this->input->post('jadwal_praktek');
		$no_hp_dokter = $this->input->post('no_hp_dokter');
		$foto_dokter = $this->input->post('foto_dokter');
		$file_ext = pathinfo($_FILES['foto_dokter']['name'], PATHINFO_EXTENSION);

			$config['upload_path']		=	'assets/images/dokter';
             $config['allowed_types']	=	'jpg|png|jpeg|JPG|jfif';
             $config['max_size']			=	10048;
             $config['file_name']		=	'picture-'.date('ymd').'-'.substr(md5(rand()),0,10);

             $this->load->library('upload', $config);

             if(@$_FILES['foto_dokter']['name'] != null)
             {
                 if($this->upload->do_upload('foto_dokter'))
                 {
					$data = array(
					'no_praktek' => $no_praktek,
					'nama_dokter' => $nama_dokter,
					'jadwal_praktek' => $jadwal_praktek,
					'no_hp_dokter' => $no_hp_dokter,
					'foto_dokter' => $config['file_name'] . "." . $file_ext
					);
					$this->Dokter_model->input_data($data,'tb_dokter');
				
 
                     if($this->db->affected_rows() > 0)
                     {
                         echo "<script>alert('data Dokter Berhasil Di simpan');</script>";
                     }
                     echo "<script>window.location='".site_url('admin/datadokter')."';</script>";
 
                 }
                 else
                 {
					$error = array('error' => $this->upload->display_errors());
                     echo "<script>alert(".$error.");</script>";
                 }
                 if($this->db->affected_rows() > 0)
                 {
                     echo "<script>alert('data Dokter Berhasil Di simpan');</script>";
                 }
                 echo "<script>window.location='".site_url('admin/datadokter')."';</script>";
             
             } 
             else
             {	$data = array(
					'no_praktek' => $no_praktek,
					'nama_dokter' => $nama_dokter,
					'jadwal_praktek' => $jadwal_praktek,
					'no_hp_dokter' => $no_hp_dokter,
					'foto_dokter' => $config['file_name'] . "." . $file_ext
					);
			$this->Dokter_model->input_data($data,'tb_dokter');
	
     
                 if($this->db->affected_rows() > 0)
                 {
                     echo "<script>alert('data Dokter Berhasil Di simpan');</script>";
                 }
                 echo "<script>window.location='".site_url('admin/datadokter')."';</script>";
	}
}
public function hapusdokter($id){
	$this->Dokter_model->hapus_data($id);

	redirect('admin/datadokter');
}
public function hapuskonsul($id){
	$this->Konsul_model->hapus_data($id);

	redirect('admin/pemeriksaan');
}
public function dataklinik()
	{
		$klinik['listklinik'] = $this->Klinik_model->tampil_dataklinik()->result();
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdataklinik', $klinik);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
}