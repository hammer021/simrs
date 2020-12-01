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
            'kd_regist' => $id;
        );

        $user = $this->api->get($id,$arr);
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
        if($this->put('image')) {
            $path2 = '../uploads/reseller/pas_foto/'.$config2;
            $password = md5($this->put('password'))
            
            $reseller = $this->db->get_where('reseller', ['id_reseller' => $id])->row_array();
            if($reseller){

                    
                $data = array(
                    'name' => $this->put('name'),
                    'email' => $this->put('alamat'),
                    'image' => $this->put('no_tlp'),
                    'password' => $password,
                    'kd_role' => $this->put('kd_role'),
                    'is_active' => '1', 
                    'pas_foto' => $config2
                );
                if ($this->db->update('tb_akun', $data, ['id_reseller' => $id])) {
                    file_put_contents($path, base64_decode($scan_ktp));
                    file_put_contents($path2, base64_decode($pas_foto));
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
                    'nama_reseller' => $this->put('nama_reseller'),
                    'alamat' => $this->put('alamat'),
                    'no_tlp' => $this->put('no_tlp'),
                    'no_ktp' => $this->put('no_ktp'),
                    'email' => $this->put('email')              
                );
                
                if ($this->db->update('reseller', $data, ['id_reseller' => $id])) {                        
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
    }
}
