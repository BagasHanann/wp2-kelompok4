<?php 

function is_logged_in()
{
    // Fungsi dari get_instance() tersebut digunakan untuk mengakses diluar dari Controller, Models, dan Views, dan get_instans() tersebut biasanya digunakan pada helper
    $CI = get_instance();
    // membuat pengkondisian jika tidak login/mencoba masuk langsung ke url maka akan kembali ke halaman auth.
    if (!$CI->session->userdata('email')) {
        redirect('auth');
    } else {
        // membuat variable role_id untuk mengenal siapa yang login, admin atau user.
        $role_id = $CI->session->userdata('role_id');
        // sedang mengakses menu yang mana, diambil dari url urutan pertama
        $menu = $CI->uri->segment(1);
        // meng query dari database table (user_menu) untuk mendapatkan satu baris array
        $queryMenu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
        // lalu diambil id nya
        $menu_id = $queryMenu['id'];
        // meng query user accessnya dari table (user_access_menu) SELECT * FROM WHERE role_id = $role_id menu_id = $menu_id
        $userAccess = $CI->db->get_where('user_access_menu',[
            'role_id' => $role_id, 
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1 ) {        
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    
    // select * from user_access)menu where role_id = role_id
    $ci->db->where('role_id', $role_id);
    // select * from user_access)menu where menu_id = menu_id    
    $ci->db->where('menu_id', $menu_id);
    // mencari dari table user_access_menu  
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}