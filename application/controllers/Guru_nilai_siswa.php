<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_nilai_siswa extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
      $this->load->model('Kriteria_model', 'Kriteria');
      $this->load->model('Nilai_Siswa_model', 'Nilai_Siswa');
      $this->load->model('Siswa_model', 'Siswa');
   }

   public function index()
   {
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         // get all user information from the database
         $username = $this->session->userdata('username');
         $nama_siswa = $this->session->userdata('nama_siswa');
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['data_siswa'] = $this->Siswa->getAllSiswaByStatus(1);
         $data['title'] = "Manage Nilai Siswa";

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/guru_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('guru_nilai_siswa/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function tambah_nilai_siswa_guru()
   {
      # code...
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         // get all user information from the database
         $username = $this->session->userdata('username');
         $data['user_data'] = $this->User->getUserByUsername($username);

         $this->form_validation->set_rules('id_siswa', 'Siswa', 'required|trim');

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Tambah Nilai Siswa";
            $data['data_siswa'] = $this->Siswa->getAllSiswaByStatus(0);
            $data['kriteria'] = $this->Kriteria->getAllKriteria();
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('Guru_nilai_siswa/tambah_nilai_siswa_guru');
            $this->load->view('templates/admin_footer');
         } else {

            $id_siswa = $this->input->post('id_siswa');
            $nilai_kriteria = $this->input->post('nilai');

            foreach ($nilai_kriteria as $n) {
               $data = [
                  'id_siswa' => $id_siswa,
                  'id_kriteria' => $n['id_kriteria'],
                  'nilai' => $n['nilai'],
               ];

               $this->Nilai_Siswa->insert($data);
            }

            $this->Siswa->changeStatus($id_siswa, 1);

            $this->session->set_flashdata('success_alert', 'Nilai siswa berhasil ditambah!');
            redirect('Guru_nilai_siswa');
         }
      }
   }

   public function hapus_nilai_siswa_guru($id_siswa)
   {
      # code...
      $this->Siswa->changeStatus($id_siswa, 0);
      $this->Nilai_Siswa->deleteNilaiSiswa($id_siswa);
      $this->session->set_flashdata('success_alert', 'Nilai siswa berhasil dihapus!');
      redirect('Guru_nilai_siswa');
   }

   public function edit_nilai_siswa_guru($id_siswa)
   {
      # code...
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         // get all user information from the database
         $username = $this->session->userdata('username');
         $data['user_data'] = $this->User->getUserByUsername($username);

         $this->form_validation->set_rules('id_siswa', 'Siswa', 'required|trim');

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Edit Nilai Siswa";
            $data['siswa'] = $this->Siswa->getSiswaByID($id_siswa);
            $data['nilai_siswa'] = $this->Nilai_Siswa->getNilaiSiswaByIdSiswa($id_siswa);
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('Guru_nilai_siswa/edit_nilai_siswa_guru');
            $this->load->view('templates/admin_footer');
         } else {
            $id_siswa = $this->input->post('id_siswa');
            $nilai_kriteria = $this->input->post('nilai');

            foreach ($nilai_kriteria as $n) {
               $data = [
                  'id_siswa' => $id_siswa,
                  'id_kriteria' => $n['id_kriteria'],
                  'nilai' => $n['nilai'],
               ];

               $this->Nilai_Siswa->editNilaiSiswaData($data);
            }

            $this->Siswa->changeStatus($id_siswa, 1);

            $this->session->set_flashdata('success_alert', 'Nilai siswa berhasil diedit!');
            redirect('Guru_nilai_siswa');
         }
      }
   }

   public function accessBlocked()
   {
      $this->load->view('auth/blocked');
   }
}
