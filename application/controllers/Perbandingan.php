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
      $this->load->model('Nilai_Siswa_model', 'Nilai_Siswa');
      $this->load->model('Siswa_model', 'Siswa');
      $this->load->model('Alternatif_model', 'Alternatif');
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
            $this->Kriteria->truncate_nilai();
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
         $data['bobot_alternatif'] = array();

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/admin_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('perhitungan/perbandingan/perbandingan_alternatif/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function submit_perbandingan_alternatif()
   {
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }
         $this->Alternatif->truncate_alternatif();
         $this->_hitung_perbandingan_alternatif();
      }
   }

   private function _hitung_perbandingan_alternatif()
   {
      $kriteria = $this->Kriteria->getAllKriteria();
      $n = $this->Siswa->countSiswa();

      foreach ($kriteria as $k) {
         $nilai_alternatif = $this->Nilai_Siswa->getNilaiSiswaByIDKriteria($k['id_kriteria']);

         // membuat matriks identitas berdasarkan jumlah data alternatif
         // kemudian diisi dengan nilai dari DB
         $i_matriks = $this->create_identity_matrix(count($nilai_alternatif));
         for ($i = 0; $i < count($i_matriks); $i++) {
            for ($j = 0; $j < count($i_matriks); $j++) {
               if ($i === $j) {
                  $i_matriks[$i][$j] == 1;
               } elseif ($i > $j) {
                  continue;
               } else {
                  $nilai = $this->banding($nilai_alternatif[$i]['nilai'], $nilai_alternatif[$j]['nilai'], $nilai_alternatif[$i]['jenis_nilai']);

                  $i_matriks[$i][$j] = $nilai;
                  $i_matriks[$j][$i] = 1 / $nilai;
               }
            }
         }

         // mencari total kolom
         $total_kolom = array();
         for ($i = 0; $i < $n; $i++) {
            $col = array_column($i_matriks, $i);
            $sum = array_sum($col);
            array_push($total_kolom, $sum);
         }

         // normalisasi matrik
         // nilai_kriteria / total kolom
         $normalisasi_matriks = $i_matriks;
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

         for ($i = 0; $i < count($nilai_alternatif); $i++) {
            $data = [
               'id_kriteria' => $nilai_alternatif[$i]['id_kriteria'],
               'id_siswa' => $nilai_alternatif[$i]['id_siswa'],
               'nilai_bobot' => $bobot[$i],
            ];

            $this->Alternatif->insert($data);
         }
      }

      // get all user information from the database
      $username = $this->session->userdata('username');
      $data['user_data'] = $this->User->getUserByUsername($username);
      $data['title'] = "Perbandingan Kriteria";

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

      $data['kriteria'] = $this->Kriteria->getAllKriteria();

      $this->load->view('templates/admin_headbar', $data);
      $this->load->view('templates/admin_sidebar');
      $this->load->view('templates/admin_topbar');
      $this->load->view('perhitungan/perbandingan/perbandingan_alternatif/index');
      $this->load->view('templates/admin_footer');
   }

   // fungsi untuk membandingkan nilai alternatif dengan nilai alternatif lainnya
   // return hasil banding berupa score antara 1 - 9
   public function banding($i, $j, $jenis_nilai)
   {
      $hasil = 0;
      if ($jenis_nilai === 'angka') {
         $selisih = ($i - $j);
         $selisih_round = round($selisih, -1);
         if ($selisih_round >= 0) {
            if ($selisih == 0) {
               $hasil = 1;
            } elseif ($selisih == 10) {
               $hasil = 2;
            } elseif ($selisih == 20) {
               $hasil = 3;
            } elseif ($selisih == 30) {
               $hasil = 4;
            } elseif ($selisih == 40) {
               $hasil = 5;
            } elseif ($selisih == 50) {
               $hasil = 6;
            } elseif ($selisih == 60) {
               $hasil = 7;
            } elseif ($selisih == 70) {
               $hasil = 8;
            } elseif ($selisih >= 80) {
               $hasil = 9;
            }
         } elseif ($selisih_round < 0) {
            // kondisi selisih minus
            if ($selisih <= -80) {
               $hasil = 1 / 9;
            } elseif ($selisih == -70) {
               $hasil = 1 / 8;
            } elseif ($selisih == -60) {
               $hasil = 1 / 7;
            } elseif ($selisih == -50) {
               $hasil = 1 / 6;
            } elseif ($selisih == -40) {
               $hasil = 1 / 5;
            } elseif ($selisih == -30) {
               $hasil = 1 / 4;
            } elseif ($selisih == -20) {
               $hasil = 1 / 3;
            } elseif ($selisih == -10) {
               $hasil = 1 / 2;
            }
         }
      } elseif ($jenis_nilai === 'huruf') {
         $i = $this->ubah_huruf($i);
         $j = $this->ubah_huruf($j);

         $selisih = $i - $j;

         if ($selisih >= 0) {
            if ($selisih == 0) {
               $hasil = 1;
            } elseif ($selisih == 10) {
               $hasil = 2;
            } elseif ($selisih == 20) {
               $hasil = 3;
            } elseif ($selisih == 30) {
               $hasil = 4;
            } elseif ($selisih == 40) {
               $hasil = 5;
            } elseif ($selisih == 50) {
               $hasil = 6;
            } elseif ($selisih == 60) {
               $hasil = 7;
            } elseif ($selisih == 70) {
               $hasil = 8;
            } elseif ($selisih >= 80) {
               $hasil = 9;
            }
         } elseif ($selisih < 0) {
            // kondisi selisih minus
            if ($selisih <= -80) {
               $hasil = 1 / 9;
            } elseif ($selisih == -70) {
               $hasil = 1 / 8;
            } elseif ($selisih == -60) {
               $hasil = 1 / 7;
            } elseif ($selisih == -50) {
               $hasil = 1 / 6;
            } elseif ($selisih == -40) {
               $hasil = 1 / 5;
            } elseif ($selisih == -30) {
               $hasil = 1 / 4;
            } elseif ($selisih == -20) {
               $hasil = 1 / 3;
            } elseif ($selisih == -10) {
               $hasil = 1 / 2;
            }
         }
      }

      return $hasil;
   }

   // mengubah representasi nilai huruf menjadi angka
   public function ubah_huruf($huruf)
   {
      $angka = 0;
      if ($huruf == 'A') {
         $angka = 100;
      } elseif ($huruf == 'B') {
         $angka = 80;
      } elseif ($huruf == 'C') {
         $angka = 60;
      } elseif ($huruf == 'D') {
         $angka = 40;
      } elseif ($huruf == 'E') {
         $angka = 20;
      } elseif ($huruf == 'F') {
         $angka = 10;
      }

      return $angka;
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
