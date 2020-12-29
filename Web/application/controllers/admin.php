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

		if (!empty($params)) {
		} else {
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

		if ($page == "periksa" && !empty($isi)) {
			$data['konsul'] = $this->Konsul_model->konsuls($isi);
		} else {
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$data['konsul'] = $this->Konsul_model->konsul();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vpemeriksaan', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}

	public function filterpemeriksaan($page = "")
	{
		$isi = $this->input->post('konsul');

		if (empty($page)) {
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$data['konsul'] = $this->Konsul_model->konsul();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
		} else if ($page == "4") {
			$page = "0";
			$data['konsul'] = $this->Konsul_model->filterkonsuls($page);
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
		} else {

			$data['konsul'] = $this->Konsul_model->filterkonsuls($page);
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vpemeriksaan', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function hasilkonsul($page = "")
	{
		$isi = $this->input->post('konsul');

		if ($page == "periksa" && !empty($isi)) {
			$data['konsul'] = $this->Konsul_model->konsuls($isi);
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
		} else {
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$data['konsul'] = $this->Konsul_model->konsul0();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vhasilkonsul', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}

	
	public function filterhasilkonsul($page = "")
	{
		if (empty($page)) {
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$data['konsul'] = $this->Konsul_model->konsul0();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
		} else if ($page == "4") {
			$page = "0";
			$data['konsul'] = $this->Konsul_model->konsulfilter($page);
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
		} else {

			$data['konsul'] = $this->Konsul_model->konsulfilter($page);
			$data['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$data['linkkonsul'] = $this->Konsul_model->linkkonsul();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vhasilkonsul', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function filterjadwal($page = "")
	{
		$isi = $this->input->post('dokter');
		if ($page == "dokter"  && !empty($isi)) {
			$dokter['listdokter'] = $this->Dokter_model->tampils($isi);
		} else {
			if (empty($page)) {
				$dokter['listdokter'] = $this->Dokter_model->tampil_datadokter();
				$dokter['listdokter1'] = $this->Dokter_model->tampil_datadokter1();
				$dokter['listklinik'] = $this->Klinik_model->tampil_dataklinik()->result();
			}else {
	
				$dokter['listdokter'] = $this->Dokter_model->filter_datadokter($page);
				$dokter['listdokter1'] = $this->Dokter_model->tampil_datadokter1();
				$dokter['listklinik'] = $this->Klinik_model->tampil_dataklinik()->result();
			}
		}
		
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vjadwalDokter', $dokter);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function datadokter($page = "")
	{
		$isi = $this->input->post('dokter');

		if ($page == "dokter"  && !empty($isi)) {
			$dokter['listdokter'] = $this->Dokter_model->tampils($isi);
		} else {
			$dokter['listdokter'] = $this->Dokter_model->tampil_datadokter1();
			$dokter['listklinik'] = $this->Klinik_model->tampil_dataklinik()->result();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdatadokter', $dokter);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function jadwalDokter($page = "")
	{
		$isi = $this->input->post('dokter');

		if ($page == "dokter"  && !empty($isi)) {
			$dokter['listdokter'] = $this->Dokter_model->tampils($isi);
		} else {
			$dokter['listdokter'] = $this->Dokter_model->tampil_datadokter();
			$dokter['listdokter1'] = $this->Dokter_model->tampil_datadokter1();
			$dokter['listklinik'] = $this->Klinik_model->tampil_dataklinik()->result();
		}
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vjadwalDokter', $dokter);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}

	public function tambah_jadwal_dokter()
	{
		$no_praktek = $this->input->post('no_praktek');
		$kd_poli = $this->input->post('poli');
		$buka = $this->input->post('jadwal_praktek_buka');
		$tutup = $this->input->post('jadwal_praktek_tutup');
		$senin = $this->input->post('senin');
		$selasa = $this->input->post('selasa');
		$rabu = $this->input->post('rabu');
		$kamis = $this->input->post('kamis');
		$jumat = $this->input->post('jumat');
		$sabtu = $this->input->post('sabtu');
		$minggu = $this->input->post('minggu');

		if ($no_praktek !== null) {
			$data = array(
				'no_praktek '    		=> $no_praktek,
				'kd_poli'          		=> $kd_poli,
				'startwaktu'         	=> $buka,
				'endwaktu'         		=> $tutup,
				'senin'         		=> $senin,
				'selasa'         		=> $selasa,
				'rabu'         			=> $rabu,
				'kamis'         		=> $kamis,
				'jumat'         		=> $jumat,
				'sabtu'         		=> $sabtu,
				'minggu'         		=> $minggu

			);
			$this->Dokter_model->input_data($data, 'tb_dokter_poli');

			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('data Berhasil Di simpan');</script>";
			}
			echo "<script>window.location='" . site_url('admin/jadwalDokter') . "';</script>";
		} else {
			$error = array('error' => $this->upload->display_errors());
			echo "<script>alert(" . $error . ");</script>";
		}

		echo "<script>window.location='" . site_url('admin/jadwalDokter') . "';</script>";
	}
	public function update_jadwal_dokter()
	{
		$no_praktek = $this->input->post('no_praktek');
		$kd_dok_pol = $this->input->post('kd_dok_pol');
		$startwaktu = $this->input->post('startwaktu');
		$endwaktu = $this->input->post('endwaktu');
		$senin = $this->input->post('senin');
		$selasa = $this->input->post('selasa');
		$rabu = $this->input->post('rabu');
		$kamis = $this->input->post('kamis');
		$jumat = $this->input->post('jumat');
		$sabtu = $this->input->post('sabtu');
		$minggu = $this->input->post('minggu');
		if ($no_praktek !== null) {
			$where = array(
				'no_praktek'          		=> $no_praktek,
				'kd_dok_pol'          		=> $kd_dok_pol
			);
			$data = array(


				'startwaktu'         	=> $startwaktu,
				'endwaktu'         		=> $endwaktu,
				'senin'         		=> $senin,
				'selasa'         		=> $selasa,
				'rabu'         			=> $rabu,
				'kamis'         		=> $kamis,
				'jumat'         		=> $jumat,
				'sabtu'         		=> $sabtu,
				'minggu'         		=> $minggu

			);
			$this->Dokter_model->update_data($where, $data, 'tb_dokter_poli');

			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('data Berhasil Di simpan');</script>";
			}
			echo "<script>window.location='" . site_url('admin/jadwalDokter') . "';</script>";
		} else {
			$error = array('error' => $this->upload->display_errors());
			echo "<script>alert(" . $error . ");</script>";
		}

		echo "<script>window.location='" . site_url('admin/jadwalDokter') . "';</script>";
	}
	public function hapusjadwaldokter($kd_dok_pol)
	{
		$this->Dokter_model->hapus_data($kd_dok_pol);
		redirect('admin/jadwalDokter');
	}
	public function update_konsul()
	{
		$no_rm = $this->input->post('no_rm');
		$kd_dok_pol = $this->input->post('dokter');
		$tgl_konsul = $this->input->post('tgl_konsul');
		$link = $this->input->post('link');
		$sendby = $this->session->userdata("kd_regist");
		if (!empty($link)) {
			$where = array(
				'no_rm' => $no_rm
			);
			$data = array(
				'kd_dok_pol' => $kd_dok_pol,
				'jadwal_konsul' => $tgl_konsul,
				'status' => "3"
			);
			$link = array(
				'send_by' => $sendby,
				'send_to' => $no_rm,
				'message' => $link,
				'status'  => "0"
			);
			$this->Konsul_model->update_data($where, $data, 'tb_keluhan');
			$this->Konsul_model->input_data($link, 'chat');
			redirect('admin/pemeriksaan');
		} else {
			redirect('admin/pemeriksaan?error=001');
		}
	}
	public function update_hasil_konsul()
	{
		$kd_konsul = $this->input->post('kd_konsul');
		$no_rm = $this->input->post('no_rm');
		$kd_resep = $this->input->post('kd_resep');
		$harga_resep = $this->input->post('harga_resep');
		$harga_kirim = $this->input->post('harga_kirim');
		$grand_total = $harga_resep + $harga_kirim;
		if (!empty($kd_konsul)) {
			$where = array(
				'kd_konsul' => $kd_konsul,
				'no_rm' => $no_rm
			);
			$data = array(
				'harga_kirim' => $harga_kirim,
				'grand_total' => $grand_total,
				'status_kons' => "1"
			);
			$whereresep = array(
				'kd_resep' => $kd_resep
			);
			$dataresep = array(
				'harga_resep' => $harga_resep
			);
			$this->Konsul_model->update_data1($where, $data, 'tb_konsul');
			$this->Konsul_model->update_data1($whereresep, $dataresep, 'tb_resep');

			redirect('admin/hasilkonsul');
		} else {
			redirect('admin/hasilkonsul?error=001');
		}
	}
	public function update_acc_konsul()
	{
		$kd_konsul = $this->input->post('kd_konsul');
		if (!empty($kd_konsul)) {
			$where = array(
				'kd_konsul' => $kd_konsul
			);
			$data = array(
				'status_kons' => "3"
			);

			$this->Konsul_model->update_data1($where, $data, 'tb_konsul');

			redirect('admin/hasilkonsul');
		} else {
			redirect('admin/hasilkonsul?error=001');
		}
	}
	public function update_dokter()
	{
		$no_praktek = $this->input->post('no_praktek1');
		$no_praktek1 = $this->input->post('no_praktek');
		$kd_regist = $this->input->post('kd_regist');
		$nama_dokter = $this->input->post('nama_dokter');
		$email = $this->input->post('email');
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
				$where2 = array(
					'no_praktek'          => $no_praktek1
				);
				$data3 = array(
					'no_praktek'          => $no_praktek
				);
				$this->Dokter_model->update_data($where2, $data3, 'tb_dokter_poli');
				//UPDATE tb_dokter
				$data2 = array(
					'no_praktek'          => $no_praktek
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
			$where2 = array(
				'no_praktek'          => $no_praktek1
			);
			$data3 = array(
				'no_praktek'          => $no_praktek
			);
			$this->Dokter_model->update_data($where2, $data3, 'tb_dokter_poli');

			$data2 = array(
				'no_praktek'          => $no_praktek
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
		$kd_poli = $this->input->post('poli');
		$buka = $this->input->post('jadwal_praktek_buka');
		$tutup = $this->input->post('jadwal_praktek_tutup');
		$senin = $this->input->post('senin');
		$selasa = $this->input->post('selasa');
		$rabu = $this->input->post('rabu');
		$kamis = $this->input->post('kamis');
		$jumat = $this->input->post('jumat');
		$sabtu = $this->input->post('sabtu');
		$minggu = $this->input->post('minggu');
		$pass = md5("123");
		$kode = $this->Dokter_model->kode('kd_regist', 'tb_registrasi', 'RGS', '3');
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
					'kd_regist'         => $kode

				);
				$this->Dokter_model->input_data($data2, 'tb_dokter');
				$data3 = array(
					'no_praktek '   		=> $no_praktek,
					'kd_poli'         		=> $kd_poli,
					'startwaktu'        	=> $buka,
					'endwaktu'         		=> $tutup,
					'senin'         		=> $senin,
					'selasa'         		=> $selasa,
					'rabu'         			=> $rabu,
					'kamis'         		=> $kamis,
					'jumat'         		=> $jumat,
					'sabtu'         		=> $sabtu,
					'minggu'         		=> $minggu

				);
				$this->Dokter_model->input_data($data3, 'tb_dokter_poli');


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
				'kd_regist'         => $kode

			);
			$this->Dokter_model->input_data($data2, 'tb_dokter');
			$data3 = array(
				'no_praktek '   		=> $no_praktek,
				'kd_poli'         		=> $kd_poli,
				'startwaktu'        	=> $buka,
				'endwaktu'         		=> $tutup,
				'senin'         		=> $senin,
				'selasa'         		=> $selasa,
				'rabu'         			=> $rabu,
				'kamis'         		=> $kamis,
				'jumat'         		=> $jumat,
				'sabtu'         		=> $sabtu,
				'minggu'         		=> $minggu

			);
			$this->Dokter_model->input_data($data3, 'tb_dokter_poli');

			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('data Dokter Berhasil Di simpan');</script>";
			}
			echo "<script>window.location='" . site_url('admin/datadokter') . "';</script>";
		}
	}

	public function hapusdokter($id, $no_praktek)
	{
		$this->Dokter_model->hapus_data($id);
		$this->Dokter_model->hapus_data2($id);
		$this->Dokter_model->hapus_data_jadwalperpraktek($no_praktek);
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

		if ($page == "pasien"  && !empty($isi)) {
			$pasien['listpasien'] = $this->db->get_where('tb_pasien', ['nama_pasien' => $isi])->result();
		} else {
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

		if ($page == "klinik"  && !empty($isi)) {
			$klinik['listklinik'] = $this->db->get_where('tb_poli', ['klinik' => $isi])->result();
		} else {
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
		$user['listuser'] = $this->db->query(" SELECT tb_registrasi.kd_regist, tb_registrasi.name, 
		tb_registrasi.email, tb_registrasi.alamat, tb_registrasi.no_hp, 
		tb_registrasi.tgl_lahir, tb_registrasi.tempat_lahir, tb_registrasi.image FROM tb_registrasi WHERE tb_registrasi.kd_role=3")->result();

		// if ($page == "user") {
		// 	$isi = $this->input->post('user');
		// 	$user['listuser'] = $this->db->get_where('tb_registrasi', ['name' => $isi])->result();
		// } else {
		// 	$user['listuser'] = $this->User_model->tampil_datauser()->result();
		// }
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
	public function dataadmin($page = "")
	{
		$admin['listadmin'] = $this->Admin_model->tampildata();
		$this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vdataadmin', $admin);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}

	public function tambah_admin()
	{
		$kd_regist = $this->Admin_model->buat_kode();
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$password = md5("123");
		date_default_timezone_set("Asia/Jakarta");
		$date =  Date('Y-m-d h:i:s');
		$file_ext = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);

		$config['upload_path']		=	'assets/images/admin';
		$config['allowed_types']	=	'jpg|png|jpeg|JPG|jfif';
		$config['max_size']			=	10048;
		$config['file_name']		=	'picture-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);
		if (@$_FILES['images']['name'] != null) {
			if ($this->upload->do_upload('images')) {
				$data = array(
					'kd_regist'			=> $kd_regist,
					'name'				=> $name,
					'email'				=> $email,
					'alamat'			=> $alamat,
					'tempat_lahir'		=> $tempat_lahir,
					'tgl_lahir'			=> $tgl_lahir,
					'no_hp'				=> $no_hp,
					'image'			=> $config['file_name'] . "." . $file_ext,
					'password'			=> $password,
					'date_created'		=> $date,
					'kd_role'			=> '1',
					'is_active'			=> '1'
				);
				$this->Admin_model->input_data($data, 'tb_registrasi');

				if ($this->db->affected_rows() > 0) {
					echo "<script>alert('data Admin Berhasil Di simpan');</script>";
				}
				echo "<script>window.location='" . site_url('admin/dataadmin') . "';</script>";
			} else {
				$error = array('error' => $this->upload->display_errors());
				echo "<script>alert(" . $error . ");</script>";
			}
		} else {
			$data = array(
				'kd_regist'			=> $kd_regist,
				'name'				=> $name,
				'email'				=> $email,
				'alamat'			=> $alamat,
				'tempat_lahir'		=> $tempat_lahir,
				'tgl_lahir'			=> $tgl_lahir,
				'no_hp'				=> $no_hp,
				'image'			=> 'default.jpeg',
				'password'			=> $password,
				'date_created'		=> $date,
				'kd_role'			=> '1',
				'is_active'			=> '1'
			);
			$this->Admin_model->input_data($data, 'tb_registrasi');
			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('data Admin Berhasil Di simpan');</script>";
			}
			echo "<script>window.location='" . site_url('admin/dataadmin') . "';</script>";
		}
	}
	public function update_admin()
	{
		
		$kd_regist = $this->input->post('kd_regist');
		$nama = $this->input->post('name');
		$email = $this->input->post('email');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$imgtarget = $this->input->post('image');
		$file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$target = ('assets/images/admin' . $imgtarget);

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
					'name'          => $nama,
					'email'         => $email,
					'tgl_lahir'         => $tgl_lahir,
					'tempat_lahir'         => $tempat_lahir,
					'alamat'         => $alamat,
					'image'         => $config['file_name'] . "." . $file_ext,
					'no_hp'			=> $no_hp
				);
				$this->Admin_model->update_data($where, $data, 'tb_registrasi');
				
				redirect('admin/dataadmin');
			}
		} else {
			$where = array(
				'kd_regist' => $kd_regist
			);


			$data = array(
				'name'          => $nama,
					'email'         => $email,
					'tgl_lahir'         => $tgl_lahir,
					'tempat_lahir'         => $tempat_lahir,
					'alamat'         => $alamat,
					
					'no_hp'			=> $no_hp
			);
			$this->Admin_model->update_data($where, $data, 'tb_registrasi');
			

			redirect('admin/dataadmin');
		}
	}

	public function hapusadmin($id)
	{
		$this->Admin_model->hapus_data($id);
		redirect('admin/dataadmin');
	}
}
