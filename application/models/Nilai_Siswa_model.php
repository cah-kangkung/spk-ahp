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
      return $this->db->query("SELECT * FROM nilai_siswa INNER JOIN siswa ON nilai_siswa.id_siswa=siswa.id_siswa")->result_array();
   }

   public function getNilaiSiswaByID($id_nilai_siswa)
   {
      return $this->db->query("SELECT * FROM nilai_siswa INNER JOIN siswa ON nilai_siswa.id_siswa=siswa.id_siswa WHERE `id_nilai_siswa` = '$id_nilai_siswa'")->row_array();
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
      $akademik = $new_data['akademik'];
      $sikap = $new_data['sikap'];
      $keaktifan = $new_data['keaktifan'];
      $id_nilai_siswa = $new_data['id_nilai_siswa'];

      $query = "UPDATE nilai_siswa SET `akademik` = '$akademik', `sikap` = '$sikap', `keaktifan` = '$keaktifan' WHERE `id_nilai_siswa` = '$id_nilai_siswa'";
      return $this->db->query($query);
   }

   public function deleteNilaiSiswa($id)
   {
      $query = "DELETE FROM nilai_siswa WHERE `id_nilai_siswa` = '$id'";
      return $this->db->query($query);
   }

   public function updatePassword($username, $password)
   {
      return $this->db->query("UPDATE user SET `password` = '$password' WHERE `username` = '$username'");
   }
}
