<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public $user;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Chat_m');
        $this->load->helper(array('url', 'form'));
        $this->load->library('user_agent');
        $this->user = $this->db->get_where('tb_registrasi', array('kd_regist' => $this->session->userdata['kd_regist']), 1)->row();
    }
    public function index()
    {
        $teman = $this->db->where('kd_regist !=', $this->user->kd_regist)->get('tb_registrasi');
        $this->load->view('admin/dashboard', array(
            'teman' => $teman
        ));
    }
    public function getChats()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            // Find friend
            $friend = $this->db->get_where('tb_registrasi', array('kd_regist' => $this->input->post('chatWith')), 1)->row();
            // Get Chats
            $chats = $this->db
                ->select('chat.*, tb_registrasi.name')
                ->from('chat')
                ->join('tb_registrasi', 'chat.send_by = tb_registrasi.kd_regist')
                ->where('(send_by = '. $this->user->kd_regist .' AND send_to = '. $friend->kd_regist .')')
                ->or_where('(send_to = '. $this->user->kd_regist .' AND send_by = '. $friend->kd_regist .')')
                ->order_by('chat.time', 'desc')
                ->limit(100)
                ->get()
                ->result();
            $result = array(
                'name' => $friend->name,
                'chats' => $chats
            );
            echo json_encode($result);
        }
    }
    public function sendMessage()
    {
        $this->db->insert('chat', array(
            'message' => htmlentities($this->input->post('message', true)),
            'send_to' => $this->input->post('chatWith'),
            'send_by' => $this->user->kd_regist
        ));
    }

    public function insertpesan(){
        $data = array(
			'send_by'=>$_POST['kode'],
            'message'=>$_POST['pesan'],
            'send_to'=>$_POST['send_to']  
            );
            $this->db->insert('chat',$data);
    }

    public function tampil_pesan($teman = ""){
        $pesan  = $this->Chat_m->getPesan($this->session->userdata("kd_regist"),$teman);
            if($teman == null){
                
                echo 'seilahkan pilih orang terlebih dahulu';
            }elseif($pesan == null){
                echo 'tidak ada pesan';
            }else{
			foreach($pesan as $key) {
                $keluar = $this->Chat_m->pesanKeluar($this->session->userdata("kd_regist"));
                $datang = $this->Chat_m->pesanDatang($this->session->userdata("kd_regist"));

                    $nama = $this->Chat_m->getNama($key['send_by']);

                if($key['send_by'] == $this->session->userdata("kd_regist")){
                

                    echo 
                        '<li class="right clearfix">
                            <span class="chat-img pull-right">
                                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">'
                                    .$nama->name.
                                    '</strong>
                                    <small class="pull-right text-muted"> 13 mins ago</small>
                                </div>
                                <p style="color:black;">
                                    '.$key['message'].'
                                </p>
                            </div>
                        </li>';
                            
                        }elseif($key['send_to'] == $this->session->userdata("kd_regist")){
   
    
                    echo '
                        <li  class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="https://bootdey.com/img/Content/user_3.jpg" alt="User Avatar">
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">'
                                    .$nama->name.
                                    '</strong>
                                    <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                                </div>
                                <p style="color:black;">
                                    '.$key['message'].'
                                </p>
                            </div>
                        </li>';
                    }
                }
            }
        }
            
    function tampilList(){
        $listpesan = $this->Chat_m->listPesan();

        foreach($listpesan as $list){
            
            ?>
            <li class="active bounceInDown">
                <a href="javascript:void(0);" id="set" onclick="setGlobal('<?= $list['kd_regist'] ?>')" class="clearfix">
                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                    <div class="friend-name">	
                        <strong><?= $list['name'] ?></strong>
                    </div>
                    <?php $lastpesan = $this->Chat_m->lastMessage($list['kd_regist']) ?>
                    <div class="last-message text-muted">pesan</div>
                        <small class="time text-muted">Just now</small>
                        <small class="chat-alert label label-danger">1</small>
                </a>
            </li>
            <?php
            
            $this->session->set_userdata('chatkd', $list['kd_regist']);
        }
       
       
    }

}