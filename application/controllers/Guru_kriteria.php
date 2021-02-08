<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_kriteria extends CI_Controller
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
         $this->load->view('templates/guru_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('Guru_kriteria/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function tambah_kriteria_guru()
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

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Tambah Kriteria";
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('Guru_kriteria/tambah_kriteria_guru');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_kriteria' => $this->input->post('nama_kriteria'),
               'kode_kriteria' => $this->input->post('kode_kriteria')
            ];

            $this->Kriteria->insert($data);

            $this->session->set_flashdata('success_alert', 'Kriteria berhasil ditambah!');
            redirect('Guru_kriteria');
         }
      }
   }

   public function hapus_kriteria_guru($id)
   {
      # code...
      $this->Kriteria->deleteKriteria($id);
      $this->session->set_flashdata('success_alert', 'Kriteria berhasil dihapus!');
      redirect('Guru_kriteria');
   }

   public function edit_kriteria_guru($kriteria_id)
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

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Edit Kriteria";
            $data['kriteria'] = $this->Kriteria->getKriteriaByID($kriteria_id);
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('Guru_kriteria/edit_kriteria_guru');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'nama_kriteria' => $this->input->post('nama_kriteria'),
               'kode_kriteria' => $this->input->post('kode_kriteria'),
               'id_kriteria' => $kriteria_id
            ];

            $this->Kriteria->editKriteriaData($data);

            $this->session->set_flashdata('success_alert', 'Kriteria berhasil diedit!');
            redirect('Guru_kriteria');
         }
      }
   }
   public function accessBlocked()
   {
      $this->load->view('auth/blocked');
   }
}
