<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perbandingan extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
      $this->load->model('Kriteria_model', 'Kriteria');
   }

   public function perbandingan_kriteria()
   {
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         // get all user information from the database
         $username = $this->session->userdata('username');
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['title'] = "Perbandingan Kriteria";

         $nilai_kriteria = $this->Kriteria->getAllNilaiKriteria();
         $nilai_kriteria = array_column($nilai_kriteria, 'nilai');

         if ($nilai_kriteria) {
            $this->_hitung_perbandingan_kriteria($nilai_kriteria);
         } else {
            $n = $this->Kriteria->countKriteria();
            $data['i_matrix'] = $this->create_identity_matrix($n);
            $data['total_kolom'] = array();
            $data['normalisasi_matriks'] = array();
            $data['bobot_kriteria'] = array();
            $data['cm'] = array();
            $data['ci'] = array();
            $data['cr'] = array();
            $data['ri'] = array();
            $data['saaty_ordo'] = array();

            $kriteria = $this->Kriteria->getAllKriteria();
            $lables = array();
            foreach ($kriteria as $k) {
               array_push($lables, $k['nama_kriteria']);
            }
            $data['lables'] = $lables;

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('perhitungan/perbandingan/perbandingan_kriteria/index');
            $this->load->view('templates/admin_footer');
         }
      }
   }

   public function submit_perbandingan_kriteria()
   {
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         $this->Kriteria->truncate_nilai();
         $nilai_kriteria = $this->input->post('nilai_kriteria');
         $this->_hitung_perbandingan_kriteria($nilai_kriteria);
      }
   }

   private function _hitung_perbandingan_kriteria($nilai_kriteria)
   {
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

      // menghitung consistency measure
      $cm  = array();
      for ($i = 0; $i < count($matriks); $i++) {
         $sum = 0;
         for ($j = 0; $j < count($matriks); $j++) {
            $cm_value = $matriks[$i][$j] * $bobot[$j];
            $sum += $cm_value;
         }
         $sum = $sum / $bobot[$i];
         array_push($cm, $sum);
      }

      // menghitung consistency index
      $mean_cm = array_sum($cm) / $n;
      $ci = ($mean_cm - $n) / ($n - 1);

      // memghitung cr
      // cr = ci / ri
      $saaty_ordo = [0, 0, 0.58,   0.9,   1.12,   1.24,   1.32,   1.41,   1.46,   1.49];
      $ri = $saaty_ordo[$n - 1];
      $cr = $ci / $ri;

      $data = [
         'i_matrix' => $matriks,
         'total_kolom' => $total_kolom,
         'normalisasi_matriks' => $normalisasi_matriks,
         'bobot_kriteria' => $bobot,
         'cm' => $cm,
         'saaty_ordo' => $saaty_ordo,
         'ci' => $ci,
         'ri' => $ri,
         'cr' => $cr,
      ];

      // get all user information from the database
      $username = $this->session->userdata('username');
      $data['user_data'] = $this->User->getUserByUsername($username);
      $data['title'] = "Perbandingan Kriteria";

      $kriteria = $this->Kriteria->getAllKriteria();
      $lables = array();
      foreach ($kriteria as $k) {
         array_push($lables, $k['nama_kriteria']);
      }
      $data['lables'] = $lables;
      $this->Kriteria->insert_nilai($nilai_kriteria);

      $this->load->view('templates/admin_headbar', $data);
      $this->load->view('templates/admin_sidebar');
      $this->load->view('templates/admin_topbar');
      $this->load->view('perhitungan/perbandingan/perbandingan_kriteria/index');
      $this->load->view('templates/admin_footer');
   }

   public function perbandingan_alternatif()
   {
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         // get all user information from the database
         $username = $this->session->userdata('username');
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['title'] = "Perbandingan Alternatif";

         $n = $this->Kriteria->countKriteria();
         $data['i_matrix'] = $this->create_identity_matrix($n);
         $data['total_kolom'] = array();
         $data['normalisasi_matriks'] = array();
         $data['bobot_kriteria'] = array();

         $kriteria = $this->Kriteria->getAllKriteria();
         $lables = array();
         foreach ($kriteria as $k) {
            array_push($lables, $k['nama_kriteria']);
         }
         $data['lables'] = $lables;

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/admin_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('perhitungan/perbandingan/perbandingan_kriteria/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function hitung_perbandingan_alternatif()
   {
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         $nilai_kriteria = $this->input->post('nilai_kriteria');
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

         $data = [
            'i_matrix' => $matriks,
            'total_kolom' => $total_kolom,
            'normalisasi_matriks' => $normalisasi_matriks,
            'bobot_kriteria' => $bobot
         ];

         // get all user information from the database
         $username = $this->session->userdata('username');
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['title'] = "Perbandingan Kriteria";

         $kriteria = $this->Kriteria->getAllKriteria();
         $lables = array();
         foreach ($kriteria as $k) {
            array_push($lables, $k['nama_kriteria']);
         }
         $data['lables'] = $lables;

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/admin_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('perhitungan/perbandingan/perbandingan_alternatif/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function reset()
   {
      $this->Kriteria->truncate_nilai();
      redirect('perbandingan/perbandingan_kriteria');
   }

   public function create_identity_matrix($n)
   {
      $i_matrix = array();

      for ($i = 0; $i < $n; $i++) {
         for ($j = 0; $j < $n; $j++) {
            if ($i === $j) {
               $i_matrix[$i][$j] = 1;
            } else {
               $i_matrix[$i][$j] = 0;
            }
         }
      }

      return $i_matrix;
   }
}
