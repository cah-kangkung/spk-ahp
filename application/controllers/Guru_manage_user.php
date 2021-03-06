<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_manage_user extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('User_model', 'User');
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
         $data['users'] = $this->User->getAllUser();
         $data['title'] = "Manage User";

         $this->load->view('templates/admin_headbar', $data);
         $this->load->view('templates/guru_sidebar');
         $this->load->view('templates/admin_topbar');
         $this->load->view('admin_user_guru/index');
         $this->load->view('templates/admin_footer');
      }
   }

   public function tambah_user_guru()
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

         $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username harus diisi']);
         $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Tambah User";
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_user_guru/tambah_user_guru');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'username' => $this->input->post('username'),
               'password' => $this->input->post('password'),
               'role' => $this->input->post('role')
            ];

            $this->User->insert($data);

            $this->session->set_flashdata('success_alert', 'User berhasil ditambah!');
            redirect('guru_manage_user');
         }
      }
   }

   public function hapus_user_guru($id)
   {
      # code...
      $this->User->deleteUser($id);
      $this->session->set_flashdata('success_alert', 'User berhasil dihapus!');
      redirect('guru_manage_user');
   }

   public function edit_user_guru($id)
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

         $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username harus diisi']);
         $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus diisi']);

         if ($this->form_validation->run() == false) {
            $data['title'] = "Admin|Edit User";
            $data['user'] = $this->User->getUserByID($id);
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/guru_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_user_guru/edit_user_guru');
            $this->load->view('templates/admin_footer');
         } else {
            $data = [
               'username' => $this->input->post('username'),
               'password' => $this->input->post('password'),
               'role' => $this->input->post('role'),
               'id_user' => $id
            ];

            $this->User->editUserData($data);

            $this->session->set_flashdata('success_alert', 'User berhasil diedit!');
            redirect('guru_manage_user');
         }
      }
   }

   public function accessBlocked()
   {
      $this->load->view('auth/blocked');
   }
}
