<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('user');
        // }
        $this->form_validation->set_rules('username', 'Email or Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $pw = md5($this->input->post('password'));
        // model
        $this->load->model('User_model', 'user');
        $user = $this->user->userCheckLogin($username);
     
        if (!empty($user)) {
            if ($user['is_active'] == 1) {
                $password = $user['password'];
                if ($password == $pw) {
                    $data = [
                        'kd_regist'=> $user['kd_regist'],
                        'email' => $user['email'],
                        'name' => $user['name'],
                        'image' => $user['image'],
                        'kd_role' => $user['kd_role']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['kd_role'] == 1) {
                        redirect('Admin/dashboard');
                    } 
                    else if ($user['kd_role'] == 2) {
                        redirect('Dokter/dashboard');
                    }
                    else {
                        redirect('dokter');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                    redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out! </div>');
        redirect('Auth');
    }





    // public function resetpass()
    // {
    //     $email = $this->input->get('email');
    //     $token = $this->input->get('token');

    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     if ($user) {
    //         $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
    //         if ($user_token) {
    //             $this->session->set_userdata('reset_email', $email);
    //             $this->changePassword();
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password failed! Invalid token </div>');
    //             redirect('auth/forgotpass');
    //         }
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password failed! Wrong email </div>');
    //         redirect('auth');
    //     }
    // }

    // public function changePassword()
    // {
    //     if (!$this->session->userdata('reset-email')) {
    //         redirect('auth');
    //     }

    //     $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]');
    //     $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[5]|matches[password1]');
    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Change Password';
    //         $this->load->view('templates/auth_header', $data);
    //         $this->load->view('auth/change-pass');
    //         $this->load->view('templates/auth_footer');
    //     } else {
    //         $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
    //         $email = $this->session->userdata('reset_email');
    //         $this->db->set('password', $password);
    //         $this->db->where('email', $email);
    //         $this->db->update('user');

    //         $this->session->unset_userdata('reset_email');
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login. </div>');
    //         redirect('auth');
    //     }
    // }
}
