<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'User Login';
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ( $this->form_validation->run() == FALSE) {
             $this->load->view('templates/auth_header', $data);
             $this->load->view('auth/login');
             $this->load->view('templates/auth_footer');
        } else {
             $this->login();
        }
    }

    private function login()
    {
       $email = $this->input->post('email');
       $password = $this->input->post('password');
       $user = $this->db->get_where('user', ['email' => $email ])->row_array();   
       if($user) {
          if ($user['is_active'] == 1) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ]; 
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1){
                    redirect('admin');
                } else {
                redirect('user');
                }
            } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password</div>');
            redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email not been activated</div>');
            redirect('auth');
          }
       } else {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered</div>');
           redirect('auth');
       }
    } 

    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $data['title'] = 'User Registration';
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont matches',
            'min_length' => 'Password to short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if( $this->form_validation->run() == false ) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
           $data = [
               'name' => $this->input->post('name', true),
               'email' => $this->input->post('email', true),
               'image' => 'default.jpg',
               'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
               'role_id' => 2,
               'is_active' => 1,
               'date_created' => time()
           ];
           $this->db->insert('user', $data);
           $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been created</div>');
           redirect('auth');
        }
    }

}