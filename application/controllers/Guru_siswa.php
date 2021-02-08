<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_siswa extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
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
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['siswa'] = $this->Siswa->getAllSiswa();
         $data['title'] = "Manage Siswa";

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/guru_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('guru_siswa/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function tambah_siswa_guru()
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

         $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim', ['required' => 'Nama Siswa harus diisi']);
         $this->form_validation->set_rules('nisn', 'NISN', 'required|trim', ['required' => 'NISN harus diisi']);
         $this->form_validation->set_rules('nis', 'NIS', 'required|trim', ['required' => 'NIS harus diisi']);
         $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', ['required' => 'Jurusan harus diisi']);
         $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', ['required' => 'Jenis Kelamin harus diisi']);
         $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi']);
         $this->form_validation->set_rules('no_telepon', 'Nomor Telp', 'required|trim', ['required' => 'Nomor Telp harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Tambah Siswa";
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('guru_siswa/tambah_siswa_guru');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_siswa' => $this->input->post('nama_siswa'),
               'nisn' => $this->input->post('nisn'),
               'nis' => $this->input->post('nis'),
               'jurusan' => $this->input->post('jurusan'),
               'jenis_kelamin' => $this->input->post('jenis_kelamin'),
               'alamat' => $this->input->post('alamat'),
               'no_telepon' => $this->input->post('no_telepon'),
               'id_siswa' => $this->input->post('id_siswa')
            ];

            $this->Siswa->insert($data);

            $this->session->set_flashdata('success_alert', 'Siswa berhasil ditambah!');
            redirect('Guru_siswa');
         }
      }
   }

   public function hapus_siswa_guru($id)
   {
      # code...
      $this->Siswa->deleteSiswa($id);
      $this->session->set_flashdata('success_alert', 'Siswa berhasil dihapus!');
      redirect('Guru_siswa');
   }

   public function edit_siswa_guru($id_siswa)
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
         $nama_siswa = $this->session->userdata('nama_siswa');
         $data['siswa']  = $this->Siswa->getSiswaByNmSiswa($nama_siswa);
         $data['user_data'] = $this->User->getUserByUsername($username);

         $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim', ['required' => 'Nama Siswa harus diisi']);
         $this->form_validation->set_rules('nisn', 'NISN', 'required|trim', ['required' => 'NISN harus diisi']);
         $this->form_validation->set_rules('nis', 'NIS', 'required|trim', ['required' => 'NIS harus diisi']);
         $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim', ['required' => 'Jurusan harus diisi']);
         $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', ['required' => 'Jenis Kelamin harus diisi']);
         $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi']);
         $this->form_validation->set_rules('no_telepon', 'Nomor Telp', 'required|trim', ['required' => 'Nomor Telp harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Edit Siswa";
            $data['alt'] = $this->Siswa->getSiswaByID($id_siswa);
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('guru_siswa/edit_siswa_guru');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_siswa' => $this->input->post('nama_siswa'),
               'nisn' => $this->input->post('nisn'),
               'nis' => $this->input->post('nis'),
               'jurusan' => $this->input->post('jurusan'),
               'jenis_kelamin' => $this->input->post('jenis_kelamin'),
               'alamat' => $this->input->post('alamat'),
               'no_telepon' => $this->input->post('no_telepon'),
               'id_siswa' => $id_siswa
            ];

            $this->Siswa->editSiswaData($data);

            $this->session->set_flashdata('success_alert', 'Siswa berhasil diedit!');
            redirect('guru_siswa');
         }
      }
   }

   public function accessBlocked()
   {
      $this->load->view('auth/blocked');
   }
}
