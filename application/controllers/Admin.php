<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

// Halaman Dashboard
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();
    
        $this->load->view('templates/dashboard_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/dashboard_footer');
    }

// Halaman Tambah Role
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();
    
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role','Role','required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/role_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/role_footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role telah ditambahkan!</div>');
            redirect('admin/role');
        }
    }

// Halaman Edit Role
    public function edit_user($id)
    {
        $user2 = "SELECT * FROM user_role
        WHERE id = $id ";
        $data['role'] = $this->db->query($user2)->row_array();
        $data['title'] = 'edit_user';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
        if ($data) {
            $data1 = ['role' => $this->input->post('role', true)];
            $this->db->where('id', $id);
            $this->db->update('user_role', $data1);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nama Role berhasil diubah!</div>');
            redirect('admin/role');
        } else {
            redirect('admin/role');
        }
    }


// Halaman Akses Role
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();
    
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/access_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/access_footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">Access Changed!</div>');
    }

// Halaman Tambah Data Divisi 
    public function datadivisi()
    {
        $data['title'] = 'Data Divisi';
        $data['user'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();
        
        $data['datadivisi'] = $this->db->get('user_datadivisi')->result_array();

        $this->form_validation->set_rules('judul_jobdesc', 'Judul Jobdesc', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if($this->form_validation->run() == false) {
            $this->load->view('templates/divisi_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/datadivisi', $data);
            $this->load->view('templates/divisi_footer');
        } else {
            $config['upload_path']          = './assets/img/admin/';
            $config['allowed_types']        = 'jpeg|jpg|png';

            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');

            $data = [
                'judul_jobdesc' => $this->input->post('judul_jobdesc'),
                'gambar' => $this->upload->data('file_name'),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            $this->db->insert('user_datadivisi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Divisi berhasil ditambahkan!</div>');
            redirect('admin/datadivisi');
        }
    }

// Halaman Edit Data Divisi
    public function edit_dd($id)
        {
            $user5 = "SELECT * FROM user_datadivisi
            WHERE id = $id ";
            $data['datadivisi'] = $this->db->query($user5)->row_array();
            $data['title'] = 'edit_dd';
            $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
            if ($data) {
                $config['upload_path']          = './assets/img/admin/';
                $config['allowed_types']        = 'jpeg|jpg|png';

                $this->load->library('upload', $config);
                $this->upload->do_upload('gambar');

                $gambar = $this->upload->data('file_name');
                $gambar = $gambar == NULL || $gambar == '' ? $data['datadivisi']['gambar'] : $gambar;
                $data1 = [
                    'judul_jobdesc' => $this->input->post('judul_jobdesc', true),
                    'gambar' => $gambar,
                    'deskripsi' => $this->input->post('deskripsi', true)
                ];

                $this->db->where('id', $id);
                $this->db->update('user_datadivisi', $data1);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Divisi berhasil diubah!</div>');
                redirect('admin/datadivisi');
            } else {
                redirect('admin/datadivisi');
        }
    }

// Halaman Hapus Data Divisi
    public function hapus_dd($id)
    {
        $user4 = "SELECT * FROM user_datadivisi
        WHERE id = $id ";
        $data['datadivisi'] = $this->db->query($user4)->row_array();
        $data['title'] = 'hapus_dd';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
        
        if ($data) {
            $this->db->where('id', $id);
            $this->db->delete('user_datadivisi');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Divisi berhasil dihapus!</div>');
            redirect('admin/datadivisi');
        } else {
            redirect('admin/datadivisi');
        }
    }

// Halaman Tambah Data Pengguna
    public function datapengguna()
    {
        $data['title'] = 'Data Pengguna';
        $data['user'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();

        $data['datapengguna'] = $this->db->get('user')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/pengguna_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/datapengguna', $data);
            $this->load->view('templates/pengguna_footer');
        } else {
            $config['upload_path']          = './assets/img/profile/';
            $config['allowed_types']        = 'jpeg|jpg|png';

            $this->load->library('upload', $config);
            $this->upload->do_upload('image');

            $data = [
                'name' => htmlspecialchars($this->input->post('name')),
                'image' => $this->upload->data('file_name'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => htmlspecialchars($this->input->post('role')),
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengguna berhasil ditambahkan!</div>');
            redirect('admin/datapengguna');
        }
    }

// Halaman Edit Data Pengguna
    public function edit_dp($id)
    {
        $name = $this->input->post('name', true);
        $user6 = "SELECT * FROM user WHERE id = $id ";
        $user99 = "SELECT * FROM user WHERE id <> $id AND name = '$name'";
        $data['datapengguna'] = $this->db->query($user6)->row_array();
        $data['datapengguna2'] = $this->db->query($user99)->num_rows();
        $data['title'] = 'edit_dp';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        // Validasi Password ketika isinya 0
        // $this->form_validation->set_rules('name', 'Name', 'required|trim');
        if ($data['datapengguna2'] <> 0) {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
        }
        $password = $this->input->post('password');
        if ($password != '' || $password != NULL) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[3]');
        }


        //end validasi
        if ($this->form_validation->run() == TRUE and $data['datapengguna2'] == 0) {
            $config['upload_path']          = './assets/img/profile/';
            $config['allowed_types']        = 'jpeg|jpg|png';

            $this->load->library('upload', $config);
            $this->upload->do_upload('image');
            $image = $this->upload->data('file_name');
            $password = $password == NULL || $password == '' ? $data['datapengguna']['password'] : password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $image = $image == NULL || $image == '' ? $data['datapengguna']['image'] : $image;
            $data1 = [
                'name' => $this->input->post('name', true),
                'image' => $image,
                'password' => $password,
                'role_id' => $this->input->post('role', true)
            ];
            $this->db->where('id', $id);
            $this->db->update('user', $data1);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengguna berhasil diubah!</div>');
            redirect('admin/datapengguna');
        } else {
            redirect('admin/datapengguna');
        }
    }

// Halaman Hapus Data Pengguna
   public function hapus_dp($id)
   {
       $data = $this->db->get_where('user', ['id' => $id])->row_array();
       $image = $data['image'];

       unlink(FCPATH . 'assets/img/profile/' . $image);
       $this->db->where('id', $id);
       $this->db->delete('user');

       $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Pengguna berhasil dihapus!</div>');
       redirect('admin/datapengguna');
   }

}
