<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_Siswa_model extends CI_Model
{

   public function insert($data = array())
   {
      return $this->db->insert('nilai_siswa', $data);
   }

   public function getAllNilaiSiswa()
   {
      return $this->db->query("SELECT * FROM siswa INNER JOIN nilai_siswa ON siswa.id_siswa=nilai_siswa.id_siswa")->result_array();
   }

   public function getNilaiSiswaByIdSiswa($id_siswa)
   {
      return $this->db->query("SELECT * FROM nilai_siswa INNER JOIN kriteria ON nilai_siswa.id_kriteria=kriteria.id_kriteria WHERE `id_siswa` = '$id_siswa'")->result_array();
   }

   public function getNilaiSiswaByNmSiswa($nama_siswa)
   {
      return $this->db->query("SELECT * FROM siswa WHERE `nama_siswa` = '$nama_siswa'")->row_array();
   }

   public function countNilaiSiswa()
   {
      return $this->db->count_all('nilai_siswa');
   }

   public function editNilaiSiswaData($new_data = array())
   {
      $nilai = $new_data['nilai'];
      $id_kriteria = $new_data['id_kriteria'];
      $id_siswa = $new_data['id_siswa'];

      $query = "UPDATE nilai_siswa SET `nilai` = '$nilai' WHERE `id_siswa` = '$id_siswa' AND `id_kriteria` = '$id_kriteria'";
      return $this->db->query($query);
   }

   public function deleteNilaiSiswa($id_siswa)
   {
      $query = "DELETE FROM nilai_siswa WHERE `id_siswa` = '$id_siswa'";
      return $this->db->query($query);
   }

   public function updatePassword($username, $password)
   {
      return $this->db->query("UPDATE user SET `password` = '$password' WHERE `username` = '$username'");
   }
}
