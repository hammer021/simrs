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
        $l = $this->get('kd_regist');
        $this->db->select('no_rm, nama_pasien, status, keluhan, tgl_kunjungan');    
        $this->db->from('tb_pasien');
        $this->db->join('tb_keluhan', 'tb_keluhan.kd_pasien = tb_pasien.kd_pasien');
        $this->db->where('kd_regist', $l);
        $a = $this->db->get();
        $query = $a->row_array();

        $output = $this->db->get_where('tb_pasien',  array('kd_regist' => $l))->row_array();
            if(!empty($output)){
         
                $return_data = [
                    'no_rm' => $query['no_rm'],
                    'nama_pasien' => $query['nama_pasien'],
                    'status'      => $query['status'],
                    'keluhan'     => $query['keluhan'],
                    'tgl_kunjungan' => $query['tgl_kunjungan']
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
        $foto = $this->post('foto');

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
            if(!empty($foto)){
            $data = array(
                'kd_pasien '            => $kode,
                'kd_regist'             => $id_user,
                'nama_pasien'           => $nama_pasien,
                'tempat_lahir'          => $this->post('tempat_lahir'),
                'tgl_lahir'             => $this->post('tgl_lahir'),
                'umur'                  => $umur,
                'jenis_kelamin'         => $this->post('jenis_kelamin'),
                'warga_negara'          => $this->post('warga_negara'),
                'status_perkawinan'     => $this->post('status_perkawinan'),
                'pendidikan'            => $this->post('pendidikan'),
                'agama'                 => $this->post('agama'),
                'pekerjaan'             => $this->post('pekerjaan'),
                'no_nik'                => $this->post('no_nik'),
                'alamat_pasien'         => $this->post('alamat_pasien'),
                'no_tlp'                => $this->post('no_tlp'),
                'nama_ayah'             => $this->post('nama_ayah'),
                'nama_ibu'              => $this->post('nama_ibu'),
                'keterbatasan'          => $this->post('keterbatasan'));

            
            }else{
                $data = array(
                    'kd_pasien '            => $kode,
                    'kd_regist'             => $id_user,
                    'nama_pasien'           => $nama_pasien,
                    'tempat_lahir'          => $this->post('tempat_lahir'),
                    'tgl_lahir'             => $this->post('tgl_lahir'),
                    'umur'                  => $umur,
                    'jenis_kelamin'         => $this->post('jenis_kelamin'),
                    'warga_negara'          => $this->post('warga_negara'),
                    'status_perkawinan'     => $this->post('status_perkawinan'),
                    'pendidikan'            => $this->post('pendidikan'),
                    'agama'                 => $this->post('agama'),
                    'pekerjaan'             => $this->post('pekerjaan'),
                    'no_nik'                => $this->post('no_nik'),
                    'alamat_pasien'         => $this->post('alamat_pasien'),
                    'no_tlp'                => $this->post('no_tlp'),
                    'nama_ayah'             => $this->post('nama_ayah'),
                    'nama_ibu'              => $this->post('nama_ibu'),
                    'foto'                  => $this->post('foto'),
                    'keterbatasan'          => $this->post('keterbatasan'));

            }
            $data2 = array(
                'no_rm'                 => $no_rm,
                'kd_pasien '            => $kode,
                'tgl_kunjungan '        => $time,
                'keluhan '              => $this->post('keluhan'),
                'status '               => '1');    
                
                $insert = $this->db->insert('tb_pasien', $data);
                $insert2 = $this->db->insert('tb_keluhan', $data2);

    
                $response = [
                    'status' => true,
                    'pesan' => 'Pendaftaran Akun Berhasil',
                ];
        }
        $this->response($response, 200);
    }

    public function bukti_post()
    {
        $id = $this->input->post('no_rm');
        $foto = $this->input->post('foto');

        $data = array(
            'bukti_pembayaran '            => $foto
        );
        
        $bb = $this->db->update('tb_keluhan', $data, array('no_rm' => $id));

        if($bb){
            $this->response([
                'status' => TRUE,
                'message' => 'Berhasil Mengubah Akun!',
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Data tidak dapat ditampilkan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    
}