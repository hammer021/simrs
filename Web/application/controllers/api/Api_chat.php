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
        $query = $this->Chat_m->getDataPasien($sana);

        $pesan = $this->Chat_m->getPesan($sana,$sini);
        $data = array_merge($pesan, $query);    

        if(!empty($pesan)){
            $message = [
                'status' => true,
                'data_chat' => $data
            ];
            $this->db->query('UPDATE chat SET status=1 where (send_by ="'.$sini.'" or send_to ="'.$sini.'") and (send_by ="'.$sana.'" or send_to ="'.$sana.'") order by time asc');
        }else{
            $message = [
                'status' => false,
                'pesan' => "Whoheoeho"
            ];
        }
        $this->response($message, 200);
    }
}