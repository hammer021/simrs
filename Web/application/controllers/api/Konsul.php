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

    // ---------------------------------------------------------------------------------------------------------------------------------------------------- //

    // Status :
    // Selesai = 0
    // Belum Bayar = 1
    // Sudah Bayar = 2 (Untuk admin)
    // Terverifikasi = 3

    // ---------------------------------------------------------------------------------------------------------------------------------------------------- //

    function index_get()
    {
        $l = $this->get('kd_regist');
        $a = $this->db->select('no_rm, nama_pasien, status, keluhan, tgl_kunjungan, harga, foto')    
                ->from('tb_pasien')
                    ->join('tb_keluhan', 'tb_keluhan.kd_pasien = tb_pasien.kd_pasien')
                    ->group_start()
                        ->where('kd_regist', $l)
                        ->where('status = 1 OR status = 2')
                    ->group_end()
                ->get();
        $query = $a->result_array();

        $output = $this->db->get_where('tb_pasien',  array('kd_regist' => $l))->result_array();
            if(!empty($output)){
            $message = [
                'status' => TRUE,
                'data'   => $query,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => FALSE,
                'message' => "No Rm tidak ditemukan"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function pasienselesai_get()
    {
        $l = $this->get('kd_regist');
        $a = $this->db->select('no_rm, nama_pasien, tgl_kunjungan, tgl_lahir, foto')    
                ->from('tb_pasien')
                    ->join('tb_keluhan', 'tb_keluhan.kd_pasien = tb_pasien.kd_pasien')
                    ->group_start()
                        ->where('kd_regist', $l)
                        ->where('status = 0')
                    ->group_end()
                ->get();
        $query = $a->result_array();

        $output = $this->db->get_where('tb_pasien',  array('kd_regist' => $l))->result_array();
            if(!empty($output)){
            $message = [
                'status' => TRUE,
                'data'   => $query,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => FALSE,
                'message' => "No Rm tidak ditemukan"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function periksa_post()
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

        //foto
        $config2 = uniqid().'.jpeg';
        $path2 = './assets/images/pasien/'.$config2;

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
                'keterbatasan'          => $this->post('keterbatasan'),
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
                'foto'                  => 'default.jpeg',
                'hub_pasien'            => $this->post('hub_pasien'));
            }else{
                $data = array(
                    'kd_pasien '            => $kode,
                    'kd_regist'             => $id_user,
                    'nama_pasien'           => $nama_pasien,
                    'tempat_lahir'          => $this->post('tempat_lahir'),
                    'tgl_lahir'             => $this->post('tgl_lahir'),
                    'umur'                  => $umur,
                    'keterbatasan'          => $this->post('keterbatasan'),
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
                    'foto'                  => $config2,
                    'hub_pasien'            => $this->post('hub_pasien'));
            }
            $data2 = array(
                'no_rm'                 => $no_rm,
                'tgl_kunjungan '        => $time,
                'keluhan '              => $this->post('keluhan'),
                'status '               => '1',
                'harga'                 => '0',     
                'kd_pasien '            => $kode);    
                
                $insert = $this->db->insert('tb_pasien', $data);
                $insert2 = $this->db->insert('tb_keluhan', $data2);
                
                if($insert && $insert2){

                    file_put_contents($path2, base64_decode($foto));
                    $response = [
                        'status' => true,
                        'message' => 'Pendaftaran Akun Berhasil',
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Something Wrong I Can Feel It',
                    ];
                }
        }
        $this->response($response, 200);
    }

    public function riwayatPasien_post()
    {
        $id_user = $this->post('kd_regist');
        $kd_pasien = $this->post('kd_pasien');

        //query cek pasien
        $query = $this->db->select('*')->from('tb_pasien')
            ->group_start()
                ->where('kd_regist', $id_user)
                ->where('kd_pasien', $kd_pasien)
            ->group_end()
        ->get(); 
        $cek = $query->num_rows(); 
        
        //date now
        date_default_timezone_set("Asia/Jakarta");
        $time =  Date('Y-m-d');

        // parsing data uniqkode
        $no_rm = $this->Api_model->kode('no_rm', 'tb_keluhan', 'RM', '2' );

        if($cek > 0){
            $data2 = array(
                'no_rm'                 => $no_rm,
                'tgl_kunjungan '        => $time,
                'keluhan '              => $this->post('keluhan'),
                'status '               => '1',
                'harga'                 => '0',     
                'kd_pasien '            => $kd_pasien
            );    
                $insert = $this->db->insert('tb_keluhan', $data2);
                
                if($insert){

                    $response = [
                        'status' => true,
                        'message' => 'Pendaftaran Pasien Berhasil',
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Something Wrong I Can Feel It',
                    ];
                }
        }else{

            $response = [
                'status' => false,
                'message' => 'Something Wrong I Can Feel It',
            ];
        }
                
        $this->response($response, 200);
    }

    public function bukti_post()
    {
        if ($this->post('no_rm')) {
            $no_rm = $this->input->post('no_rm');

            $detailRiwayat = $this->Api_model->getKeluhan($no_rm);
            if ($detailRiwayat) {
                $this->response([
                    'status' => TRUE,
                    'data' => $detailRiwayat
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No Rekam medis tidak ditemukan'.$no_rm
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'id_surat tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function bukti_put()
    {
        if ($this->put('no_rm'))
        {
            $no_rm = $this->put('no_rm');

            $config = uniqid().'.jpeg';
            $path = './assets/images/bukti_keluhan/'.$config;

            $transaksi = $this->Api_model->getKeluhan($no_rm);

            
            if($transaksi) {
                if($this->put('buktikeluhan')) {
                    $buktikeluhan = $this->put('buktikeluhan');

                    $data = array(
                        'buktikeluhan' => $config,
                        'status' => "2"
                        
                    );
                        if ($this->db->update('tb_keluhan', $data, ['no_rm' => $no_rm])) {
                            file_put_contents($path, base64_decode($buktikeluhan));
                            // jika berhasil
                            $this->set_response([
                                'status' => true,
                                'message' => 'Berhasil Upload Bukti pembayaran, Silahkan tunggu konfirmasi dari Admin untuk tahap selanjutnya.'
                            ], 200);
                        } else {
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal'
                            ], 401);
                        }

                    } else {
                        
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal Upload Bukti Pembayaran'
                            ], 401);
                        
                    }
                    
                } else {
                    // jika data pengguna tidak ada
                    $this->set_response([
                        'status' => false,
                        'message' => 'User could not be found'
                    ], 404);
                }

        } else {
            // jika tidak ada parameter id
            $this->set_response([
                'status' => false,
                'message' => 'Kode RM tidak terinput'
            ], 404);
        }
    }

    function selesai_get()
    {
        $kd_regist = $this->get('kd_regist');
        $a = $this->db->select('tb_konsul.no_rm,tb_pasien.nama_pasien,tb_konsul.kd_konsul,tb_keluhan.tgl_kunjungan,tb_konsul.grand_total,tb_konsul.status_kons
        ')    
                ->from('tb_konsul')
                    ->join('tb_keluhan', 'tb_konsul.no_rm = tb_keluhan.no_rm', 'left' )
                    ->join('tb_pasien', 'tb_keluhan.kd_pasien = tb_pasien.kd_pasien' )
                    ->group_start()
                        ->where('tb_konsul.status_kons = 1')
                        ->where('tb_pasien.kd_regist = "'.$kd_regist.'"')
                    ->group_end()
                ->get();
        $query = $a->result_array();

        $output = $this->db->get_where('tb_pasien',  array('kd_regist' => $kd_regist))->result_array();
        
        if(!empty($output)){
            $message = [
                'status' => TRUE,
                'data'   => $query,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => FALSE,
                'message' => "No Rm tidak ditemukan"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function selesai_put()
    {
        if ($this->put('no_rm'))
        {   
            $no_rm = $this->put('no_rm');
            
            $config = uniqid().'.jpeg';
            $path = './assets/images/bukti_konsul/'.$config;

            $transaksi = $this->Api_model->getKonsul($no_rm);

            
            if($transaksi) {
                if($this->put('buktikonsul')) {
                    $buktikonsul = $this->put('buktikonsul');

                    $data = array(
                        'buktikonsul' => $config,
                        'status_kons' => "2"
                        
                    );
                        if ($this->db->update('tb_konsul', $data, ['no_rm' => $no_rm])) {
                            file_put_contents($path, base64_decode($buktikonsul));
                            // jika berhasil
                            $this->set_response([
                                'status' => true,
                                'message' => 'Berhasil Upload Bukti pembayaran, Silahkan tunggu konfirmasi dari Admin untuk tahap selanjutnya.'
                            ], 200);
                        } else {
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal'
                            ], 401);
                        }

                    } else {
                        
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal Upload Bukti Pembayaran'
                            ], 401);
                        
                    }
                    
                } else {
                    // jika data pengguna tidak ada
                    $this->set_response([
                        'status' => false,
                        'message' => $no_rm
                    ], 404);
                }

        } else {
            // jika tidak ada parameter id
            $this->set_response([
                'status' => false,
                'message' => 'Kode RM tidak terinput'
            ], 404);
        }
    }

    function selesai_post()
    {
        $no_rm = $this->post('no_rm');
        $a = $this->db->select('tb_konsul.no_rm, tb_pasien.nama_pasien,tb_konsul.kd_konsul,tb_keluhan.tgl_kunjungan,tb_konsul.grand_total,tb_konsul.status_kons,tb_konsul.grand_total,tb_resep.resep,tb_resep.kd_resep,tb_konsul.harga_kirim,tb_resep.harga_resep')    
                ->from('tb_konsul')
                    ->join('tb_keluhan', 'tb_konsul.no_rm = tb_keluhan.no_rm', 'left' )
                    ->join('tb_pasien', 'tb_keluhan.kd_pasien = tb_pasien.kd_pasien' )
                    ->join('tb_resep', 'tb_konsul.kd_resep = tb_resep.kd_resep' )
                    ->group_start()
                        ->where('tb_konsul.status_kons = 1')
                        ->where('tb_keluhan.no_rm = "'.$no_rm.'"')
                    ->group_end()
                ->get();
        $query = $a->result_array();

        if(!empty($query)){
            $message = [
                'status' => TRUE,
                'data'   => $query,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => FALSE,
                'message' => "No Rm tidak ditemukan"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function dashboard_get(){
        
        $kd_regist = $this->get('kd_regist');
    
    $query = $this->db->query("SELECT COUNT(tb_pasien.kd_pasien) as jumlah_pasien, (select COUNT(tb_keluhan.no_rm) from tb_keluhan where tb_keluhan.status ='1') as jumlah_periksa_1, (select COUNT(tb_konsul.no_rm) from tb_konsul where tb_konsul.status_kons ='1') as jumlah_obat_1 FROM `tb_pasien` JOIN tb_keluhan ON tb_pasien.kd_pasien = tb_keluhan.kd_pasien join tb_konsul on tb_keluhan.no_rm = tb_konsul.no_rm where tb_pasien.kd_regist = '$kd_regist'")->result_array();    
        if(!empty($query)){
            $message = [
                'status' => TRUE,
                'data'   => $query,
            ];
            $this->response($message, REST_Controller::HTTP_OK);
        }else{
            $message = [
                'status' => FALSE,
                'message' => "No Rm tidak ditemukan"
            ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function riwayat_get(){
        $this->load->model('Konsul_model');
        $kd_regist = $this->get('kd_regist');

        $query = $this->Konsul_model->konsulfilter('',$kd_regist,'');

        if(empty($kd_regist)){
            $message = [
                'status' => false,
                'message' => 'No Rm Kosong' 
            ];
        }elseif(empty($query)){
            $message = [
                'status' => false,
                'message' => 'Riwayat Tidak Ditemukan'
            ];
        }else{
            $message = [
                'status' => true,
                'data' => $query
            ];
        }
        $this->response($message, REST_Controller::HTTP_OK);
    }
    function riwayat_post(){
        $this->load->model('Konsul_model');
        $norm = $this->post('no_rm');

        $query = $this->Konsul_model->konsulfilter('','',$norm);

        if(empty($norm)){
            $message = [
                'status' => false,
                'message' => 'No Rm Kosong' 
            ];
        }elseif(empty($query)){
            $message = [
                'status' => false,
                'message' => 'Riwayat Tidak Ditemukan'
            ];
        }else{
            $message = [
                'status' => true,
                'data' => $query
            ];
        }
        $this->response($message, REST_Controller::HTTP_OK);
    }
}