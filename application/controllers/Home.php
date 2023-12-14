<?php
class Home extends CI_Controller {

    // Landing page
    public function index()
    {
        // Judul halaman
        $data['title'] = 'AInvoice eFishery';
        // Data dari database yang akan dimunculkan pada halaman home
        // Studi kasusnya pada datadivisi sebagai data Job Description
        $data['datadivisi'] = $this->db->get('user_datadivisi')->result_array();

        // Menampilkan halaman landing page pada folder views->home->index.php
        $this->load->view('home/index', $data);
    }

}
