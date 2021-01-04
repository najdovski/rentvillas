<?php
  class Register extends CI_Controller{
    public function __construct(){
      parent:: __construct();
      $this->load->library('form_validation');
      $this->load->library('encryption');
      $this->load->model('RegisterModel');
    }

    public function index(){
      $data['title'] = 'Register Page';
      $data['successfull'] = null;
      $this->load->view('inc/header', $data);
      $this->load->view('pages/register', $data);
      $this->load->view('inc/footer');
    }

    public function validation(){
      $this->form_validation->set_rules('username', 'Name', 'required|trim|is_unique[Person.Name]');
      $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[Person.Email]', '');
      $this->form_validation->set_rules('password', 'Password', 'required');
      

      if ($this->form_validation->run()){
          $username = $this->input->post('username');
          $email = $this->input->post('email');
          $password = md5(($this->input->post('password')));

          $this->RegisterModel->insert($username, $email, $password);

          $data['successfull'] = 'The registration of the user "' . $username . '" was successfull. You can now log in';
          $data['title'] = 'Registration Successfull';
          $this->load->view('inc/header', $data);
          $this->load->view('pages/register', $data);
          $this->load->view('inc/footer');


      } else {
        $data['validationErrors'] = validation_errors();
        $data['title'] = 'Validation Errors';
        $data['successfull'] = null;
        $this->load->view('inc/header', $data);
        $this->load->view('pages/register', $data);
        $this->load->view('inc/footer');
      }
    }
  }
?>