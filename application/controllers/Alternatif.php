<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
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

         // get all user information from the database
         $username = $this->session->userdata('username');
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['alt'] = $this->Alternatif->getAllAlternatif();
         $data['title'] = "Manage Alternatif";

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/admin_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('alternatif/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function tambah_alternatif()
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

         $this->form_validation->set_rules('nama_alternif', 'Nama Siswa', 'required|trim', ['required' => 'Nama Siswa harus diisi']);
         $this->form_validation->set_rules('nisn', 'NISN', 'required|trim', ['required' => 'NISN harus diisi']);
         $this->form_validation->set_rules('nis', 'NIS', 'required|trim', ['required' => 'NIS harus diisi']);
         $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', ['required' => 'Jenis Kelamin harus diisi']);
         $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi']);
         $this->form_validation->set_rules('no_telepon', 'Nomor Telp', 'required|trim', ['required' => 'Nomor Telp harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Tambah Alternatif";
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('alternatif/tambah_alternatif');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_alternatif' => $this->input->post('nama_alternatif'),
               'nisn' => $this->input->post('nisn'),
               'nis' => $this->input->post('nis'),
               'jenis_kelamin' => $this->input->post('jenis_kelamin'),
               'alamat' => $this->input->post('alamat'),
               'no_telepon' => $this->input->post('no_telepon'),
               'id_alternatif' => $this->input->post('id_alternatif')
            ];

            $this->Alternatif->insert($data);

            $this->session->set_flashdata('success_alert', 'Alternatif berhasil ditambah!');
            redirect('alternatif');
         }
      }
   }

   public function hapus_alternatif($id)
   {
      # code...
      $this->Alternatif->deleteAlternatif($id);
      $this->session->set_flashdata('success_alert', 'Alternatif berhasil dihapus!');
      redirect('alternatif');
   }

   public function edit_alternatif($id_alternatif)
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
         $nama_alternatif = $this->session->userdata('nama_alternatif');
         $data['alts']  = $this->Alternatif->getAlternatifByNmAlternatif($nama_alternatif);
         $data['user_data'] = $this->User->getUserByUsername($username);

         $this->form_validation->set_rules('nama_alternif', 'Nama Siswa', 'required|trim', ['required' => 'Nama Siswa harus diisi']);
         $this->form_validation->set_rules('nisn', 'NISN', 'required|trim', ['required' => 'NISN harus diisi']);
         $this->form_validation->set_rules('nis', 'NIS', 'required|trim', ['required' => 'NIS harus diisi']);
         $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', ['required' => 'Jenis Kelamin harus diisi']);
         $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi']);
         $this->form_validation->set_rules('no_telepon', 'Nomor Telp', 'required|trim', ['required' => 'Nomor Telp harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Edit Alternatif";
            $data['alt'] = $this->Alternatif->getAlternatifByID($id_alternatif);
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('alternatif/edit_alternatif');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_alternatif' => $this->input->post('nama_alternatif'),
               'nisn' => $this->input->post('nisn'),
               'nis' => $this->input->post('nis'),
               'jenis_kelamin' => $this->input->post('jenis_kelamin'),
               'alamat' => $this->input->post('alamat'),
               'no_telepon' => $this->input->post('no_telepon'),
               'id_alternatif' => $id_alternatif
            ];

            $this->Alternatif->editAlternatifData($data);

            $this->session->set_flashdata('success_alert', 'Alternatif berhasil diedit!');
            redirect('alternatif');
         }
      }
   }

   public function accessBlocked()
   {
      $this->load->view('auth/blocked');
   }
}
