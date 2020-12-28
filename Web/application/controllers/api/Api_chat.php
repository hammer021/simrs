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
        $data = array_merge($pesan, $query);    

        if(!empty($query)){

            if(!empty($pesan)){
                $message = [
                    'status' => true,
                    'data_chat' => $query
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
        $this->db->query('UPDATE chat SET status=1 where chat_id = '.$chat.' order by time asc');
    }
}