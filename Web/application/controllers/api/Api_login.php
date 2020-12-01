<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_login extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Api_model');
    }

    //Menampilkan data kontak
    function index_post() {
        # Form Validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // Form Validation
            $message = array(
                'status' => false,
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors()
            );
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        } else {
            // Load Login Function
            $output = $this->Api_model->login($this->input->post('email'), $this->input->post('password'));
            if(!empty($output) AND $output != FALSE) {
                $this->load->library('Authorization_Token');

                $token_data['kd_regist'] = $output->kd_regist;
                $token_data['name'] = $output->name;
                $token_data['email'] = $output->email;
                $token_data['image'] = $output->image;
                $token_data['password'] = $output->password;
                $token_data['kd_role'] = $output->kd_role;
                $token_data['is_active'] = $output->is_active;
                $token_data['date_created'] = $output->date_created;
                $token_data['no_hp'] = $output->no_hp;
                $token_data['tgl_lahir'] = $output->tgl_lahir;
                $token_data['tempat_lahir'] = $output->tempat_lahir;

                $akun_token = $this->authorization_token->generateToken($token_data);

                $return_data = [
                    'kd_regist' => $output->kd_regist,
                    'name' => $output->name,
                    'email' => $output->email,
                    'image' => $output->image,
                    'password' => $output->password,
                    'kd_role' => $output->kd_role,
                    'is_active' => $output->is_active,
                    'date_created' => $output->date_created,
                    'alamat' => $output->alamat,
                    'no_hp' => $output->no_hp,
                    'tgl_lahir' => $output->tgl_lahir,
                    'tempat_lahir' => $output->tempat_lahir,
                    'token' => $akun_token,
                    'pesan' => "Selamat Datang",
                ];

                // Login Success
                $message = [
                    'status' => TRUE,
                    'data' => $return_data,
                    'message' => "Selamat Datang"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                // LoginError
                $message = [
                    'status' => FALSE,
                    'message' => "Email / Password Salah"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
?>