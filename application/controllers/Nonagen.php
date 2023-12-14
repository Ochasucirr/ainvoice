<?php
class Nonagen extends CI_Controller {

    public function index()
    {
        // Judul Halaman
        $data['title'] = 'Non Agen eFishery';
        // Masuk dengan hak akses procurement staff
        $data['user'] = $this->db->get_where('user', ['name' =>$this->session->userdata('name')])->row_array();

        $data['datanonagen'] = $this->db->get('import_datapenjualantmp')->result_array();
        // Menampilkan halaman non agen di views->templates->header, sidebar, topbar dan footer
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        // Menampilkan halaman Isi non-agen di views->user->index.php
        $this->load->view('nonagen/index', $data);
        $this->load->view('templates/admin_footer');
    }

// Cetak non agen
	public function cetaknonagen()
	{
		$this->load->model('cetak_model');
		$data['import_datapenjualantmp'] = $this->cetak_model->getData();

		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan_nonagenefishery.pdf";
		$this->pdf->load_view('cetaknonagen', $data);
	}
}

