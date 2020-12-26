<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_chat extends REST_Controller
{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Chat_m');
    }
    public function index_post(){
        $sini = $this->post('kd_regist');
        $sana = $this->post('no_rm');
        $a = $this->db->select('tb_registrasi.kd_regist')    
        ->from('tb_registrasi')
            ->join('tb_pasien', 'tb_registrasi.kd_regist = tb_pasien.kd_regist')
            ->join('tb_keluhan','tb_pasien.kd_pasien=tb_keluhan.kd_pasien')
                ->where('tb_keluhan.no_rm ="'.$sana.'"')
        ->get();
        $query = $a->row();

        $pesan = $this->Chat_m->getPesan($sini,$query->kd_regist);

        if(!empty($pesan)){
            $message = [
                'status' => true,
                'data' => $pesan
            ];
            $this->db->query('UPDATE chat SET status=1 where (send_by ="'.$sini.'" or send_to ="'.$sini.'") and (send_by ="'.$query->kd_regist.'" or send_to ="'.$query->kd_regist.'") order by time asc');
        }else{
            $message = [
                'status' => false,
                'pesan' => "Whoheoeho"
            ];
        }
        $this->response($message, 200);
    }
}