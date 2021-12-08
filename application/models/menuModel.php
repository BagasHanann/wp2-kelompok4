<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menuModel extends CI_Model {
    
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }
    
    public function hapusMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->db->delete('user_sub_menu', ['id' => $id]);      
        $this->db->delete('mhs', ['id' => $id]);
    }

        // memanggil fungsi yang ada di controller
    public function getAllMahasiswa()
    {
        // untuk memanggil database table mahasiswa di index.php (mahasiswa)
        return $this->db->get('mhs')->result_array();
    }

    //  untuk memanggil controller tambah data mahasiswa
    public function tambahDataMhs()
    {
        // variable data disini berfungsi dan berisi field database, dan fungsi true jikalau ada karakter aneh langsung dibersihkan
        $data = [
            "nim" => $this->input->post('nim', true),
            "nama" => $this->input->post('nama', true),
            "jurusan" => $this->input->post('jurusan'),
            "alamat" => $this->input->post('alamat', true),
            "no_telp" => $this->input->post('no_telp', true)
        ];

        // insert disini untuk menambahkan ke table mahasiswa yang diinput di variable data 
        $this->db->insert('mhs', $data);
    }

    public function editSubMenu()
    {
        $data = [
            "title" => $this->input->post('title', true),   
            "url" => $this->input->post('url', true),   
            "icon" => $this->input->post('icon', true),   
        ];

       // insert disini untuk menambahkan ke table mahasiswa yang diinput di variable data 
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    // ini mengambil id di url untuk mengedit 
    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function getMahasiswaById($id)
    {
        return $this->db->get_where('mhs', ['id' => $id])->row_array();
    }

    public function editDataMhs()
    {
        // variable data disini berfungsi dan berisi field database, dan fungsi true jikalau ada karakter aneh langsung dibersihkan
        $data = [
            "nim" => $this->input->post('nim', true),
            "nama" => $this->input->post('nama', true),
            "jurusan" => $this->input->post('jurusan'),
            "alamat" => $this->input->post('alamat', true),
            "no_telp" => $this->input->post('no_telp', true)
        ];

        // insert disini untuk menambahkan ke table mahasiswa yang diinput di variable data 
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('mhs', $data);
    }

    // membuat fungsi cari, yang berdasarkan keyword nama, nim, maupun jurusan 
    public function search()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('nama', $keyword);
        $this->db->or_like('nim', $keyword);
        $this->db->or_like('jurusan', $keyword);
        return $this->db->get('mhs')->result_array();
    }

    // membuat fungsi untuk pagination, limitnya berapa, dan datanya mulai dari mana..
    public function getMhs($limit, $start)
    {
        return $this->db->get('mhs', $limit, $start)->result_array();
    }

    public function pagination()
    {   
        // select * from table mhs
        return $this->db->get('mhs')->num_rows();
    }
}
