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
		$this->load->model('User_model');
		$this->load->model('Pasien_model');
		
	$params = $this->session->userdata("kd_regist");

	if(!empty($params)){
	}else{
			redirect('auth?pesan=0005');
		}
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
		$data['dokter'] = $this->Dokter_model->tampil_datadokter();
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
	public function profileadm()
	{
		redirect('Profile/tampiladm');
	}
	
	public function pemeriksaan($page = "")
	{
		$isi = $this->input->post('konsul');

		if($page == "periksa" && !empty($isi) ){
			$data['konsul'] = $this->Konsul_model->konsuls($isi);
		}else{
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$data['konsul'] = $this->Konsul_model->konsul();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vpemeriksaan', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function datadokter($page = "")
	{
		$isi = $this->input->post('dokter');

		if($page == "dokter"  && !empty($isi)){
			$dokter['listdokter'] = $this->Dokter_model->tampils($isi);
		}else{
			$dokter['listdokter'] = $this->Dokter_model->tampil_datadokter();
		}
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
	public function update_konsul(){
		$no_rm = $this->input->post('no_rm');
		$no_praktek = $this->input->post('dokter');
		$link=$this->input->post('link');
		if(!empty($link)){
			$where = array(
				'no_rm' => $no_rm
			);
			$data = array(
				'no_praktek' => $no_praktek,
				'status' => "2"
			);
			$link = array(
				'send_to' => $no_rm,
				'message' => $link,
				'status'=>"0"
			);
			$this->Konsul_model->update_data($where, $data, 'tb_keluhan');
			$this->Konsul_model->update_data($link, 'chat');
				redirect('admin/pemeriksaan');
		}else{
			redirect('admin/pemeriksaan?error=001');
			}
		}
	
	public function update_dokter()
	{
		$no_praktek = $this->input->post('no_praktek');
		$kd_regist = $this->input->post('kd_regist');
		$nama_dokter = $this->input->post('nama_dokter');
		$jadwal_praktek = $this->input->post('jadwal_praktek');
		$email=$this->input->post('email');
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
				//UPDATE tb_registrasi
				$where = array(
					'kd_regist' => $kd_regist
				);
				$data = array(
                'name'          => $nama_dokter,
                'email'         => $email,
                'image'         => $config['file_name'] . "." . $file_ext,
				'no_hp'			=> $no_hp_dokter
				);
				$this->Dokter_model->update_data($where, $data, 'tb_registrasi');
				//UPDATE tb_dokter
				$data2 = array(
                'no_praktek'          => $no_praktek,
                'jadwal_praktek'         => $jadwal_praktek
				);
				$this->Dokter_model->update_data($where, $data2, 'tb_dokter');
				redirect('admin/datadokter');
			}
		} else {
			$where = array(
				'kd_regist' => $kd_regist
			);


			$data = array(
				'name'          => $nama_dokter,
                'email'         => $email,
				'no_hp'			=> $no_hp_dokter
			);
			$this->Dokter_model->update_data($where, $data, 'tb_registrasi');
			
			$data2 = array(
			'no_praktek'          => $no_praktek,
			'jadwal_praktek'         => $jadwal_praktek
			);
			$this->Dokter_model->update_data($where, $data2, 'tb_dokter');


			redirect('admin/datadokter');
		}
	}
	public function tambah_dokter()
	{
		$no_praktek = $this->input->post('no_praktek');
		$nama_dokter = $this->input->post('nama_dokter');
		$jadwal_praktek = $this->input->post('jadwal_praktek');
		$no_hp_dokter = $this->input->post('no_hp_dokter');
		$email = $this->input->post('email');
		$pass = md5("123");
		$kode = $this->Dokter_model->kode('kd_regist', 'tb_registrasi', 'RGS' , '3');
		date_default_timezone_set("Asia/Jakarta");
        $date =  Date('Y-m-d h:i:s');
		$file_ext = pathinfo($_FILES['foto_dokter']['name'], PATHINFO_EXTENSION);

		$config['upload_path']		=	'assets/images/dokter';
		$config['allowed_types']	=	'jpg|png|jpeg|JPG|jfif';
		$config['max_size']			=	10048;
		$config['file_name']		=	'picture-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

		$this->load->library('upload', $config);

		if (@$_FILES['foto_dokter']['name'] != null) {
			if ($this->upload->do_upload('foto_dokter')) {
				$data = array(
				'kd_regist '    => $kode,
                'name'          => $nama_dokter,
                'email'         => $email,
                'image'         => $config['file_name'] . "." . $file_ext,
                'password'      => $pass,
                'kd_role'       => '2',
                'is_active'     => '1',
				'date_created'  => $date,
				'no_hp'			=> $no_hp_dokter
					
				);
				$this->Dokter_model->input_data($data, 'tb_registrasi');

				$data2 = array(
				'no_praktek '   		=> $no_praktek,
                'jadwal_praktek'        => $jadwal_praktek,
                'kd_regist'         => $kode
					
				);
				$this->Dokter_model->input_data($data2, 'tb_dokter');


				if ($this->db->affected_rows() > 0) {
					echo "<script>alert('data Dokter Berhasil Di simpan');</script>";
				}
				echo "<script>window.location='" . site_url('admin/datadokter') . "';</script>";
			} else {
				$error = array('error' => $this->upload->display_errors());
				echo "<script>alert(" . $error . ");</script>";
			}
			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('data Dokter Berhasil Di simpan');</script>";
			}
			echo "<script>window.location='" . site_url('admin/datadokter') . "';</script>";
		} else {
			$data = array(
				'kd_regist '    => $kode,
                'name'          => $nama_dokter,
                'email'         => $email,
                'image'         => 'default.jpeg',
                'password'      => $pass,
                'kd_role'       => '2',
                'is_active'     => '1',
				'date_created'  => $date,
				'no_hp'			=> $no_hp_dokter
					
				);
				$this->Dokter_model->input_data($data, 'tb_registrasi');

				$data2 = array(
				'no_praktek '   		=> $no_praktek,
                'jadwal_praktek'        => $jadwal_praktek,
                'kd_regist'         => $kode
					
				);
				$this->Dokter_model->input_data($data2, 'tb_dokter');


			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('data Dokter Berhasil Di simpan');</script>";
			}
			echo "<script>window.location='" . site_url('admin/datadokter') . "';</script>";
		}
	}
	
	public function hapusdokter($id)
	{
		$this->Dokter_model->hapus_data($id);
		$this->Dokter_model->hapus_data2($id);
		redirect('admin/datadokter');
	}

	public function hapuskonsul($id)
	{
		$this->Konsul_model->hapus_data($id);
		$this->Konsul_model->hapus_data2($id);

		redirect('admin/pemeriksaan');
	}
	public function datapasien($page = "")
	{
		$isi = $this->input->post('pasien');
		
		if($page == "pasien"  && !empty($isi)){
			$pasien['listpasien'] = $this->db->get_where('tb_pasien', ['nama_pasien' => $isi])->result();
		}else{
			$pasien['listpasien'] = $this->Pasien_model->tampil_datapasien()->result();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdatapasien', $pasien);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}

	public function dataklinik($page = "")
	{
		$isi = $this->input->post('klinik');

		if($page == "klinik"  && !empty($isi)){
			$klinik['listklinik'] = $this->db->get_where('tb_poli', ['klinik' => $isi])->result();
		}else{
			$klinik['listklinik'] = $this->Klinik_model->tampil_dataklinik()->result();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdataklinik', $klinik);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function datauser($page = "")
	{
		if($page == "user"){
			$isi = $this->input->post('user');
			$user['listuser'] = $this->db->get_where('tb_registrasi', ['name' => $isi])->result();
		}else{
			$user['listuser'] = $this->User_model->tampil_datauser()->result();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdatauser', $user);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function hapususer($id)
	{
		$this->User_model->hapus_data($id);
		redirect('admin/datauser');
	}
}
