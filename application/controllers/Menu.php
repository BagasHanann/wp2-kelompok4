<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); 
        $this->load->model('menuModel');
    }
    

    public function index()
    {
        $data['title'] = 'Menu Management';
        // menampilkan data user SELECT * FROM user WHERE email -> session userdata email
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // select * from user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');      
    }

    public function submenu()
    {
        $data['title'] = 'Sub Menu Management';
        // menampilkan data user SELECT * FROM user WHERE email -> session userdata email
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->menuModel->getSubMenu();
        $data['menu'] =  $this->db->get('user_menu')->result_array();
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),  
                'menu_id' => $this->input->post('menu_id'),   
                'url' => $this->input->post('url'),   
                'icon' => $this->input->post('icon'),   
                'is_active' => $this->input->post('is_active')   
            ];
            
            $this->db->insert('user_sub_menu', $data);
            // membuat flash data, jika berhasil ditambahkan akan muncul alert
            $this->session->set_flashdata('message', 'Added');
            // diarahkan menuju ke menu
            redirect('menu/submenu');
        }
    }

    public function editSubmenu($id)
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] =  $this->db->get('user_menu')->result_array();

        $data['user_sub_menu'] = $this->menuModel->getSubMenuById($id);
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editSubmenu', $data);
            $this->load->view('templates/footer');
        } else {
            // membuat 'tambahDataMhs' yang ada di 'model'
            $this->menuModel->editSubMenu();
            // membuat flash data, jika berhasil ditambahkan akan muncul alert
            $this->session->set_flashdata('message', 'Updated');
            // diarahkan menuju ke data mahasiswa
            redirect('menu/submenu');
        }
    }
}