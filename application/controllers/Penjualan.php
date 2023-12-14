<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once './vendor/autoload.php'; // Memuat autoload.php dari PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;


class Penjualan extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Models', 'm');
   }

   function listpenjualan()
   {

      $data['title'] = 'Data Invoice';
      $data['user'] = $this->db->get_where('user', ['name' =>
      $this->session->userdata('name')])->row_array();

      $select = $this->db->select('*,  user_dataagen.nama_agen');
      $select = $this->db->join('user_dataagen', 'user_dataagen.id = headerpenjualan.id_agen', 'left');
      $select = $this->db->order_by('headerpenjualan.id_headerpenjualan', 'DESC');
      // $select = $this->db->join('detailpenjualan', 'detailpenjualan.id_headerpenjualan = headerpenjualan.id_headerpenjualan', 'left');
      // $select = $this->db->where('headerpenjualan.create_by', $this->session->userdata('id_user'));
      $select = $this->db->where('headerpenjualan.deleted', 0);
      $data['read'] = $this->m->Get_All('headerpenjualan', $select);


      //$data['delete'] = $this->m->Delete_Relasi(); 

      $this->load->view('templates/penjualan_header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('penjualan/listpenjualan', $data);
      $this->load->view('templates/penjualan_footer');
   }
   function filterpenjualan()
   {
      $from              = $this->input->post("from");
      $to                = $this->input->post("to");

      $data['user'] = $this->db->get_where('user', ['name' =>
      $this->session->userdata('name')])->row_array();

      $data['title'] = 'Data Invoice';

      if (!empty($from) and !empty($to)) {
         $this->db->where('tanggalpenjualan BETWEEN "' . $from . '" and "' . $to . '"');
      }

      $select =  $this->db->select('*,  user_dataagen.nama_agen');
      $select =  $this->db->join('user_dataagen', 'user_dataagen.id = headerpenjualan.id_agen', 'left');
      $select = $this->db->order_by('headerpenjualan.id_headerpenjualan', 'DESC');
      $select = $this->db->where('headerpenjualan.deleted', 0);
      $data['read'] = $this->m->Get_All('headerpenjualan', $select);

      $this->load->view('penjualan/filterpenjualan', $data);
   }
   function Createpenjualan()
   {

      $this->form_validation->set_rules(
         'tanggaltransaksi',
         'tanggaltransaksi',
         'required|trim',
         [
            'required' => 'Field tanggal transaksi tidak boleh kosong'
         ]
      );
      // $this->form_validation->set_rules(
      // 	'faktursupplier',
      // 	'faktursupplier',
      // 	'required|trim',
      // 	[
      // 		'required' => 'Field faktur supplier tidak boleh kosong'
      // 	]
      // );
      // $this->form_validation->set_rules(
      // 	'nomorpo',
      // 	'nomorpo',
      // 	'required|trim',
      // 	[
      // 		'required' => 'Field nomor po tidak boleh kosong'
      // 	]
      // );


      if ($this->form_validation->run() == false) {
         $role_id = $this->session->userdata('role_id');
         $nama = $this->session->userdata('nama');

         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d H:i:s');

         $data['user'] = $this->db->get_where('user', ['name' =>
         $this->session->userdata('name')])->row_array();

         $data['title'] = 'Tambah Data Invoice';

         $select = $this->db->select('*');
         $select = $this->db->order_by('nama_agen');
         $data['agen'] = $this->m->Get_All('user_dataagen', $select);

         // $select = $this->db->select('*');
         // $select = $this->db->join('mastercodetype', 'mastercodetype.id = masterid.mastercode');
         // $select = $this->db->where('masterid.mastercode', 10);
         // $select = $this->db->where('deleted', 0);
         // $data['lokasi'] = $this->m->Get_All('masterid', $select);

         // $select = $this->db->select('*');
         // $select = $this->db->order_by('kodematauang');
         // $select = $this->db->where('deleted', 0);
         // $data['matauang'] = $this->m->Get_All('matauang', $select);

         $data['id_headerpenjualan']        = $this->m->id_headerpenjualan();

         $data['nomorinvoice']              = $this->m->nomorinvoice();

         $this->load->view('templates/penjualan_header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('templates/topbar', $data);
         $this->load->view('penjualan/createpenjualan', $data);
         $this->load->view('templates/penjualan_footer');
      } else {
         if ($this->input->post('jumlahpenjualan') == "0") {
            $this->session->set_flashdata('warning', 'Total tidak boleh 0');
            redirect('tambahdatapenjualan');
         } else {
            $this->db->select_max('headerpenjualan.id_headerpenjualan');
            $this->db->order_by('id_headerpenjualan', 'desc');

            $this->db->limit(1);
            $query = $this->db->get('headerpenjualan');
            if ($query->num_rows() <> 0) {
               $data = $query->row();
               $kode = intval($data->id_headerpenjualan) + 1;
            } else {
               $kode = 1;
            }
            $batas = str_pad($kode, "0", STR_PAD_LEFT);
            $id_headerpenjualan = $batas;

            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');

            $data = array(
               'nomorpenjualan'       =>   $this->input->post('nomor'),
               'id_headerpenjualan'   =>   $id_headerpenjualan,
               'tanggalpenjualan'     =>   $this->input->post('tanggaltransaksi'),
               'memo'                 =>   $this->input->post('memo'),
               // 'jenispenjualan'       =>   $this->input->post('tipepenjualan'),
               //'faktursupplier'       =>   $this->input->post('faktursupplier'),
               'nomorpo'              =>   $this->input->post('nomorpo'),
               // 'lawantransaksi'       =>   $this->input->post('idlawantransaksi'),
               'termsofpayment'       =>   $this->input->post('termsofpayment'),
               'id_agen'              =>   $this->input->post('idagen'),
               // 'rate'                 =>   $this->input->post('rate'),
               'hargatermasukppn'     =>   0,
               'jumlahpenjualan'      =>   str_replace('.', '', $this->input->post('grandtotal')),
               'discountpersen'       =>   $this->input->post('diskonpersenheader'),
               'discountnilai'        =>   str_replace('.', '', $this->input->post('diskonnilaiheader')),
               'deleted'             =>   0,
               // 'create_by'            =>   $this->session->userdata('id_user'),
               'create_date'          =>   $now,

            );
            $this->m->Save($data, 'headerpenjualan');


            $table = 'detailpenjualan';
            $where = array(
               'id_headerpenjualan'   =>   0,
               'deleted'              =>   0,
               'status_tmp'           =>   1,
               'id_user'              =>   $this->session->userdata('id_user'),
            );
            $data = array(
               'id_headerpenjualan'              =>   $id_headerpenjualan,
               'status_tmp'                      =>   0,
            );
            $this->m->Update($where, $data, $table);


            $this->session->set_flashdata('success', 'Data Invoice Berhasil Ditambah');
            redirect('penjualan/listpenjualan');
         }
      }
   }
   function get_agen()
   {
      $postData = $this->input->post();
      // get data
      $data = $this->m->getAgen($postData);

      echo json_encode($data);
   }
   function getdetailsale()
   {
      $select = $this->db->select('*');
      $select = $this->db->where('detailpenjualan.id_user', $this->session->userdata('id_user'));
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', 0);
      $select = $this->db->where('detailpenjualan.status_tmp', 1);
      $select = $this->db->where('detailpenjualan.deleted', 0);
      $data   = $this->m->Get_All('detailpenjualan', $select);
      echo json_encode($data);
   }

   function gettotalharga()
   {
      $idheader = $this->input->post("idheader");

      $select = $this->db->select('sum(jumlahharga)as totalharga');
      $select = $this->db->where('detailpenjualan.status_tmp', 1);
      $select = $this->db->where('detailpenjualan.deleted', 0);
      // $select = $this->db->where('detailpenjualan.id_headerpenjualan', $idheader);
      $select = $this->db->where('detailpenjualan.id_user', $this->session->userdata('id_user'));
      $data['totalharga'] = $this->m->Get_All('detailpenjualan', $select);

      // $data['id_detailpenjualan']        = $this->m->id_detailpenjualan();

      $this->load->view('penjualan/totalharga', $data);
   }

   function gettotalharga_edit()
   {
      $idheader = $this->input->post("idheaderpenjualan");

      $select = $this->db->select('sum(amount)as totalharga');
      $select = $this->db->where('detailpenjualan.deleted', 0);
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', $idheader);
      $select = $this->db->where('detailpenjualan.id_user', $this->session->userdata('id_user'));
      $data['totalharga'] = $this->m->Get_All('detailpenjualan', $select);


      // $data['id_detailpenjualan']        = $this->m->id_detailpenjualan();

      $this->load->view('pages/penjualan/totalhargaedit', $data);
   }
   function adddetailpenjualan()
   {
      $this->db->select_max('detailpenjualan.id_detailpenjualan');
      $this->db->order_by('id_detailpenjualan', 'desc');

      $this->db->limit(1);
      $query = $this->db->get('detailpenjualan');
      if ($query->num_rows() <> 0) {
         $data = $query->row();
         $kode = intval($data->id_detailpenjualan) + 1;
      } else {
         $kode = 1;
      }
      $batas = str_pad($kode, "0", STR_PAD_LEFT);
      $iddetailpenjualan = $batas;

      $data = array(
         'id_detailpenjualan'   =>   $iddetailpenjualan,
         'namabarang'           =>   $this->input->post('namabarang'),
         'id_headerpenjualan'   =>   $this->input->post('idheader'),
         'jumlah'               =>   $this->input->post('jumlah'),
         'harga'                =>   $this->input->post('hargaproduk'),
         'jumlahharga'          =>   str_replace('.', '', $this->input->post('totalhargabarang')),
         // 'id_user'              =>   $this->session->userdata('id'),
         'status_tmp'           =>   "1",
         'deleted'              =>   0,
      );

      $this->m->Save($data, 'detailpenjualan');
   }
   function updatedetailpenjualan()
   {

      $table = 'detailpenjualan';
      $where = array(
         'id_detailpenjualan'          =>   $this->input->post('iddetailpenjualan')
      );

      $data = array(
         'jumlah'             =>   $this->input->post('jumlah'),
         'harga'              =>   $this->input->post('hargaproduk'),
         'jumlahharga'        => str_replace('.', '', $this->input->post('totalhargabarang')),
      );
      $this->m->Update($where, $data, $table);
   }
   function deletedetailpenjualan()
   {
      $table = 'detailpenjualan';
      $where = array(
         'id_detailpenjualan'          =>   $this->input->post('iddetailpenjualan')
      );

      $data = array(
         'deleted'           =>   1
      );

      $this->m->Update($where, $data, $table);
   }

   function editpenjualan()
   {
      $id_headerpenjualan = $this->input->post('idheaderpenjualan');
      date_default_timezone_set('Asia/Jakarta');
      $now = date('Y-m-d H:i:s');

      $data['user'] = $this->db->get_where('user', ['name' =>
      $this->session->userdata('name')])->row_array();

      $data['title'] = 'Edit Data Invoice';

      $select = $this->db->select('*');
      $select = $this->db->order_by('nama_agen');
      $data['agen'] = $this->m->Get_All('user_dataagen', $select);

      $select = $this->db->select('*');
      $select = $this->db->join('user_dataagen', 'user_dataagen.id = headerpenjualan.id_agen', 'left');
      $select = $this->db->order_by('nomorpenjualan');
      $select = $this->db->where('headerpenjualan.create_by', $this->session->userdata('id'));
      $select = $this->db->where('headerpenjualan.deleted', 0);
      $select = $this->db->where('headerpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $data['headerpenjualan'] = $this->m->Get_All('headerpenjualan', $select);

      $select = $this->db->select('*, detailpenjualan.discountpersen as discountpersendetail, detailpenjualan.discountnilai as discountnilaidetail');
      $select = $this->db->join('headerpenjualan', 'headerpenjualan.id_headerpenjualan = detailpenjualan.id_headerpenjualan');
      $select = $this->db->where('detailpenjualan.id_user', $this->session->userdata('id'));
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $select = $this->db->where('detailpenjualan.deleted', 0);;
      $data['detailpenjualan'] = $this->m->Get_All('detailpenjualan', $select);

      $select = $this->db->select('sum(jumlahharga)as totalharga');
      $select = $this->db->where('detailpenjualan.deleted', 0);
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $select = $this->db->where('detailpenjualan.id_user', $this->session->userdata('id_user'));
      $data['totalharga'] = $this->m->Get_All('detailpenjualan', $select);

      // $data['id_headerpenjualan']        = $this->m->id_headerpenjualan();
      $data['id_detailpenjualan']        = $this->m->id_detailpenjualan();
      // $data['nomorpenjualan']              = $this->m->nomorpenjualan();

      $this->load->view('templates/penjualan_header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('penjualan/editpenjualan', $data);
      $this->load->view('templates/penjualan_footer');
   }
   function updatepenjualan()
   {
      $id_headerpenjualan = $this->input->post('id_headerpenjualan');

      date_default_timezone_set('Asia/Jakarta');
      $now = date('Y-m-d H:i:s');

      $tgl1    = $this->input->post('tanggaltransaksi');
      $deadline = $this->input->post('termsofpayment');
      $tanggaljto    = date('Y-m-d', strtotime('+' . $deadline . 'days', strtotime($tgl1))); //  

      $table = 'headerpenjualan';
      $where = array(
         'id_headerpenjualan'   =>   $this->input->post('id_headerpenjualan'),
      );
      $data = array(
         'nomorpenjualan'       =>   $this->input->post('nomor'),
         'tanggalpenjualan'     =>   $this->input->post('tanggaltransaksi'),
         // 'memo'                 =>   $this->input->post('memo'),
         //'faktursupplier'       =>   $this->input->post('faktursupplier'),
         'nomorpo'              =>   $this->input->post('nomorpo'),
         'id_agen'              =>   $this->input->post('idagen'),
         'jumlahpenjualan'      =>   str_replace('.', '', $this->input->post('grandtotal')),
         'discountpersen'       =>   $this->input->post('diskonpersenheader'),
         'discountnilai'        =>   str_replace('.', '', $this->input->post('diskonnilaiheader')),
         'deleted'              =>    0,
         'update_by'            =>   $this->session->userdata('id'),
         'update_date'          =>   $now,
      );
      $this->m->Update($where, $data, $table);
      $this->m->Update($where, $data, $table);

      if (isset($_POST['tbldetailpenjualan'])) {
         $table = 'detailpenjualan';
         $where = array(
            'id_headerpenjualan'          =>  $id_headerpenjualan,
         );
         $this->m->Delete($where,  $table);

         $this->m->Delete($where,  $table);
         $tabledetailpenjualan = json_decode($_POST['tbldetailpenjualan'], true);
         // $i = count($tabledetaildiamond);
         foreach ($tabledetailpenjualan as $row) {
            //$id_barangjadidetail += 1; 
            $namabarang = $row['namabarang'];
            $jumlah = $row['jumlah'];
            $hargaproduk = $row['hargaproduk'];
            $totalhargabarang = $row['totalhargabarang'];

            // $where = array(
            //    'id_barangjadidetail'          =>   $id_detail,
            //    'id_user'          =>   $this->session->userdata('id_user'),
            // );
            $this->db->select_max('detailpenjualan.id_detailpenjualan');
            $this->db->order_by('id_detailpenjualan', 'desc');

            $this->db->limit(1);
            $query = $this->db->get('detailpenjualan');
            if ($query->num_rows() <> 0) {
               $data = $query->row();
               $kode = intval($data->id_detailpenjualan) + 1;
            } else {
               $kode = 1;
            }
            $batas = str_pad($kode, "0", STR_PAD_LEFT);
            $iddetailpenjualan = $batas;

            $data = array(
               'id_detailpenjualan'         =>   $iddetailpenjualan,
               'id_headerpenjualan'         =>   $id_headerpenjualan,
               'namabarang'                 =>   $namabarang,
               'jumlah'                     =>   $jumlah,
               'harga'                      =>   str_replace('.', '', $hargaproduk),
               'jumlahharga'                =>   str_replace('.', '', $totalhargabarang),
               'id_user'                    =>   $this->session->userdata('id_user'),
            );
            $this->m->Save($data, 'detailpenjualan');

            // Cek apakah data berhasil disimpan atau tidak
            if ($this->db->affected_rows() < 0) {
               die("Terjadi kesalahan saat menyimpan data.");
            }
         }
      }

      $this->session->set_flashdata('success', 'Data penjualan berhasil diubah');
      redirect('listpenjualan');
   }

   function deletedatapenjualan()
   {

      $table = 'headerpenjualan';
      $where = array(
         'id_headerpenjualan'          =>   $this->input->post('id_headerpenjualan')
      );

      $data = array(
         'deleted'           =>   1
      );
      $this->m->Update($where, $data, $table);

      $table = 'detailpenjualan';
      $where = array(
         'id_headerpenjualan'          =>   $this->input->post('id_headerpenjualan')
      );

      $data = array(
         'deleted'           =>   1
      );
      $this->m->Update($where, $data, $table);


      $this->session->set_flashdata('success', 'Data penjualan berhasil dihapus');
      redirect('listpenjualan');
   }
   function deletedetailpenjualansementara()
   {
      $table = 'detailpenjualan';
      $where = array(
         'id_headerpenjualan'          =>   $this->input->post('id_headerpenjualan'),
         'status'                   =>   1,
      );
      $this->m->Delete($where, $table);

      $table = 'detailpenjualan';
      $where = array(
         'id_headerpenjualan'          =>   $this->input->post('id_headerpenjualan'),
         'status'                   =>   0,
         'deleted'                 =>   1
      );
      $data = array(
         'deleted'           =>   0
      );
      $this->m->Update($where, $data, $table);

      $table = 'mutasibarang';
      $where = array(
         'nomortransaksibarang'          =>   $this->input->post('nomor'),
         'status_tmp'                   =>   0,
         'deleted'                 =>   1
      );
      $data = array(
         'deleted'           =>   0
      );
      $this->m->Update($where, $data, $table);
   }
   function detailpenjualan($id_headerpenjualan)
   {

      $data['user'] = $this->db->get_where('user', ['name' =>
      $this->session->userdata('name')])->row_array();

      $data['title'] = 'Detail Data Invoice';

      $select = $this->db->join('user_dataagen', 'user_dataagen.id = headerpenjualan.id_agen', 'left');
      $select = $this->db->order_by('nomorpenjualan');
      $select = $this->db->where('headerpenjualan.create_by', $this->session->userdata('id'));
      $select = $this->db->where('headerpenjualan.deleted', 0);
      $select = $this->db->where('headerpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $data['headerpenjualan'] = $this->m->Get_All('headerpenjualan', $select);

      $select = $this->db->select('*');
      $select = $this->db->join('headerpenjualan', 'headerpenjualan.id_headerpenjualan = detailpenjualan.id_headerpenjualan');
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $data['detailpenjualan'] = $this->m->Get_All('detailpenjualan', $select);

      $select = $this->db->select('sum(jumlahharga) as totalharga');
      $select = $this->db->join('headerpenjualan', 'headerpenjualan.id_headerpenjualan = detailpenjualan.id_headerpenjualan');
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $data['totalhargapenjualan'] = $this->m->Get_All('detailpenjualan', $select);


      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('penjualan/detailpenjualan', $data);
      $this->load->view('templates/footer');
   }
   function cetakinvoice($id_headerpenjualan)
   {

      date_default_timezone_set('Asia/Jakarta');

      $this->load->library('dompdf_gen');

      $data = [
         'name'     => 'Cetak Invoice',
         'title'    => 'INVOICE AGEN',
         // 'lokasi'    => $this->input->post("lokasi"),
         // 'jenisbahan'    => $this->input->post("jenisbahanreport"), 
         'time'      =>  date('H:i:s')
      ];
      $select = $this->db->join('user_dataagen', 'user_dataagen.id = headerpenjualan.id_agen', 'left');
      $select = $this->db->order_by('nomorpenjualan');
      $select = $this->db->where('headerpenjualan.deleted', 0);
      $select = $this->db->where('headerpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $data['headerpenjualan'] = $this->m->Get_All('headerpenjualan', $select);

      $select = $this->db->select('*');
      $select = $this->db->join('headerpenjualan', 'headerpenjualan.id_headerpenjualan = detailpenjualan.id_headerpenjualan');
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $data['detailpenjualan'] = $this->m->Get_All('detailpenjualan', $select);

      $select = $this->db->select('sum(jumlahharga) as totalharga');
      $select = $this->db->join('headerpenjualan', 'headerpenjualan.id_headerpenjualan = detailpenjualan.id_headerpenjualan');
      $select = $this->db->where('detailpenjualan.id_headerpenjualan', $id_headerpenjualan);
      $data['totalhargapenjualan'] = $this->m->Get_All('detailpenjualan', $select);


      $this->load->view('penjualan/cetakinvoice', $data);

      $paper_size = 'A4';
      $orintation = 'potrait';
      //$customPaper = array(0,0,850,1000);
      $html = $this->output->get_output();

      $this->dompdf->set_paper($paper_size, $orintation);
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream("Invoice.pdf", array('Attachment' => 0));
   }

   //Import Data Penjualan
   public function importdatapenjualan()
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
         redirect('listpenjualan');
      } else {
         // Jika upload berhasil, baca file Excel
         $fileInfo = $this->upload->data();
         $inputFileName = './assets/file/importexcel/' . $fileInfo['file_name'];
         $spreadsheet = IOFactory::load($inputFileName);

         date_default_timezone_set('Asia/Jakarta');
         $now = date('Y-m-d H:i:s');


         // Ambil data dari sheet pertama
         $worksheet = $spreadsheet->getActiveSheet();
         $highestRow = $worksheet->getHighestRow();
         $highestColumn = $worksheet->getHighestColumn();

         $previousnamaagen = null;
         // Deklarasikan variabel penampung untuk nomor invoice sebelumnya
         $incrementNumber = 1; // Inisialisasi nomor increment
         $totalhargapenjualan = 0;
         $maximum = null;
         foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {

               $worksheet = $spreadsheet->setActiveSheetIndex(0);
               $tanggalorder = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
               $namaagen = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
               $notelepon = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
               $alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
               $namaproduk = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
               $jumlahproduk = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
               $hargaproduk = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

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
               $indonesia_date_parts = explode(' ', $tanggalorder);
               $day = str_pad($indonesia_date_parts[0], 2, '0', STR_PAD_LEFT);
               $month = $month_names[$indonesia_date_parts[2]];
               $year = $indonesia_date_parts[3];

               $database_date = "$year-$month-$day";

               $this->db->select('*');
               $this->db->from('user_dataagen');
               $this->db->where_in('nama_agen', $namaagen);
               $getagen = $this->db->get();

               $getdataagen    = $getagen->result();

               if ($getagen->num_rows() == 0) {
                  // $namaagen = "";
               } else {
                  foreach ($getdataagen as $dataagen) {
                     $idagen = $dataagen->id;
                     $namaagenmaster = $dataagen->nama_agen;
                  }
               }


               if ($namaagen != $previousnamaagen) {
                  $this->db->select_max('headerpenjualan.id_headerpenjualan');
                  $this->db->order_by('id_headerpenjualan', 'desc');

                  $this->db->limit(1);
                  $query = $this->db->get('headerpenjualan');
                  if ($query->num_rows() <> 0) {
                     $data = $query->row();
                     $kode = intval($data->id_headerpenjualan) + 1;
                  } else {
                     $kode = 1;
                  }
                  $batas = str_pad($kode, "0", STR_PAD_LEFT);
                  $id_headerpenjualan = $batas;

                  $this->db->select('RIGHT(headerpenjualan.id_headerpenjualan,5) as id_headerpenjualan', FALSE);
                  $this->db->order_by('id_headerpenjualan', 'DESC');
                  $this->db->limit(1);
                  $query = $this->db->get('headerpenjualan');
                  if ($query->num_rows() <> 0) {
                     $data = $query->row();
                     $kode = intval($data->id_headerpenjualan) + 1;
                  } else {
                     $kode = 1;
                  }

                  $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
                  $kodetampil = "INVC-" . $batas . "/TRX/B2C/" . $namaagen;
                  // return $kodetampil;
               }


               $this->db->select('*');
               $query = $this->db->get('import_datapenjualantmp');
               $getdatapenjualantmp = $query->result();

               if ($query->num_rows() == 0) {
                  if (empty($tanggalorder) or empty($namaagen) or empty($notelepon) or empty($alamat) or empty($namaproduk) or empty($jumlahproduk) or empty($hargaproduk) or $getagen->num_rows() == 0) {
                     $data = array(
                        'tanggalimport'    =>    $this->input->post('tanggaltransaksi'),
                        'tanggalorder'     => $database_date,
                        'namaagen'         => $namaagen,
                        'notelepon'        => $notelepon,
                        'alamatagen'       => $alamat,
                        'namaproduk'       => $namaproduk,
                        'jumlahproduk'     => $jumlahproduk,
                        'hargaproduk'      => str_replace('.', '', $hargaproduk),
                        'status_temporary' => 1,
                     );

                     $this->m->Save($data, 'import_datapenjualantmp');
                  } else {
                     //  
                     $existingData = $this->db->get_where('headerpenjualan', array('id_agen' => $idagen))->row();

                     if (!$existingData) {
                        // Data doesn't exist, perform insert
                        $this->db->select_max('detailpenjualan.id_detailpenjualan');
                        $this->db->order_by('id_detailpenjualan', 'desc');

                        $this->db->limit(1);
                        $query = $this->db->get('detailpenjualan');
                        if ($query->num_rows() <> 0) {
                           $data = $query->row();
                           $kode = intval($data->id_detailpenjualan) + 1;
                        } else {
                           $kode = 1;
                        }
                        $batas = str_pad($kode, "0", STR_PAD_LEFT);
                        $iddetailpenjualan = $batas;

                        $data = array(
                           'id_detailpenjualan' => $iddetailpenjualan,
                           'id_headerpenjualan' => $id_headerpenjualan,
                           'namabarang'         => $namaproduk,
                           'jumlah'             => $jumlahproduk,
                           'harga'              => $hargaproduk,
                           'jumlahharga'        => $jumlahproduk * $hargaproduk,
                           'deleted'            => 0,
                           'status_tmp'         => 0,
                        );
                        $this->m->Save($data, 'detailpenjualan');


                        $data = array(
                           'id_headerpenjualan'  => $id_headerpenjualan,
                           'nomorpenjualan'      => $kodetampil,
                           'termsofpayment'      => 1,
                           'tanggalimport'       => $this->input->post('tanggaltransaksi'),
                           'id_agen'             => $idagen,
                           'tanggalpenjualan'    => $database_date,
                           'jumlahpenjualan'     => $jumlahproduk * $hargaproduk,
                           'deleted'             => 0,
                           'create_date'         => $now,
                        );

                        $previousnamaagen = $namaagen;
                        // Tingkatkan nomor increment
                        $id_headerpenjualan++;
                        $kodetampil++;
                        $this->m->Save($data, 'headerpenjualan');
                     }
                  }
               } else {
                  foreach ($getdatapenjualantmp as $datapenjualantmp) {
                     $namaagentmp = $datapenjualantmp->namaagen;
                  }
                  if ($namaagen != $namaagentmp) {
                     $this->db->where('namaagen', null);
                     $this->db->delete('import_datapenjualantmp');
                  }
               }
            }
         }
      }


      redirect('validasidatapenjualan');
   }
   function validasidatapenjualan()
   {

      // $this->db->select('*');
      // $this->db->from('salesstore');
      // $this->db->where('store_id', $store);
      // $getsalesstore = $this->db->get();

      $data['title'] = 'Data Penjualan Tidak Valid';
      $data['user'] = $this->db->get_where('user', ['name' =>
      $this->session->userdata('name')])->row_array();

      $select = $this->db->select('*');
      $select = $this->db->where('import_datapenjualantmp.status_temporary', 1);
      $data['read'] = $this->m->Get_All('import_datapenjualantmp', $select);

      $select = $this->db->select('*');
      $data['dataagen'] = $this->m->Get_All('user_dataagen', $select);


      $this->load->view('templates/valid_header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('penjualan/validasipenjualan', $data);
      $this->load->view('templates/valid_footer');
   }
   function updateimportpenjualan()
   {
      if (isset($_POST['tblpenjualan'])) {
         $tablepenjualan = json_decode($_POST['tblpenjualan'], true);

         $previousidagen = null;
         // $i = count($tabledetaildiamond);
         foreach ($tablepenjualan as $row) {
            $idimport = $row['idimport'];
            $tanggalimport = $row['tanggalimport'];
            $tanggalorder = $row['tanggalorder'];
            $idagen = $row['idagen'];
            $namaproduk = $row['namaproduk'];
            $jumlahproduk = $row['jumlahproduk'];
            $hargaproduk = $row['hargaproduk'];

            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');


            if ($idagen != $previousidagen) {
               $this->db->select_max('headerpenjualan.id_headerpenjualan');
               $this->db->order_by('id_headerpenjualan', 'desc');

               $this->db->limit(1);
               $query = $this->db->get('headerpenjualan');
               if ($query->num_rows() <> 0) {
                  $data = $query->row();
                  $kode = intval($data->id_headerpenjualan) + 1;
               } else {
                  $kode = 1;
               }
               $batas = str_pad($kode, "0", STR_PAD_LEFT);
               $id_headerpenjualan = $batas;

               $this->db->select('RIGHT(headerpenjualan.id_headerpenjualan,5) as id_headerpenjualan', FALSE);
               $this->db->order_by('id_headerpenjualan', 'DESC');
               $this->db->limit(1);
               $query = $this->db->get('headerpenjualan');
               if ($query->num_rows() <> 0) {
                  $data = $query->row();
                  $kode = intval($data->id_headerpenjualan) + 1;
               } else {
                  $kode = 1;
               }

               $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
               $kodetampil = "INVC-" . $batas;
               // return $kodetampil;
            }

            $this->db->select_max('detailpenjualan.id_detailpenjualan');
            $this->db->order_by('id_detailpenjualan', 'desc');

            $this->db->limit(1);
            $query = $this->db->get('detailpenjualan');
            if ($query->num_rows() <> 0) {
               $data = $query->row();
               $kode = intval($data->id_detailpenjualan) + 1;
            } else {
               $kode = 1;
            }
            $batas = str_pad($kode, "0", STR_PAD_LEFT);
            $iddetailpenjualan = $batas;

            if (empty($idagen) or empty($namaproduk) or empty($jumlahproduk) or empty($hargaproduk)) {
               # code...
            } else {
               $data = array(
                  'id_detailpenjualan' => $iddetailpenjualan,
                  'id_headerpenjualan' => $id_headerpenjualan,
                  'namabarang'         => $namaproduk,
                  'jumlah'             => $jumlahproduk,
                  'harga'              => $hargaproduk,
                  'jumlahharga'        => $jumlahproduk * $hargaproduk,
                  'deleted'            => 0,
                  'status_tmp'         => 0,
               );

               $this->m->Save($data, 'detailpenjualan');


               $data = array(
                  'id_headerpenjualan'  => $id_headerpenjualan,
                  'nomorpenjualan'      => $kodetampil,
                  'tanggalimport'       => $tanggalimport,
                  'id_agen'             => $idagen,
                  'tanggalpenjualan'    => $tanggalorder,
                  'jumlahpenjualan'     => $jumlahproduk * $hargaproduk,
                  'deleted'             => 0,
                  'create_date'         => $now,
               );
               $previousidagen = $idagen;
               // Tingkatkan nomor increment
               $id_headerpenjualan++;
               $kodetampil++;
               $this->m->Save($data, 'headerpenjualan');

               $table = 'import_datapenjualantmp';
               $where = array(
                  'id_import'          =>   $idimport,
               );
               $data = array(
                  'status_temporary' => 0,
               );
               $this->m->Update($where, $data, $table);
            }


            if ($this->db->affected_rows() < 0) {
               die("Terjadi kesalahan saat menyimpan data.");
            }
         }
      }
      redirect('listpenjualan');
   }
}
