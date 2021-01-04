<?php
  class EditVilla extends CI_Controller{
    public function __construct(){
      parent:: __construct();
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->model('EditVillaModel');
      $this->load->helper('url');
    }

    public function index($propID){
      if(isset($_SESSION['admin'])){
        $data['title'] = 'Edit Villa';
        $data['villaProps'] = $this->EditVillaModel->villaProps($propID);
        $data['islands'] = $this->EditVillaModel->getIslands($propID);
        $data['amenities'] = $this->EditVillaModel->getAmenities($propID);
        $data['allAmenities'] = $this->EditVillaModel->getAllAmenities();
        $data['prices'] = $this->EditVillaModel->getPrices($propID);
        
        $this->load->view('inc/header', $data);
        $this->load->view('pages/editVilla', $data);
        $this->load->view('inc/footer');
      } else {
        header('Location: /codeigniter');
      }
    }

    public function saveChanges($propID){
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



      if ($this->form_validation->run()){
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
        $from = $this->input->post('from[]');
        $to = $this->input->post('to[]');
        $price = $this->input->post('price[]');

        $this->EditVillaModel->updateTables($propID, $name, $location, $maxPax, $adults, $children, $bathrooms, $bedrooms, $poolType, $island, $amenities, $from, $to, $price);


        $this->session->set_flashdata('changesSaved', 'Changes Saved');
        $this->index($propID);

      } else {
        $data['title'] = 'Check the fields';
        $data['validationErrors'] = validation_errors();

        $this->index($propID);
      }
    }

    public function removeVilla($propID){
        $this->EditVillaModel->removeVilla($propID);

        $this->session->set_flashdata('villaRemoved', 'The villa was removed successfully');
        header('Location:/codeigniter');
    }
  }
?>