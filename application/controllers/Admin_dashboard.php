<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 3) {
                redirect('home');
            }

            $this->load->model('User_model', 'User');
            $this->load->model('Siswa_model', 'Siswa');
            $data['title'] = "Dashboard";

            // get all user information from the database
            $username = $this->session->userdata('username');
            $data['user_data'] = $this->User->getUserByUsername($username);
            $siswa = $this->Siswa->getAllSiswa();
            $data['total_siswa'] = $this->Siswa->countSiswa($siswa);


            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_dashboard/index');
            $this->load->view('templates/admin_footer');
        }
    }
}
