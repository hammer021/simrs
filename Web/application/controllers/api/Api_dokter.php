<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_Dokter extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Api_model');
        $this->load->model('Chat_m');
    }

    public function dokter_get(){
        $a = $this->db->select('tb_dokter_poli.senin,tb_dokter_poli.selasa,tb_dokter_poli.rabu,tb_dokter_poli.kamis,tb_dokter_poli.jumat,tb_dokter_poli.sabtu,tb_dokter_poli.minggu,
        tb_dokter_poli.no_praktek,tb_registrasi.name,tb_registrasi.image, tb_poli.klinik')    
                ->from('tb_dokter_poli')
                    ->join('tb_dokter', 'tb_dokter_poli.no_praktek = tb_dokter.no_praktek')
                    ->join('tb_registrasi', 'tb_dokter.kd_regist = tb_registrasi.kd_regist')
                    ->join('tb_poli', 'tb_dokter_poli.kd_poli = tb_poli.kd_poli')
                ->get();

        $query = $a->result_array();

            if ($query) {
                $this->response([
                    'status' => TRUE,
                    'data' => $query
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => TRUE,
                    'data'  => 'Data tidak di temukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    

    public function dokter_post(){
        $l = $this->post('no_praktek');
        $a = $this->db->select('*')    
                ->from('tb_dokter_poli')
                    ->join('tb_dokter', 'tb_dokter_poli.no_praktek = tb_dokter.no_praktek')
                    ->join('tb_registrasi', 'tb_dokter.kd_regist = tb_registrasi.kd_regist')
                    ->group_start()
                        ->where('tb_dokter_poli.no_praktek', $l)
                    ->group_end()
                ->get();

        $query = $a->result_array();

         if ($query) {
                $this->response([
                    'status' => TRUE,
                    'data' => $query
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => TRUE,
                    'data'  => 'Data tidak di temukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }

    }


}

