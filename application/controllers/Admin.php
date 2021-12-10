<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); 
        $this->load->model('model_admin');
    }
    
    public function index()
    { 
        $data['title'] = 'Dashboard';
        // menampilkan data user SELECT * FROM user WHERE email -> session userdata email
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['total'] = $this->model_admin->hitungJumlahMhs();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}