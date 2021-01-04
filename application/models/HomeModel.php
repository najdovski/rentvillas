<?php
  class HomeModel extends CI_Model{
    public function __construct(){
      parent::__construct();
      $this->load->database();
    }

    public function getCountries(){
      $query = $this->db->query('SELECT * FROM Countries');
      return $query->result_array();
    }

    public function latestVillas(){
      $query = $this->db->query("
      SELECT * FROM Properties
      JOIN Islands ON Islands.Island_ID = Properties.Island_ID
      JOIN Regions ON Regions.Region_ID = Islands.Region_ID
      JOIN Countries ON Countries.Country_ID = Regions.Country_ID
      ORDER BY Prop_ID DESC
      ");

      return $query->result_array();
    }
  }
?>