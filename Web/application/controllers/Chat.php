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

}