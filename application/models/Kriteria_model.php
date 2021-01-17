<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{

   public function insert($data = array())
   {
      return $this->db->insert('kriteria', $data);
   }

   public function getAllKriteria()
   {
      return $this->db->query("SELECT * FROM kriteria ")->result_array();
   }

   public function getKriteriaByID($kriteria_id)
   {
      return $this->db->query("SELECT * FROM kriteria WHERE `id_kriteria` = '$kriteria_id'")->row_array();
   }

   public function getKriteriaByNmKriteria($kriteria)
   {
      return $this->db->query("SELECT * FROM kriteria WHERE `nama_kriteria` = '$kriteria'")->row_array();
   }

   public function countKriteria()
   {
      return $this->db->count_all('kriteria');
   }

   public function editKriteriaData($new_data = array())
   {
      $nama_kriteria = $new_data['nama_kriteria'];
      $kode_kriteria = $new_data['kode_kriteria'];
      $id_kriteria = $new_data['id_kriteria'];

      $query = "UPDATE kriteria SET `nama_kriteria` = '$nama_kriteria', `kode_kriteria` = '$kode_kriteria' WHERE `id_kriteria` = '$id_kriteria'";
      return $this->db->query($query);
   }

   public function deleteKriteria($id)
   {
      $query = "DELETE FROM kriteria WHERE `id_kriteria` = '$id'";
      return $this->db->query($query);
   }

   public function updatePassword($username, $password)
   {
      return $this->db->query("UPDATE user SET `password` = '$password' WHERE `username` = '$username'");
   }
}
