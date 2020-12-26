<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public $user;
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
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
            'send_to'=>$_POST['send_to'],
            'status' => 0  
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
                $waktu = date('Y-m-d H:i:s');
                $date1=date_create($waktu);
                $date2=date_create($key['time']);
                $diff=date_diff($date1,$date2);
                if($diff->format("%h") >= "1"){
                    $time = date('H:i');
                }elseif($diff->format("%i") == "0"){
                    $time = "Baru Saja";
                }else{
                    $time = $diff->format('%i menit lalu');
                }
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
                                    <small class="pull-right text-muted">'.$time.'</small>
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
                                    <small class="pull-right text-muted"></i> '.$time.'</small>
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
            
    function tampilList($rgs = ""){
        $listpesan = $this->Chat_m->listPesan();

        foreach($listpesan as $list){

            //deklarasi waktu
            $notif = $this->db->query('select count(status) as banyak from chat where (send_by ="'.$this->session->userdata("kd_regist").'" or send_to ="'.$this->session->userdata("kd_regist").'") and (send_by ="'.$list['kd_regist'].'" or send_to ="'.$list['kd_regist'].'") and (status=1)');
            $notip = $notif->row();
            $data = $this->db->query('select message, time from chat where (send_by ="'.$this->session->userdata("kd_regist").'" or send_to ="'.$this->session->userdata("kd_regist").'") and (send_by ="'.$list['kd_regist'].'" or send_to ="'.$list['kd_regist'].'") order by time desc limit 1');
            $res = $data->row();
            $waktu = date('Y-m-d H:i:s');
            $date1=date_create($waktu);
            $date2=date_create($res->time);
            $diff=date_diff($date1,$date2);

            //decision untuk waktu
                if($diff->format("%h") >= "1"){
                    $time = date('H:i');
                }elseif($diff->format("%i") == "0"){
                    $time = "Baru Saja";
                }else{
                    $time = $diff->format('%i menit lalu');
                }
            
            if($list['kd_regist'] == $rgs){
            ?>
            <li class="active bounceInDown">
                <a href="javascript:void(0);" id="set" onclick="setGlobal('<?= $list['kd_regist'] ?>')" class="clearfix">
                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                    <div class="friend-name">	
                        <strong><?= $list['name'] ?></strong>
                    </div>
                    <div class="last-message text-muted"><?= $res->message ?></div>
                        <small class="time text-muted"><?= $time?></small>
                        <small class="chat-alert label label-danger"><?php if($notip->banyak == 0){ echo''; }else{ echo $notip->banyak; } ?></small>
                </a>
            </li>
            <?php
            }else{ ?>

            <li class="bounceInDown">
                <a href="javascript:void(0);" id="set" onclick="setGlobal('<?= $list['kd_regist'] ?>')" class="clearfix">
                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                    <div class="friend-name">	
                        <strong><?= $list['name'] ?></strong>
                    </div>
                    <?php 
                        $data = $this->db->query('select message from chat where (send_by ="'.$this->session->userdata("kd_regist").'" or send_to ="'.$this->session->userdata("kd_regist").'") and (send_by ="'.$list['kd_regist'].'" or send_to ="'.$list['kd_regist'].'") order by time desc limit 1');
                        $res = $data->row();
                    ?>
                    <div class="last-message text-muted"><?= $res->message ?></div>
                        <small class="time text-muted"><?= $time ?></small>
                        <small class="chat-alert label label-danger"><?php if($notip->banyak == 0){ echo''; }else{ echo $notip->banyak; } ?></small>
                </a>
            </li>

            <?php }
            
            $this->session->set_userdata('chatkd', $list['kd_regist']);
        }
    }

        function update_status(){
            $teman = $_POST['dia'];
            $saia = $this->session->userdata("kd_regist");
            $query = $this->db->query('UPDATE chat SET status=1 where (send_by ="'.$saia.'" or send_to ="'.$saia.'") and (send_by ="'.$teman.'" or send_to ="'.$teman.'") order by time asc');
        }

        function notifikasi(){
            $saia = $this->session->userdata("kd_regist");
            
                $query = $this->db->query('select count(chat_id) as banyak from chat where (send_by ="'.$saia.'" or send_to ="'.$saia.'") and status = 0');
                $query1 = $query->row();
                if($query1->banyak > 0){
                    echo '<span class="text-center notif"><div style="margin-top:4px;" class="hai align-middle">'.$query1->banyak.'</div></span>';
                }else{
                    
                }              
                
        }
       
       
    

}