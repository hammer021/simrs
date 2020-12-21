<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
		$this->load->model('Profile_model');
    }
     public function tampiladm()
    {
        $data['profile'] = $this->Profile_model->get_data();
        $this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/veditprofileadm', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
    }
    public function tampildok()
    {
        $data['profile'] = $this->Profile_model->get_datadok();
        $this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('admin/veditprofiledok', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
    }
    
    public function update_profile()
    {
        $kd_regist = $this->input->post('kd_regist');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_hp = $this->input->post('no_hp');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $imgtarget = $this->input->post('image');
		$file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$target = ('assets/images/' . $imgtarget);

		$config['upload_path']		=	'assets/images/';
		$config['allowed_types']	=	'jpg|png|jpeg';
		$config['max_size']			=	2048;
		$config['file_name']		=	'picture-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

		echo $imgtarget;

		$this->load->library('upload', $config);
		if (@$_FILES['image']['name'] != null) {
			if ($this->upload->do_upload('image')) {
				if ($imgtarget != null) {

					unlink($target);
				}
				//UPDATE tb_registrasi
				$where = array(
					'kd_regist' => $kd_regist
				);
				$data = array(
                'name'              => $name,
                'email'             => $email,
                'image'             => $config['file_name'] . "." . $file_ext,
                'no_hp'			    => $no_hp,
                'alamat'			=> $alamat,
                'tempat_lahir'		=> $tempat_lahir,
                'tgl_lahir'			=> $tgl_lahir
				);
				$this->Dokter_model->update_data($where, $data, 'tb_registrasi');
				
                redirect('admin/dashboard');
                
			}
		} else {
			$where = array(
				'kd_regist' => $kd_regist
			);


			$data = array(
				'name'              => $name,
                'email'             => $email,
                'no_hp'			    => $no_hp,
                'alamat'			=> $alamat,
                'tempat_lahir'		=> $tempat_lahir,
                'tgl_lahir'			=> $tgl_lahir
			);
			$this->Dokter_model->update_data($where, $data, 'tb_registrasi');
            redirect('admin/dashboard');
            
		}
    }

    public function update_profiledok()
    {
        $kd_regist = $this->input->post('kd_regist');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_praktek = $this->input->post('no_praktek');
        $jadwal_praktek = $this->input->post('jadwal_praktek');
        $no_hp = $this->input->post('no_hp');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $imgtarget = $this->input->post('image');
		$file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$target = ('assets/images/dokter/' . $imgtarget);

		$config['upload_path']		=	'assets/images/dokter/';
		$config['allowed_types']	=	'jpg|png|jpeg';
		$config['max_size']			=	2048;
		$config['file_name']		=	'picture-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

		echo $imgtarget;

		$this->load->library('upload', $config);
		if (@$_FILES['image']['name'] != null) {
			if ($this->upload->do_upload('image')) {
				if ($imgtarget != null) {

					unlink($target);
				}
				//UPDATE tb_registrasi
				$where = array(
					'kd_regist' => $kd_regist
				);
				$data = array(
                'name'              => $name,
                'email'             => $email,
                'image'             => $config['file_name'] . "." . $file_ext,
                'no_hp'			    => $no_hp,
                'alamat'			=> $alamat,
                'tempat_lahir'		=> $tempat_lahir,
                'tgl_lahir'			=> $tgl_lahir
				);
				$this->Dokter_model->update_data($where, $data, 'tb_registrasi');
				//UPDATE tb_dokter
				$data2 = array(
                    'no_praktek'          => $no_praktek,
                    'jadwal_praktek'         => $jadwal_praktek
                    );
                    $this->Dokter_model->update_data($where, $data2, 'tb_dokter');
                redirect('Dokter/dashboard');
                
			}
		} else {
			$where = array(
				'kd_regist' => $kd_regist
			);


			$data = array(
				'name'              => $name,
                'email'             => $email,
                'no_hp'			    => $no_hp,
                'alamat'			=> $alamat,
                'tempat_lahir'		=> $tempat_lahir,
                'tgl_lahir'			=> $tgl_lahir
			);
            $this->Dokter_model->update_data($where, $data, 'tb_registrasi');
            //UPDATE tb_dokter
				$data2 = array(
                    'no_praktek'          => $no_praktek,
                    'jadwal_praktek'         => $jadwal_praktek
                    );
                    $this->Dokter_model->update_data($where, $data2, 'tb_dokter');
            redirect('Dokter/dashboard');
            
		}
    }
}
?>