<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{

   public function insert($data = array())
   {
      return $this->db->insert('siswa', $data);
   }

   public function getAllSiswa()
   {
      return $this->db->query("SELECT * FROM siswa ")->result_array();
   }

   public function getSiswaByID($id_siswa)
   {
      return $this->db->query("SELECT * FROM siswa WHERE `id_siswa` = '$id_siswa'")->row_array();
   }

   public function getSiswaByNmSiswa($nama_siswa)
   {
      return $this->db->query("SELECT * FROM siswa WHERE `nama_siswa` = '$nama_siswa'")->row_array();
   }

   public function getAllSiswaByStatus($status)
   {
      return $this->db->query("SELECT * FROM siswa WHERE `status_nilai` = '$status'")->result_array();
   }

   public function countSiswa()
   {
      return $this->db->count_all('siswa');
   }

   public function changeStatus($id_siswa, $status)
   {
      return $this->db->query("UPDATE siswa SET `status_nilai` = '$status' WHERE `id_siswa` = '$id_siswa'");
   }

   public function editSiswaData($new_data = array())
   {
      $nama_siswa = $new_data['nama_siswa'];
      $nisn = $new_data['nisn'];
      $nis = $new_data['nis'];
      $jurusan = $new_data['jurusan'];
      $jenis_kelamin = $new_data['jenis_kelamin'];
      $alamat = $new_data['alamat'];
      $no_telepon = $new_data['no_telepon'];
      $id_siswa = $new_data['id_siswa'];

      $query = "UPDATE siswa SET `nama_siswa` = '$nama_siswa', `nisn` = '$nisn', `nis` = '$nis', `jurusan` = '$jurusan', `jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat', `no_telepon` = '$no_telepon' WHERE `id_siswa` = '$id_siswa'";
      return $this->db->query($query);
   }

   public function deleteSiswa($id)
   {
      $query = "DELETE FROM siswa WHERE `id_siswa` = '$id'";
      return $this->db->query($query);
   }

   public function updatePassword($username, $password)
   {
      return $this->db->query("UPDATE user SET `password` = '$password' WHERE `username` = '$username'");
   }
}
