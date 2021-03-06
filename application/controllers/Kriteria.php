<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
      $this->load->model('Kriteria_model', 'Kriteria');
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
         $data['kriteriaa'] = $this->Kriteria->getAllKriteria();
         $data['title'] = "Kriteria";

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/admin_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('kriteria/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function tambah_kriteria()
   {
      # code...
      if (!$this->session->userdata('loggedIn')) {
         redirect('user_auth');
      } else {
         if ($this->session->userdata('user_role') == 3) {
            redirect('home');
         }

         // get all user information from the database
         $kriteria_id = $this->session->userdata('id_kriteria');
         $username = $this->session->userdata('username');
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['kriteria_data'] = $this->Kriteria->getKriteriaByID($kriteria_id);

         $this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'required|trim', ['required' => 'Nama Kriteria harus diisi']);
         $this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'required|trim', ['required' => 'Kode Kriteria harus diisi']);
         $this->form_validation->set_rules('jenis_nilai', 'Jenis Nilai', 'required|trim', ['required' => 'Jenis Nilai harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Tambah Kriteria";
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('kriteria/tambah_kriteria');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_kriteria' => $this->input->post('nama_kriteria'),
               'kode_kriteria' => $this->input->post('kode_kriteria'),
               'jenis_nilai' => $this->input->post('jenis_nilai')
            ];

            $this->Kriteria->insert($data);

            $this->session->set_flashdata('success_alert', 'Kriteria berhasil ditambah!');
            redirect('kriteria');
         }
      }
   }

   public function hapus_kriteria($id)
   {
      # code...
      $this->Kriteria->deleteKriteria($id);
      $this->session->set_flashdata('success_alert', 'Kriteria berhasil dihapus!');
      redirect('kriteria');
   }

   public function edit_kriteria($kriteria_id)
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
         $nama_kriteria = $this->session->userdata('nama_kriteria');
         $data['user_data'] = $this->User->getUserByUsername($username);
         $data['kriteria_data'] = $this->Kriteria->getKriteriaByNmKriteria($nama_kriteria);

         $this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'required|trim', ['required' => 'Nama Kriteria harus diisi']);
         $this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'required|trim', ['required' => 'Kode Kriteria harus diisi']);
         $this->form_validation->set_rules('jenis_nilai', 'Jenis Nilai', 'required|trim', ['required' => 'Jenis Nilai harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Edit Kriteria";
            $data['kriteria'] = $this->Kriteria->getKriteriaByID($kriteria_id);
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('kriteria/edit_kriteria');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_kriteria' => $this->input->post('nama_kriteria'),
               'kode_kriteria' => $this->input->post('kode_kriteria'),
               'jenis_nilai' => $this->input->post('jenis_nilai'),
               'id_kriteria' => $kriteria_id
            ];

            $this->Kriteria->editKriteriaData($data);

            $this->session->set_flashdata('success_alert', 'Kriteria berhasil diedit!');
            redirect('kriteria');
         }
      }
   }
   public function accessBlocked()
   {
      $this->load->view('auth/blocked');
   }
}
