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
    function index_get() {
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
                    'message' => "Nomor Rekam Medis tidak Valid"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
?>