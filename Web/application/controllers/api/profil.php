<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * Keys Controller
 * This is a basic Key Management REST controller to make and delete keys
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Profil extends REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Api_model' , 'api');
    }

    public function index_get()
    {
        $id = $this->get('kd_regist');

        $arr = array(
            'kd_regist' => $id,
        );

        $user = $this->api->get('tb_registrasi',$arr);
        if ($user) {
            $this->response([
                'status' => TRUE,
                'data' => $user
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'User Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put(){
        if($this->put('kd_regist')) {
            $config2 = uniqid().'.jpeg';
            $path2 = '../uploads/user/'.$config2;
            $id = $this->put('kd_regist');
            $password = md5($this->put('password'));

            $reseller = $this->db->get_where('tb_registrasi', ['kd_regist' => $id])->row_array();
            if($reseller){
                    
                if($this->put('image')){
                    $foto = $this->put('image');

                $data = array(
                    'name' => $this->put('name'),
                    'email' => $this->put('email'),
                    'image' => $config2,
                    'password' => $password,
                    'alamat'        => $this->put('alamat'),
                    'no_hp'         => $this->put('no_hp'),
                    'tgl_lahir'     => $this->put('tgl_lahir'),
                    'tempat_lahir'  => $this->put('tempat_lahir')

                );
                if ($this->db->update('tb_registrasi', $data, ['kd_regist' => $id])) {
                    file_put_contents($path2, base64_decode($foto));
                    // jika berhasil
                    $this->set_response([
                        'status' => true,
                        'message' => 'Berhasil Mengupdate Profil'
                    ], 200);
                } else {
                    // jika gagal
                    $this->set_response([
                        'status' => false,
                        'message' => 'Gagal Mengupdate Profil'
                    ], 401);
                }
            }else{
                $data = array(
                    'name' => $this->put('name'),
                    'email' => $this->put('email'),
                    'password' => $password,
                    'alamat'        => $this->put('alamat'),
                    'no_hp'         => $this->put('no_hp'),
                    'tgl_lahir'     => $this->put('tgl_lahir'),
                    'tempat_lahir'  => $this->put('tempat_lahir')         
                );
                
                if ($this->db->update('tb_registrasi', $data, ['kd_regist' => $id])) {                        
                    // jika berhasil
                    $this->set_response([
                        'status' => true,
                        'message' => 'Berhasil Mengupdate Profil'
                    ], 200);
                } else {
                    // jika gagal
                    $this->set_response([
                        'status' => false,
                        'message' => 'Gagal Mengupdate Profil'
                    ], 401);
                }
            }
        }else{
            $this->set_response([
                'status' => false,
                'message' => 'Gagal Mengupdate Profil'
            ], 401);
        }

}else{
    $this->set_response([
        'status' => false,
        'message' => 'User tidak di temukan'
    ], 401);
}
}
}
