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
	
	//ADMIN
	public function tampiladm()
    {
        $data['profile'] = $this->Profile_model->get_data();
        $this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/veditprofileadm', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function changepassadm()
    {
        $data['pass'] = $this->Profile_model->get_data();
        $this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vubahpassword',$data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function update_pass()
	{
		$kd_regist = $this->input->post('kd_regist');
		$pass_lama = md5($this->input->post('passlama'));
		$pass_baru = $this->input->post('passbaru');
		$pass_baruRpt = $this->input->post('rptpassbaru');
		$passsess = $this->session->userdata('password');
		if($pass_lama == $passsess){
			if($pass_baru == $pass_baruRpt  ){
				$passbaruMD5=md5($pass_baruRpt);
				//UPDATE tb_registrasi
				$where = array(
					'kd_regist' => $kd_regist
				);
				$data = array(
				'password'			=> $passbaruMD5
				);
				$this->Dokter_model->update_data($where, $data, 'tb_registrasi');
				
				redirect('admin/dashboard');
			}
			else{
				redirect(base_url('Profile/changepassadm?pesan=gakcocok'));
			//echo "Pengulangan Password tidak cocok!" ;
			}
		}
		else{
			redirect(base_url('Profile/changepassadm?pesan=gakcocoklama'));

		}
		
		
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
	
	//DOKTER
    public function tampildok()
    {
        $data['profile'] = $this->Profile_model->get_datadok();
        $this->load->view('template/header');
		$this->load->view('template/doktersidemenu');
		$this->load->view('admin/veditprofiledok', $data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function changepassdok()
    {
        $data['pass'] = $this->Profile_model->get_datadok();
        $this->load->view('template/header');
		$this->load->view('template/sidemenu');
		$this->load->view('admin/vubahpassword',$data);
		$this->load->view('template/footer');
		$this->load->helper('url');
	}
	public function update_passdok()
	{
		$kd_regist = $this->input->post('kd_regist');
		$pass_lama = md5($this->input->post('passlama'));
		$pass_baru = $this->input->post('passbaru');
		$pass_baruRpt = $this->input->post('rptpassbaru');
		$passsess = $this->session->userdata('password');
		if($pass_lama == $passsess){
			if($pass_baru == $pass_baruRpt  ){
				$passbaruMD5=md5($pass_baruRpt);
				//UPDATE tb_registrasi
				$where = array(
					'kd_regist' => $kd_regist
				);
				$data = array(
				'password'			=> $passbaruMD5
				);
				$this->Dokter_model->update_data($where, $data, 'tb_registrasi');
				
				redirect('dokter/dashboard');
			}
			else{
				redirect(base_url('Profile/changepassdok?pesan=gakcocok'));
			//echo "Pengulangan Password tidak cocok!" ;
			}
		}
		else{
			redirect(base_url('Profile/changepassdok?pesan=gakcocoklama'));

		}
		
		
	}
	
    public function update_profiledok()
    {
        $kd_regist = $this->input->post('kd_regist');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $no_praktek = $this->input->post('no_praktek');
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
                    'no_praktek'          => $no_praktek
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
                    'no_praktek'          => $no_praktek
                    );
                    $this->Dokter_model->update_data($where, $data2, 'tb_dokter');
            redirect('Dokter/dashboard');
            
		}
	}
	//--------------------------------------------------------------------------->
   

}
?>