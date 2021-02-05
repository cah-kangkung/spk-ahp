<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{

   public function insert($data = array())
   {
      return $this->db->insert('bobot_alternatif', $data);
   }

   public function getAlternatifByID($id_siswa)
   {
      return $this->db->query("SELECT * FROM bobot_alternatif WHERE `id_siswa` = '$id_siswa'")->result_array();
   }

   public function truncate_alternatif()
   {
      return $this->db->query("TRUNCATE TABLE bobot_alternatif");
   }
}
