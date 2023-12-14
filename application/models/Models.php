<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Models extends CI_Model
{


   public function Get_All($table, $select)
   {
      $select;
      $query = $this->db->get($table);
      return $query->result();
   }

   public function nomorinvoice()
   {
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
      return $kodetampil;
   }
   function getAgen($postData)
   {

      $response = array();

      $this->db->select('*');

      if ($postData['search']) {

         // Select record
         $this->db->where("nama_agen like '%" . $postData['search'] . "%'");
         $this->db->limit(5);

         $records = $this->db->get('user_dataagenbaru')->result();

         foreach ($records as $row) {
            $response[] = array("value" => $row->id, "label" => $row->nama_agen);
         }
      }

      return $response;
   }

   public function Get_Where($where, $table)
   {
      $query = $this->db->get_where($table, $where);
      return $query->row();
   }

   function Save($data, $table)
   {
      $result = $this->db->insert($table, $data);
      return $result;
   }
   function Update($where, $data, $table)
   {
      $this->db->update($table, $data, $where);
      return $this->db->affected_rows();
   }
   function Update_Wherein($where, $data, $table)
   {

      $this->db->where_in($where);
      $this->db->update($table, $data);
      return $this->db->affected_rows();
   }
   function Update_All($data, $table)
   {
      $this->db->update($table, $data);
      return $this->db->affected_rows();
   }
   function Delete($where, $table)
   {
      $result = $this->db->delete($table, $where);
      return $result;
   }


   function Delete_All($table)
   {
      $result = $this->db->delete($table);
      return $result;
   }
   public function Masuk($username, $userpass)
   {
      $this->db->select('*');
      $this->db->from('user');

      $this->db->where('id', $username);
      $this->db->where('password', $userpass);

      $query = $this->db->get();

      if ($query->num_rows() > 0) {
         return $query->result();
      } else {
         return false;
      }
   }

   public function id_headerpenjualan()
   {

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
      $kodetampil = $batas;
      return $kodetampil;
   }

   public function id_detailpenjualan()
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
      $kodetampil = $batas;
      return $kodetampil;
   }
}
