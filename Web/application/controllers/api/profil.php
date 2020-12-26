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
        $user = $this->api->index($id);
 
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
            $path2 = './assets/images/user/'.$config2;
            $id = $this->put('kd_regist');

            $user = $this->db->get_where('tb_registrasi', ['kd_regist' => $id])->row_array();
            if($user){
                    
                if($this->put('image')){
                    $foto = $this->put('image');

                $data = array(
                    'name' => $this->put('name'),
                    'image' => $config2,
                    'alamat'        => $this->put('alamat'),
                    'no_hp'         => $this->put('no_hp')

                );
                if ($this->db->update('tb_registrasi', $data, ['kd_regist' => $id])) {
                    file_put_contents($path2, base64_decode($foto));
                    $user = $this->db->get_where('tb_registrasi', ['kd_regist' => $id])->row_array();
                    // jika berhasil
                    $this->set_response([
                        'status' => true,
                        'message' => 'Berhasil Mengupdate Profil',
                        'update' => $user
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
                    'alamat'        => $this->put('alamat'),
                    'no_hp'         => $this->put('no_hp')      
                );
                
                if ($this->db->update('tb_registrasi', $data, ['kd_regist' => $id])) {
                    $user = $this->db->get_where('tb_registrasi', ['kd_regist' => $id])->row_array();  
                    // jika berhasil
                    $this->set_response([
                        'status' => true,
                        'message' => 'Berhasil Mengupdate Profil',
                        'update' => $user
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
    public function password_put() {
        if ($this->put('kd_regist')) {
            $kd_regist = $this->put('kd_regist');
            $password_lama = $this->put('password_lama');
            $password_new = $this->put('password_new');
            $password_hash = md5($password_new);

            $regist = $this->db->get_where('tb_registrasi ', ['kd_regist' => $kd_regist])->row_array();

            if ($regist) {

                if (md5($password_lama) == $regist['password']) {

                    $this->db->set('password', $password_hash);
                    $this->db->where('kd_regist', $kd_regist);

                    if( $this->db->update('tb_registrasi') ) {
                        // jika berhasil update
                        $this->set_response([
                            'status' => true,
                            'message' => 'Berhasil mengganti password'
                        ], 200);
                    } else {
                        // jika gagal update
                        $this->set_response([
                            'status' => false,
                            'message' => 'Gagal mengganti password'
                        ], 401);
                    }

                } else {
                    // jika password lama salah
                    $this->set_response([
                        'status' => false,
                        'message' => 'Password lama tidak sesuai'
                    ], 200);
                }

            } else {
                // jika tidak ada user dengan id 
                $this->set_response([
                    'status' => false,
                    'message' => 'User could not be found'
                ], 404);
            }
        } else {
            // jika tidak ada parameter id
            $this->set_response([
                'status' => false,
                'message' => 'User could not be found'
            ], 404);
        }
    }
}
