<?php
  class Login extends CI_Controller{
    public function __construct(){
      parent:: __construct();
      $this->load->library('form_validation');
      $this->load->model('LoginModel');
    }

    public function index(){

      if (isset($_SESSION['loggedIn'])){
        $data['title'] = 'User Panel';
        $user = $_SESSION['username'];
        $data['upcomingTrips'] = $this->LoginModel->upcomingTrips($user);
        $this->session->set_flashdata('alreadyLoggedIn', 'You are already logged in');
        $this->load->view('inc/header', $data);
        $this->load->view('pages/userPanel', $data);
        $this->load->view('inc/footer');
      } else {

      $data['title'] = 'Login Page';
      $data['validationErrors'] = null;
      $this->load->view('inc/header', $data);
      $this->load->view('pages/login', $data);
      $this->load->view('inc/footer');
      }
      
    }

    public function validation(){
      $this->form_validation->set_rules('username', 'Username', 'required|trim');
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->run();

        
        $username = $this->input->post('username');
        $password = md5($this->input->post('password')); 
        
        if (($this->LoginModel->get($username, $password)) == true){
          $data['title'] = 'User Panel';
          $user = $_SESSION['username'];
          $data['upcomingTrips'] = $this->LoginModel->upcomingTrips($user);
          $this->load->view('inc/header', $data);
          $this->load->view('pages/userPanel', $data);
          $this->load->view('inc/footer');
        }

        else if (isset($_SESSION['loggedIn'])){
          $data['title'] = 'User Panel';
          $user = $_SESSION['username'];
          $data['upcomingTrips'] = $this->LoginModel->upcomingTrips($user);
          // $this->session->set_flashdata('alreadyLoggedIn', 'You are already logged in');
          $this->load->view('inc/header', $data);
          $this->load->view('pages/userPanel', $data);
          $this->load->view('inc/footer');
        }
        
         else {
          $data['title'] = 'Wrong Credentials';
          $data['validationErrors'] = 'Cannot log in. Wrong credentials.';
          $this->load->view('inc/header', $data);
          $this->load->view('pages/login', $data);
          $this->load->view('inc/footer');
        }
    }

    public function logout(){
      session_destroy();
      $this->session->set_flashdata('loggedOut', 'You have succesfuly logged out');
      $data['title'] = 'Login Page';
      $data['validationErrors'] = null;
      $this->load->view('inc/header', $data);
      $this->load->view('pages/login', $data);
      $this->load->view('inc/footer');
    }
  }
?>