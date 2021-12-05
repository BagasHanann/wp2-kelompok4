<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); 
    }
    
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    // membuat fungsi edit profile
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            // membuat pengkondisian jika ada gambar yang di upload
            if ($upload_image) {
                // ketentuan gambarnya apa aja
                $config['allowed_types'] = 'gif|jpg|png';
                // ukuran gambar maksimal 2mb
                $config['max_size']      = '2048';
                // tempat untuk menyimpan gambarnya
                $config['upload_path'] = './assets/img/profile/';
                // menjalankan library uploadnya, seperti yang ada di dokumentasi codeigniter
                $this->load->library('upload', $config);
                // membuat pengkondisian jika sudah ter upload
                if ($this->upload->do_upload('image')) {
                    // mengetahui gambar lama user
                    $old_image = $data['user']['image'];
                    // jika gambar lamanya default
                    if ($old_image != 'default.jpg') {
                        // maka harus dihapus, menggunakan unlink fcpath untuk mencari old imagenya
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    // nama gambar baru diambil dari nama filenya
                    $new_image = $this->upload->data('file_name');
                    // lalu set gambar terbaru
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            // akan mengubah table user yang email dan namanya dibawah
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', 'Updated');
            redirect('user');
        }
}