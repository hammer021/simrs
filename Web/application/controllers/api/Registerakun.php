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
        date_default_timezone_set("Asia/Jakarta");
        $time =  Date('Y-m-d h:i:s');

        $data = array(
                    'id_user'       => '',
                    'name'          => $this->post('no_rm'),
                    'email'         => $this->post('first_name'),
                    'username'      => $this->post('last_name'),
                    'image'         => $this->post('email'),
                    'password'      => $password,
                    'kd_role'       => '1',
                    'is_active'     => '0',
                    'date_created'  => $time,
                    'alamat'        => $this->post('alamat'),
                    'no_hp'         => $this->post('no_hp'),
                    'tgl_lahir'     => $this->post('tgl_lahir'),
                    'tempat_lahir'  => $this->post('tempat_lahir'));
        $insert = $this->db->insert('tb_akun', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
