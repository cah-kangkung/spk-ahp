<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_siswa extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
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
         $data['data_siswa'] = $this->Siswa->getAllSiswa();
         $data['nama_siswa'] = $this->Siswa->getSiswaByNmSiswa($nama_siswa);
         $data['nilaisiswa'] = $this->Nilai_Siswa->getAllNilaiSiswa();
         $data['title'] = "Manage Nilai Siswa";

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/admin_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('nilai_siswa/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function tambah_nilai_siswa()
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

         $this->form_validation->set_rules('akademik', 'Nilai Akademik', 'required|trim', ['required' => 'Nilai Akademik harus diisi']);
         $this->form_validation->set_rules('sikap', 'Nilai Sikap', 'required|trim', ['required' => 'Nilai Sikap harus diisi']);
         $this->form_validation->set_rules('keaktifan', 'Nilai Keaktifan', 'required|trim', ['required' => 'Nilai Keaktifan harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Tambah Nilai Siswa";
            $data['data_siswa'] = $this->Siswa->getAllSiswa();
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('nilai_siswa/tambah_nilai_siswa');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'akademik' => $this->input->post('akademik'),
               'sikap' => $this->input->post('sikap'),
               'keaktifan' => $this->input->post('keaktifan'),
               'id_siswa' => $this->input->post('id_siswa'),
            ];

            $this->Nilai_Siswa->insert($data);

            $this->session->set_flashdata('success_alert', 'Nilai siswa berhasil ditambah!');
            redirect('nilai_siswa');
         }
      }
   }

   public function hapus_nilai_siswa($id)
   {
      # code...
      $this->Nilai_Siswa->deleteNilaiSiswa($id);
      $this->session->set_flashdata('success_alert', 'Nilai siswa berhasil dihapus!');
      redirect('nilai_siswa');
   }

   public function edit_nilai_siswa($id_nilai_siswa)
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
         $data['nilai_siswa'] = $this->Nilai_Siswa->getNilaiSiswaByID($id_nilai_siswa);

         $this->form_validation->set_rules('akademik', 'Nilai Akademik', 'required|trim', ['required' => 'Nilai Akademik harus diisi']);
         $this->form_validation->set_rules('sikap', 'Nilai Sikap', 'required|trim', ['required' => 'Nilai Sikap harus diisi']);
         $this->form_validation->set_rules('keaktifan', 'Nilai Keaktifan', 'required|trim', ['required' => 'Nilai Keaktifan harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Edit Nilai Siswa";
            $data['data_siswa'] = $this->Siswa->getAllSiswa();
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('nilai_siswa/edit_nilai_siswa');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'akademik' => $this->input->post('akademik'),
               'sikap' => $this->input->post('sikap'),
               'keaktifan' => $this->input->post('keaktifan'),
               'id_siswa' => $this->input->post('id_siswa'),
            ];

            $this->Nilai_Siswa->insert($data);

            $this->session->set_flashdata('success_alert', 'Nilai siswa berhasil diedit!');
            redirect('nilai_siswa');
         }
      }
   }

   public function accessBlocked()
   {
      $this->load->view('auth/blocked');
   }
}
