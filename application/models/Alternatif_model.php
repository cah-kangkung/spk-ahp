<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{

   public function insert($data = array())
   {
      return $this->db->insert('alternatif', $data);
   }

   public function getAllAlternatif()
   {
      return $this->db->query("SELECT * FROM alternatif ")->result_array();
   }

   public function getAlternatifByID($id_alternatif)
   {
      return $this->db->query("SELECT * FROM alternatif WHERE `id_alternatif` = '$id_alternatif'")->row_array();
   }

   public function getAlternatifByNmAlternatif($nama_alternatif)
   {
      return $this->db->query("SELECT * FROM alternatif WHERE `nama_alternatif` = '$nama_alternatif'")->row_array();
   }

   public function countAlternatif()
   {
      return $this->db->count_all('alternatif');
   }

   public function editAlternatifData($new_data = array())
   {
      $nama_alternatif = $new_data['nama_alternatif'];
      $nisn = $new_data['nisn'];
      $nis = $new_data['nis'];
      $jenis_kelamin = $new_data['jenis_kelamin'];
      $alamat = $new_data['alamat'];
      $no_telepon = $new_data['no_telepon'];
      $id_alternatif = $new_data['id_alternatif'];

      $query = "UPDATE alternatif SET `nama_alternatif` = '$nama_alternatif', `nisn` = '$nisn', `nis` = '$nis', `jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat', `no_telepon` = '$no_telepon' WHERE `id_alternatif` = '$id_alternatif'";
      return $this->db->query($query);
   }

   public function deleteAlternatif($id)
   {
      $query = "DELETE FROM alternatif WHERE `id_alternatif` = '$id'";
      return $this->db->query($query);
   }

   public function updatePassword($username, $password)
   {
      return $this->db->query("UPDATE user SET `password` = '$password' WHERE `username` = '$username'");
   }
}
