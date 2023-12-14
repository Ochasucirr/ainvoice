<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once './vendor/autoload.php'; // Memuat autoload.php dari PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
    }

    // Halaman Monitor Performance
    public function index()
    {
        // Judul Halaman
        $data['title'] = 'Monitor Performance';

        $data['num_agen'] = $this->db->get_where('user_dataagen')->num_rows();
        $data['num_noagen'] = $this->db->get_where('import_datapenjualantmp')->num_rows();
        $data['num_agenko'] = $this->db->get_where('import_dataagentmp')->num_rows();
        $data['num_invoice'] = $this->db->get_where('headerpenjualan')->num_rows();
        // $data['num_staff'] = $this->db->get_where('user', ['role_id' => 2])->num_rows();

        // Masuk dengan hak akses procurement manager
        $data['user'] = $this->db->get_where('user', ['name' =>$this->session->userdata('name')])->row_array();
        // Menampilkan halaman Monitor Performance di views->templates->header, sidebar, topbar dan footer
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        // Menampilkan halaman Isi Monitor Performance di views->user->index.php
        $this->load->view('user/index', $data);
        $this->load->view('templates/admin_footer');
    }


    // Halaman Tambah Data Agen Baru
    public function dataagenbaru()
    {
        $data['title'] = 'Data Agen Baru';
        $data['user'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();

        $data['dataagenbaru'] = $this->db->get('user_dataagen')->result_array();

        $this->form_validation->set_rules('nama_agen', 'Nama Agen', 'required');
        $this->form_validation->set_rules('no_telephone', 'No Telephone', 'required');
        $this->form_validation->set_rules('alamat_agen', 'Alamat Agen', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/agen_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/dataagenbaru', $data);
            $this->load->view('templates/agen_footer');
        } else {

            $data = [
                'nama_agen' => $this->input->post('nama_agen'),
                'no_telephone' => $this->input->post('no_telephone'),
                'alamat_agen' => $this->input->post('alamat_agen')
            ];

            $this->db->insert('user_dataagen', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Agen Baru berhasil ditambahkan!</div>');
            redirect('user/dataagenbaru');
        }
    }

    // Halaman Edit Data Agen Baru
    public function edit_dab($id)
    {
        $user5 = "SELECT * FROM user_dataagen
            WHERE id = $id ";
        $data['dataagenbaru'] = $this->db->query($user5)->row_array();
        $data['title'] = 'edit_dab';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
        if ($data) {

            $data1 = [
                'nama_agen' => $this->input->post('nama_agen', true),
                'no_telephone' => $this->input->post('no_telephone', true),
                'alamat_agen' => $this->input->post('alamat_agen', true)
            ];

            $this->db->where('id', $id);
            $this->db->update('user_dataagen', $data1);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Agen Baru berhasil diubah!</div>');
            redirect('user/dataagenbaru');
        } else {
            redirect('user/dataagenbaru');
        }
    }

    // Halaman Hapus Data Agen Baru
    public function hapus_dab($id)
    {
        $user4 = "SELECT * FROM user_dataagen
        WHERE id = $id ";
        $data['dataagenbaru'] = $this->db->query($user4)->row_array();
        $data['title'] = 'hapus_dab';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        if ($data) {
            $this->db->where('id', $id);
            $this->db->delete('user_dataagen');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Agen Baru berhasil dihapus!</div>');
            redirect('user/dataagenbaru');
        } else {
            redirect('user/dataagenbaru');
        }
    }
    //Import Data Agen Baru
    public function importdataagen()
    {
        // Konfigurasi upload file Excel
        $config['upload_path'] = './assets/file/importexcel/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            // Jika upload gagal, tampilkan pesan error
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak ada file terimport!</div>');
            redirect('user/dataagenbaru');
        } else {
            // Jika upload berhasil, baca file Excel
            $fileInfo = $this->upload->data();
            $inputFileName = './assets/file/importexcel/' . $fileInfo['file_name'];
            $spreadsheet = IOFactory::load($inputFileName);


            // Ambil data dari sheet pertama
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            $incrementNumber = 0; // Inisialisasi nomor increment
            $previousnomorinvoice = null;
            // Deklarasikan variabel penampung untuk nomor invoice sebelumnya
            $incrementNumber = 1; // Inisialisasi nomor increment
            $totalhargapenjualan = 0;
            $maximum = null;
            $existingData = array();
            $dataCounts = array();
            $processedInvoice = [];
            $maxCounts = [];
            foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                for ($row = 2; $row <= $highestRow; $row++) {

                    $worksheet = $spreadsheet->setActiveSheetIndex(0);
                    $tanggalgabung = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $namaagen = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $notelepon = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();


                    // Create a mapping of Indonesian month names to their numeric representation
                    $month_names = [
                        'Januari'   => '01',
                        'Februari'  => '02',
                        'Maret'     => '03',
                        'April'     => '04',
                        'Mei'       => '05',
                        'Juni'      => '06',
                        'Juli'      => '07',
                        'Agustus'   => '08',
                        'September' => '09',
                        'Oktober'   => '10',
                        'November'  => '11',
                        'Desember'  => '12',
                    ];

                    // Convert Indonesia date to database date format
                    $indonesia_date_parts = explode(' ', $tanggalgabung);
                    $day = str_pad($indonesia_date_parts[0], 2, '0', STR_PAD_LEFT);
                    $month = $month_names[$indonesia_date_parts[1]];
                    $year = $indonesia_date_parts[2];

                    $database_date = "$year-$month-$day";


                    if (empty($tanggalgabung) or empty($namaagen) or empty($notelepon) or empty($alamat)) {
                        $data = array(
                            'nama_agen'        => $namaagen,
                            'no_telephone'     => 0 + $notelepon,
                            'alamat_agen'      => $alamat,
                            'tanggalgabung'    => $database_date,
                            'tanggalimport'    => $this->input->post('tanggaltransaksi'),
                            'status_temporary' => 1,
                        );

                        $this->m->Save($data, 'import_dataagentmp');
                    } else {
                        $existingData = $this->db->get_where('user_dataagen', array('nama_agen' => $namaagen))->row();

                        if (!$existingData) {
                            // Data doesn't exist, perform insert
                            $data = array(
                                'nama_agen'        => $namaagen,
                                'no_telephone'     => 0 + $notelepon,
                                'alamat_agen'      => $alamat,
                                'tanggalgabung'    => $database_date,
                                'tanggalimport'    => $this->input->post('tanggaltransaksi'),
                            );

                            $this->m->Save($data, 'user_dataagen');
                        } else {
                            // Data already exists, perform update
                            $table = 'user_dataagen';
                            $where = array(
                                'nama_agen'  => $namaagen
                            );
                            $data = array(
                                'nama_agen'        => $namaagen,
                                'no_telephone'     => $notelepon,
                                'alamat_agen'      => $alamat,
                                'tanggalgabung'    => $database_date,
                                'tanggalimport'    => $this->input->post('tanggaltransaksi'),
                            );
                            $this->m->Update($where, $data, $table);
                        }
                    }
                }
            }
        }
        redirect('validasidataagen');
    }
    function validasidataagen()
    {

        // $this->db->select('*');
        // $this->db->from('salesstore');
        // $this->db->where('store_id', $store);
        // $getsalesstore = $this->db->get();

        $data['title'] = 'Form Pengisian Data Agen';
        $data['user'] = $this->db->get_where('user', ['name' =>
        $this->session->userdata('name')])->row_array();

        $select = $this->db->select('*');
        $select = $this->db->where('import_dataagentmp.status_temporary', 1);
        $data['read'] = $this->m->Get_All('import_dataagentmp', $select);


        $this->load->view('templates/validasi_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/validasiagen', $data);
        $this->load->view('templates/validasi_footer');
    }
    function updateimportagen()
    {
        if (isset($_POST['tblagen'])) {
            $tableagen = json_decode($_POST['tblagen'], true);
            // $i = count($tabledetaildiamond);
            foreach ($tableagen as $row) {
                $idimport = $row['idimport'];
                $tanggalgabung = $row['tanggalgabung'];
                $tanggalimport = $row['tanggalimport'];
                $namaagen = $row['namaagen'];
                $notelepon = $row['notelephone'];
                $alamatagen = $row['alamatagen'];

                $existingData = $this->db->get_where('user_dataagen', array('nama_agen' => $namaagen))->row();
                // Filter non save
                // if (empty($namaagen) or empty($notelepon) or empty($alamatagen) or empty($tanggalgabung)) {
                //     # code...
                // } else {  
                // }

                if (!$existingData) {
                    // Data doesn't exist, perform insert
                    $data = array(
                        'nama_agen'        => $namaagen,
                        'no_telephone'     => 0 + $notelepon,
                        'alamat_agen'      => $alamatagen,
                        'tanggalgabung'    => $tanggalgabung,
                        'tanggalimport'    => $tanggalimport,
                    );

                    $this->m->Save($data, 'user_dataagen');
                } else {
                    $table = 'user_dataagen';
                    $where = array(
                        'nama_agen'  => $namaagen
                    );
                    $data = array(
                        'nama_agen'        => $namaagen,
                        'no_telephone'     => $notelepon,
                        'alamat_agen'      => $alamatagen,
                        'tanggalgabung'    => $tanggalgabung,
                        'tanggalimport'    => $tanggalimport,
                    );
                    $this->m->Update($where, $data, $table);
                }
                $table = 'import_dataagentmp';
                $where = array(
                    'id_import'          =>   $idimport,
                );
                $data = array(
                    'status_temporary' => 0,
                );

                $this->m->Update($where, $data, $table);



                if ($this->db->affected_rows() < 0) {
                    die("Terjadi kesalahan saat menyimpan data.");
                }
            }
        }
        // redirect('listdataimport');
    }
}
