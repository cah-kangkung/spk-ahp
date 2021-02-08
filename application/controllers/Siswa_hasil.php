<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_hasil extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
      $this->load->model('Kriteria_model', 'Kriteria');
      $this->load->model('Nilai_Siswa_model', 'Nilai_Siswa');
      $this->load->model('Siswa_model', 'Siswa');
      $this->load->model('Alternatif_model', 'Alternatif');
   }

   public function index()
   {
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }
      }
   }

   public function tampil()
   {
      $nilai_kriteria = $this->Kriteria->getAllNilaiKriteria();
      $nilai_kriteria = array_column($nilai_kriteria, 'nilai');
      $n = $this->Kriteria->countKriteria();

      $matriks = array();
      $index = 0;
      for ($i = 0; $i < $n; $i++) {
         for ($j = 0; $j < $n; $j++) {
            $matriks[$i][$j] = $nilai_kriteria[$index];
            $index++;
         }
      }

      // mencari total kolom
      $total_kolom = array();
      for ($i = 0; $i < $n; $i++) {
         $col = array_column($matriks, $i);
         $sum = array_sum($col);
         array_push($total_kolom, $sum);
      }

      // normalisasi matrik
      // nilai_kriteria / total kolom
      $normalisasi_matriks = $matriks;
      for ($i = 0; $i < $n; $i++) {
         for ($j = 0; $j < $n; $j++) {
            $normalisasi_matriks[$i][$j] = $normalisasi_matriks[$i][$j] / $total_kolom[$j];
         }
      }

      // menghitung bobot
      $bobot = array();
      foreach ($normalisasi_matriks as $row) {
         $sum = array_sum($row);
         array_push($bobot, $sum / $n);
      }

      // get all user information from the database
      $username = $this->session->userdata('username');
      $data['user_data'] = $this->User->getUserByUsername($username);
      $data['title'] = "Hasil";

      $kriteria = $this->Kriteria->getAllKriteria();
      $lables = array();
      foreach ($kriteria as $k) {
         array_push($lables, $k['nama_kriteria']);
      }
      $data['lables'] = $lables;
      $data['bobot_kriteria'] = $bobot;
      $data['bobot_alternatif'] = array();
      $list_siswa = $this->Siswa->getAllSiswa();
      foreach ($list_siswa as $siswa) {
         $alternatif_siswa = $this->Alternatif->getAlternatifByID($siswa['id_siswa']);
         $bobot_siswa = array();
         array_push($bobot_siswa, $siswa['nama_siswa']);
         for ($i = 0; $i < count($alternatif_siswa); $i++) {
            array_push($bobot_siswa, $alternatif_siswa[$i]['nilai_bobot']);
         }
         array_push($data['bobot_alternatif'], $bobot_siswa);
      }

      $data['ranking'] = $this->_hitung_ranking($data['bobot_alternatif'], $data['bobot_kriteria']);


      // sort array menjadi ranking
      end($data['ranking']);
      $index = key($data['ranking']);
      $keys = array_column($data['ranking'], $index);
      array_multisort($keys, SORT_DESC, $data['ranking']);

      $data['kriteria'] = $this->Kriteria->getAllKriteria();

      $this->load->view('templates/admin_headbar', $data);
      $this->load->view('templates/siswa_sidebar');
      $this->load->view('templates/admin_topbar');
      $this->load->view('siswa_perhitungan/siswa_hasil/index');
      $this->load->view('templates/admin_footer');
   }




   private function _hitung_ranking($bobot_alternatif, $bobot_kriteria)
   {
      $ranking = array();
      foreach ($bobot_alternatif as $ba) {
         $hasil = 0;
         for ($j = 0; $j < count($bobot_kriteria); $j++) {
            $c = $ba[$j + 1] * $bobot_kriteria[$j];
            $hasil += $c;
         }
         array_push($ba, $hasil);
         array_push($ranking, $ba);
      }

      return $ranking;
   }
}
