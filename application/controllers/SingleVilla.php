<?php
  class SingleVilla extends CI_Controller{

    public function __construct(){
      parent:: __construct();
    }

    public function show($propID){
      $this->load->model('SingleVillaModel');

      $data['showVilla'] = $this->SingleVillaModel->getSingleVilla($propID);
      $data['showAmenities'] = $this->SingleVillaModel->getAmenities($propID);
      $data['showAvailable'] = $this->SingleVillaModel->getAvailability($propID);
      $data['showPrice'] = $this->SingleVillaModel->getPrices($propID);



      $data['title'] = 'Single Villa';

      if (isset($_SESSION['personID'])){
      $personID = $_SESSION['personID'];
      $data['getUser'] = $this->SingleVillaModel->getUser($personID);
      }
      
      $this->load->view('inc/header', $data);
      $this->load->view('pages/singleVilla', $data);

      $this->load->view('inc/footer');
    }

  }
?>