<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function index()
    {
        // Judul halaman
        $data['title'] = 'Menu Management';
        // Masuk dengan hak akses role admin sistem
        $data['user'] = $this->db->get_where('user', ['name' =>$this->session->userdata('name')])->row_array();
        // Menambahkan menu
        $data['menu'] = $this->db->get('user_menu')->result_array();
        // Validasi dihalaman menu
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        // Jika validasi gagal maka akan mengembalikan ke halaman
        if($this->form_validation->run() == false) {
            // Menampilkan halaman menu di views->templates->header, sidebar, topbar dan footer
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            // Menampilkan halaman Isi halaman menu di views->menu->index.php
            $this->load->view('menu/index', $data);
            $this->load->view('templates/admin_footer');
        } else {
            // Tapi apabila validasi berhasil maka akan melakukan tindakan berikut:
            // Masukkan data ke tabel database
            $this->db->insert('user_menu', ['menu' => $this->input->post(('menu'))]);
            // Menampilkan pesan di halaman menu
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu telah ditambahkan</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        // Judul Halaman
        $data['title'] = 'Submenu Management';
        // Masuk dengan hak akses role admin sistem
        $data['user'] = $this->db->get_where('user', ['name' =>$this->session->userdata('name')])->row_array(); 
        // Jalankan model_menu untuk submenu
        $this->load->model('Menu_model', 'menu');
         // Menambahkan submenu
        $data['subMenu'] = $this->menu->getSubMenu();
        // Masukkan data juga ke tabel menu
        $data['menu'] = $this->db->get('user_menu')->result_array();
        // Validasi dihalaman submenu
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        // Jika validasi gagal maka akan mengembalikan ke halaman
        if ($this->form_validation->run() == false) {
            // Menampilkan halaman menu di views->templates->header, sidebar, topbar dan footer
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            // Menampilkan halaman Isi halaman menu di views->menu->submenu.php
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/admin_footer');
        } else {
            // Tapi apabila berhasil maka isikan data berikut
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            // Dan masukkan data tersebut ke tabel database
            $this->db->insert('user_sub_menu', $data);
            // Menampilkan pesan dihalaman submenu
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu telah ditambahkan</div>');
            redirect('menu/submenu');
        }      
    }

}
?>