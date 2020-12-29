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
            $b[] = $q;
            if(!empty($pesan)){
                $message = [
                    'status' => true,
                    'data_chat' => $b
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
        $update_c = $this->db->query('UPDATE chat SET status=1 where chat_id = "'.$chat_id.'" order by time asc');
        $update_k = $this->db->query('UPDATE tb_keluhan SET status=0 where no_rm = "'.$no_rm.'"');
        if($update_c && $update_k){
            $message = [
                'status' => true,
                'pesan' => "Berhasil"
            ];
        }else{
            $message = [
                'status' => false,
                'pesan' => "Yha Error!"
            ];
        }
        $this->response($message, 200);
    }
}
