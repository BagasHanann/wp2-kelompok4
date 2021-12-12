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

    public function mhs()
    {
        // membuat title browser menjadi 'Daftar mahasiswa'
        $data['title'] = 'Daftar Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // select * from user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();
        // membuat file yang ada di model dengan nama 'Mahasiswa_model', untuk memanggil 'getAllMahasiswa'
        $data['mhs'] = $this->menuModel->getAllMahasiswa();
        
        // membuat pagination
        $config['total_rows'] = $this->menuModel->pagination();
        $config['per_page'] = 4;

        $this->pagination->initialize($config); 
        // memulai data
        $data['start'] = $this->uri->segment(4);
        // memanggil model untuk membuat pagination
        $data['mhs'] = $this->menuModel->getMhs($config['per_page'], $data['start']);

        // membuat pengkondisian, jika fitur searchingnya di klik akan menampilkan data mahasiswa sesuai keyword
        if ( $this->input->post('keyword') ) {
            $data['mhs'] = $this->menuModel->search();
        }

        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|numeric');

        // membuat pengkondisian jika form_validationnya dijalankan dan nilainya FALSE, maka hasilnya akan menampilkan view mahasiswa
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/mhs', $data);
        $this->load->view('templates/footer');
        }
        // jika hasilnya benar, akan menambahkan data mahasiswa yang dibuat di 'model'
        else {
            // membuat 'tambahDataMhs' yang ada di 'model'
            $this->menuModel->tambahDataMhs();
            // membuat flash data, jika berhasil ditambahkan akan muncul alert
            $this->session->set_flashdata('message', 'Added');
            // diarahkan menuju ke data mahasiswa
            redirect('menu/mhs');
        }
    }

    public function edit($id)
    {
        // membuat title browser menjadi 'Daftar mahasiswa'
        $data['title'] = 'Edit Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // select * from user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();
        // membuat file yang ada di model dengan nama 'Mahasiswa_model' untuk memanggil getMahasiswaById
        $data['mhs'] = $this->menuModel->getMahasiswaById($id);
        // membuat data array yang berisikan nama jurusan 
        $data['jurusan'] = ['Sistem Informasi', 'Teknik Informatika', 'Ilmu Komunikasi', 'Sastra Inggris', 'Manajemen', 'Akuntansi'];

        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|numeric');

        // membuat pengkondisian jika form_validationnya dijalankan dan nilainya FALSE, maka hasilnya akan menampilkan view mahasiswa
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit', $data);
        $this->load->view('templates/footer');
        }
        // jika hasilnya benar, akan menambahkan data mahasiswa yang dibuat di 'model'
        else {
            // membuat 'tambahDataMhs' yang ada di 'model'
            $this->menuModel->editDataMhs();
            // membuat flash data, jika berhasil ditambahkan akan muncul alert
            $this->session->set_flashdata('message', 'Updated');
            // diarahkan menuju ke data mahasiswa
            redirect('menu/mhs');
        }
    }

    // membuat controller detail
    public function detail($id)
    {
        $data['title'] = 'Detail Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // select * from user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['mhs'] = $this->menuModel->getMahasiswaById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/detail', $data);
        $this->load->view('templates/footer');
    }

    // membuat fungsi hapus untuk menu management
    public function hapus($id)
    {
        // membuat 'hapusDataMhs' yang ada di 'model'
        $this->menuModel->hapusMenu($id);
        // membuat flash data, jika berhasil dihapus akan muncul alert
        $this->session->set_flashdata('message','Deleted');
        // diarahkan menuju ke data menu
        redirect('menu');
    }
    
    public function hapusSubMenu($id)
    {
        // membuat 'hapusDataMhs' yang ada di 'model'
        $this->menuModel->hapusMenu($id);
        // membuat flash data, jika berhasil dihapus akan muncul alert
        $this->session->set_flashdata('message','Deleted');
        // diarahkan menuju ke data menu
        redirect('menu/submenu');
    }

    // membuat fungsi hapus yang parameternya berisi id, untuk mengambil data dari url
    public function delete($id)
    {
        // membuat 'hapusDataMhs' yang ada di 'model'
        $this->menuModel->hapusMenu($id);
        // membuat flash data, jika berhasil dihapus akan muncul alert
        $this->session->set_flashdata('message','Deleted');
        // diarahkan menuju ke data mahasiswa
        redirect('menu/mhs');
    }
}