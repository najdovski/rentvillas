<?php
class Search extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('HomeModel');
    $this->load->helper('url_helper');
    $this->load->helper('form');
  }


  public function index($page = 'home')
  {
          if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
          {
                  //if the page doesn't exist
                  show_404();
          }
  
          $data['title'] = ucfirst($page); // Capitalize the first letter

          $this->load->model('HomeModel');
          $data['latestVillas'] = $this->HomeModel->latestVillas();

  
          $this->load->view('inc/header', $data);
          $this->load->view('pages/home', $data);
          $this->load->view('inc/footer');
  }

  public function search(){
    //load the model
    $this->load->model('SearchFormModel');

    $data['title'] = 'Search Results';


    $personsSearch = isset($_POST['personsSearch']) ? $_POST['personsSearch'] : 1;

    // $priceSearch = isset($_POST['priceSearch']) ? intval($_POST['priceSearch']) : 10000;
    if ((!isset($_POST['priceSearch']) || ($_POST['priceSearch']) == 0)){
      $priceSearch = 10000;
    } else {
      $priceSearch = intval($_POST['priceSearch']);
    }

    $whereSearch = isset($_POST['whereSearch']) ? $_POST['whereSearch'] : '';
   
   
    $data['searchResults'] = $this->SearchFormModel->searchResults($whereSearch, $personsSearch, $priceSearch);
    $data['locations'] = $this->SearchFormModel->getLocations();

    //populates the search by destination select options
    $data['countryNames'] = $this->SearchFormModel->getCountryNames();
    $data['islandNames'] = $this->SearchFormModel->getIslandNames();

    //prints the prices
    $data['printPrices'] = $this->SearchFormModel->getPrices();

    //max persons for populating data on the view
    $data['maxPersons'] = $this->SearchFormModel->getMaxPersons();

    $this->load->view('inc/header', $data);
    $this->load->view('pages/search', $data);
    $this->load->view('inc/footer');
  }

}