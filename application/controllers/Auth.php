<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $data['title'] = 'User Login';
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
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
                    }
                } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password</div>');
                redirect('auth');
                }
            }
        }
    }
}
