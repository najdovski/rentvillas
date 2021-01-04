<?php
  class Calendar extends CI_Controller{
    public function __construct(){
      parent:: __construct();
      $this->load->model('CalendarModel');
    }

    public function book($propID = null, $personID = null, $year = null, $month = null){
      $this->CalendarModel->updateAvailability();
      $this->CalendarModel->init($propID, $personID);

      if (!isset($year) && !isset($month)){
        $year = 2019;
        $month = 11;
      }
      
      $dayFrom = intval($this->input->post('dayFrom'));
      $dayTo = intval($this->input->post('dayTo'));
      
      $saveTheBooking = $this->input->post('saveTheBooking');
      if ($saveTheBooking == TRUE){
      $price = $this->CalendarModel->getThePrice($propID, $year, $month, $dayFrom, $dayTo);
      $this->CalendarModel->saveBooking($dayFrom, $dayTo, $year, $month, $propID, $personID, $price);
      }

      $data['title'] = 'Booking Calendar';      
      $data['calendar'] = $this->CalendarModel->generate($propID, $personID, $year, $month);

      $this->load->view('inc/header', $data);
      $this->load->view('pages/calendar', $data);
      $this->load->view('inc/footer');
    }


    public function cancelBooking($propID, $personID){
      $this->CalendarModel->cancelBooking($propID, $personID);
      header('Location:login/validation');
    }
  }

?>