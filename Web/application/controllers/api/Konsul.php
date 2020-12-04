<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Konsul extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Api_model');
    }

    function index_get()
    {
        $l = $this->get('no_rm');
        $this->db->select('no_rm, nama_pasien, status, keluhan, tgl_kunjungan');    
        $this->db->from('tb_keluhan');
        $this->db->join('tb_pasien', 'tb_keluhan.kd_pasien = tb_pasien.kd_pasien');
        $this->db->where('tb_keluhan.no_rm', $l);
        $a = $this->db->get();
        $query = $a->row();

        $output = $this->db->get_where('tb_keluhan',  array('no_rm' => $l))->row_array();
            if(!empty($output)){
         
                $this->load->library('Authorization_Token');
                $token_data['no_rm'] = $query->no_rm;
                $token_data['nama_pasien'] = $query->nama_pasien;
                $token_data['status'] = $query->status;
                $token_data['keluhan'] = $query->keluhan;
                $token_data['tgl_kunjungan'] = $query->tgl_kunjungan;
                
                $this->authorization_token->generateToken($token_data);

                $return_data = [
                    'no_rm' => $query->no_rm,
                    'nama_pasien' => $query->nama_pasien,
                    'status'      => $query->status,
                    'keluhan'     => $query->keluhan,
                    'tgl_kunjungan' => $query->tgl_kunjungan
                ];

            $message = [
                'status' => TRUE,
                'data'   => $return_data,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            echo 'asdasd'.$l;
            $message = [
                'status' => FALSE,
                'message' => "No Rm tidak ditemukan"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }

    }
    function index_post()
    {
        // deklarasi untuk query
        $id_user = $this->post('kd_regist');
        $nama_pasien = $this->post('nama_pasien');
        $tgl_lahir = $this->post('tgl_lahir');

        // parsing data uniqkode
        $kode = $this->Api_model->kode('kd_pasien', 'tb_pasien', 'PSN', '3');
        $no_rm = $this->Api_model->kode('no_rm', 'tb_keluhan', 'RM', '2' );

        // mencari umur
        date_default_timezone_set("Asia/Jakarta");
        $time =  Date('Y-m-d');
        $sekarang = date_create($time);
        $lahir = date_create($tgl_lahir);
        $a = date_diff($lahir,$sekarang);
        $umur = $a->format("%y Tahun");

        // Query
        $query = $this->db->select('*')->from('tb_pasien')
                    ->group_start()
                        ->where('kd_regist', $id_user)
                        ->where('nama_pasien', $nama_pasien)
                    ->group_end()
                ->get(); 
        $cek = $query->num_rows();    

        if ($cek > 0){
            $response = [
                'status' => false,
                'message' => 'Nama Pasien sudah terdaftar di akun anda',
            ];
        }else{
            $data = array(
                'kd_pasien '            => $kode,
                'kd_regist'             => $id_user,
                'nama_pasien'           => $nama_pasien,
                'tempat_lahir'          => $this->post('tempat_lahir'),
                'tgl_lahir'             => $this->post('tgl_lahir'),
                'umur'                  => $umur,
                'jenis_kelamin'         => $this->post('jenis_kelamin'),
                'keterbatasan'          => $this->post('keterbatasan'));

            $data2 = array(
                'no_rm'                 => $no_rm,
                'kd_pasien '            => $kode,
                'tgl_kunjungan '        => $time,
                'keluhan '              => $this->post('keluhan'),
                'status '               => 'Proses');    
                
                $insert = $this->db->insert('tb_pasien', $data);
                $insert2 = $this->db->insert('tb_keluhan', $data2);

    
                $response = [
                    'status' => true,
                    'pesan' => 'Pendaftaran Akun Berhasil',
                ];
        }
        $this->response($response, 200);
    }
    
    
}