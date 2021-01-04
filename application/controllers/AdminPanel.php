<?php
  class AdminPanel extends CI_Controller{
    public function __construct(){
      parent:: __construct();
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->model('AdminPanelModel');
      $this->load->database();
    }

    public function index(){
      if(isset($_SESSION['admin'])){
        
        $data['title'] = 'Admin Panel';
        $data['allUsers'] = $this->AdminPanelModel->getAllUsers();

        $data['islands'] = $this->AdminPanelModel->getIslands();
        $data['amenities'] = $this->AdminPanelModel->getAmenities();

        $data['countries'] = $this->AdminPanelModel->getCountries();
        $this->load->view('inc/header', $data);
        $this->load->view('pages/adminPanel', $data);
        $this->load->view('inc/footer');
      } else {
        header('Location: /codeigniter');
      }
    }

    public function newVilla(){


      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('location', 'Location', 'required');
      $this->form_validation->set_rules('maxPax', 'Maximum Capacity', 'required|numeric');
      $this->form_validation->set_rules('adults', 'Adults', 'required|numeric');
      $this->form_validation->set_rules('children', 'Children', 'numeric');
      $this->form_validation->set_rules('bathrooms', 'Bathrooms', 'required|numeric');
      $this->form_validation->set_rules('bedrooms', 'Bedrooms', 'required|numeric');
      $this->form_validation->set_rules('poolType', 'Pool Type', 'numeric');
      $this->form_validation->set_rules('island', 'Island', 'required|numeric');
      $this->form_validation->set_rules('amenities[]', 'Amenities', 'required');
      $this->form_validation->set_rules('availableFrom', 'Available From', 'required');
      $this->form_validation->set_rules('availableTo', 'Available To', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required|numeric');


      if ($this->form_validation->run())
        {
               //success page

               $name = $this->input->post('name');
               $location = $this->input->post('location');
               $maxPax = intval($this->input->post('maxPax'));
               $adults = intval($this->input->post('adults'));
               $children = intval($this->input->post('children'));
               $bathrooms = intval($this->input->post('bathrooms'));
               $bedrooms = intval($this->input->post('bedrooms'));
               $poolType = intval($this->input->post('poolType'));
               $island = intval($this->input->post('island'));
               $amenities = $this->input->post('amenities[]');
               $availableFrom = $this->input->post('availableFrom');
               $availableTo = $this->input->post('availableTo');
               $price = intval($this->input->post('price'));

              
              $this->AdminPanelModel->insertVilla($name, $location, $maxPax, $adults, $children, $bathrooms, $bedrooms, $poolType, $island, $amenities, $availableFrom, $availableTo, $price);

             
              $this->session->set_flashdata('villaAdded', 'The new villa has been added successfully');
              header('Location:/codeigniter');

               
        }
        else
        {
              //error page
           
              $data['title'] = 'Check the fields';
              $data['validationErrors'] = validation_errors();
      
              $this->load->view('inc/header', $data);
              $this->load->view('pages/adminPanel', $data);
              $this->load->view('inc/footer');
        }


    }

    public function editUser($personID){
      $data['title'] = 'Edit User';
      $data['users'] = $this->AdminPanelModel->getUserDetails($personID);
      $this->load->view('inc/header', $data);
      $this->load->view('pages/editUser', $data);
      $this->load->view('inc/footer');

    }


    public function saveUserChanges(){

      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('admin', 'Admin Role', 'required');

      $personID = $this->input->post('personID');
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $password = md5($this->input->post('password'));
      $admin = $this->input->post('admin');


      if ($this->form_validation->run()){
          $this->AdminPanelModel->saveChanges($personID, $username, $email, $password, $admin);
          $this->index();  
      } else {
          $data['title'] = 'Check the fields';
          $data['validationErrors'] = validation_errors();

          $this->editUser($personID);
      } 
    }


    public function removeUser($personID){
      $this->AdminPanelModel->removeUser($personID);
      $this->index();
    }


    public function newCountry(){
      $countryName = $this->input->post('countryName');
      $this->AdminPanelModel->addNewCountry($countryName);
    }

    public function getCountries(){
      $countries = $this->AdminPanelModel->getCountries();
      echo json_encode($countries);
    }

    public function newRegion(){
      $regionName = $this->input->post('regionName');
      $countryID = $this->input->post('countryID');
      $this->AdminPanelModel->addNewRegion($regionName, $countryID);
    }

    public function getRegions(){
      $regions = $this->AdminPanelModel->getRegions();
      echo json_encode($regions);
    }

    public function newIsland(){
      $islandName = $this->input->post('islandName');
      $regionID = $this->input->post('regionID');
      $this->AdminPanelModel->addNewIsland($islandName, $regionID);
    }

    public function newAmenity(){
      $newAmenity = $this->input->post('newAmenity');
      $this->AdminPanelModel->addNewAmenity($newAmenity);
    }

    public function getAmenities(){
      $amenities = $this->AdminPanelModel->getAmenities();
      echo json_encode($amenities);
    }
  }
?>