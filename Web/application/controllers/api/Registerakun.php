<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Registerakun extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Api_model');
    }

    public function index_post(){
        $password = md5($this->input->post('password'));
        $email = $this->post('email');
        date_default_timezone_set("Asia/Jakarta");
        $time =  Date('Y-m-d h:i:s');
        $cek = $this->db->get_where('tb_registrasi', ['email' => $email])->row_array();

        

        if ($cek > 0){
            $response = [
                'status' => false,
                'message' => 'Email Telah Digunakan',
            ];
        }else{
            $data = array(
                'kd_regist '       => '',
                'name'          => $this->post('name'),
                'email'         => $this->post('email'),
                //'image'         => $this->post('image'),
                'password'      => $password,
                'kd_role'       => '3',
                'is_active'     => '0',
                'date_created'  => $time,
                'alamat'        => $this->post('alamat'),
                'no_hp'         => $this->post('no_hp'),
                'tgl_lahir'     => $this->post('tgl_lahir'),
                'tempat_lahir'  => $this->post('tempat_lahir'));
                
                $insert = $this->db->insert('tb_registrasi', $data);

                $digits = 2;
                $num = rand(pow(10, $digits-1), pow(10, $digits)-1);
                $tokennya = uniqid(true);
                $user_token = [
                    'email' => $email,
                    'token' => $tokennya,
                    'v_num' => $num,
                    'date_created' => $time
                ];

                $cek2 = $this->db->insert('user_token', $user_token);
                $this->_sendEmail($tokennya, $email, 'verify');

                $response = [
                    'status' => true,
                    'pesan' => 'Pendaftaran Akun Berhasil',
                ];
        }
        $this->response($response, 200);
    }
    private function _sendEmail($token ,$email ,$type){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'birrilwalisyah@gmail.com',
            'smtp_pass' => 'b4j1ng4n',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('birrilwalisyah@gmail.com', 'Admin Simrs');
        $this->email->to($email);
        $this->email->subject('Verifikasi Akun');
        $this->email->message();
        
       
		
		if ($this->email->send()){
			return true;
		}else{
				echo $this->email->print_debugger();
			}
	}

}
