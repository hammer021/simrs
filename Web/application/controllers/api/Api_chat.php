<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api_chat extends REST_Controller
{
    function __construct($config = 'rest') {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Chat_m');
    }
    
    public function index_post(){
        $sini = "";
        $sana = $this->post('no_rm');

        $hari = $this->Chat_m->getHari();
        $query = $this->Chat_m->getDataPasien($sana,$hari);

        $pesan = $this->Chat_m->getPesanApi($sana);    

        if(!empty($query)){
            foreach($query as $q){ $indo_h = $q['hari'] = $this->Chat_m->getHari($q['hari']); }
            if(!empty($pesan)){
                $message = [
                    'status' => true,
                    'data_chat' => $q
                ];
                //$this->db->query('UPDATE chat SET status=1 where (send_by ="'.$sini.'" or send_to ="'.$sini.'") and (send_by ="'.$sana.'" or send_to ="'.$sana.'") order by time asc');
            }else{
                $message = [
                    'status' => false,
                    'pesan' => "Yhaa Error"
                ];
            }
           
        }else{
            $message = [
                'status' => false,
                'pesan' => "Dokter tidak buka/No RM Salah"
            ];
        }
        $this->response($message, 200);
    }

    public function index_put(){
        $chat_id = $this->put('chat_id');
        $no_rm = $this->put('no_rm');
        $update_c = $this->db->query('UPDATE chat SET status=1 where chat_id = '.$chat.' order by time asc');
        $update_k = $this->db->query('UPDATE tb_konsul SET status_kons=0 where no_rm = '.$no_rm.' order by time asc');
        if($update_c && $update_k){
            $message = [
                'status' => true,
                'pesan' => "Berhasil"
            ];
        }else{
            $message = [
                'status' => false,
                'pesan' => "Yha Error!"
            ]
        }
        $this->response($message, 200);
    }
}