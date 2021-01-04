<?php
  class SingleVillaModel extends CI_Model{
    public function __construct(){
      parent::__construct();
      $this->load->database();
    }

    public function getSingleVilla($propID){
      $query = $this->db->query("
      SELECT DISTINCT
      Properties.Prop_ID, Prop_Name, Location, Max_Pax, Adults, Children, Bathrooms, Bedrooms, Pool_Type_String, Island_Name, Region_Name, Country_Name
      FROM Properties
      JOIN Pool_Types ON Pool_Types.Pool_Type_ID = Properties.Pool_Type_ID
      JOIN Islands ON Islands.Island_ID = Properties.Island_ID
      JOIN Regions ON Regions.Region_ID = Islands.Region_ID
      JOIN Countries ON Countries.Country_ID = Regions.Country_ID
      JOIN Availability ON Availability.Prop_ID = Properties.Prop_ID
      WHERE Properties.Prop_ID=$propID
    ");

      return $query->result_array();
    }

    public function getAmenities($propID){
      $query = $this->db->query("
      SELECT DISTINCT
      Properties.Prop_ID, Amenity_Name
      FROM Properties
      JOIN Prop_Amenities ON Prop_Amenities.Prop_ID = Properties.Prop_ID
      JOIN Amenities ON Amenities.Amenity_ID = Prop_Amenities.Amenity_ID
      WHERE Properties.Prop_ID=$propID
      ");

      return $query->result_array();
    }


    public function getAvailability($propID){
      $query = $this->db->query("
      SELECT DISTINCT
      Properties.Prop_ID, Availability_String
      FROM Properties
      JOIN Availability ON Availability.Prop_ID = Properties.Prop_ID
      WHERE Properties.Prop_ID=$propID
      ");

      return $query->result_array();
    }

    public function getPrices($propID){

      $query = $this->db->query("
      SELECT DISTINCT *
      FROM Properties
      JOIN Prices ON Prices.Prop_ID = Properties.Prop_ID
      WHERE Properties.Prop_ID=$propID
      ");
      return $query->result_array();
    }


    public function getUser($personID){
      return $this->db->query("
      SELECT * FROM Person
      WHERE Person_ID = $personID
      ")->result_array();
    }
  }



/*
Amenity_Name, Availability_String, Price vo posebni metodi za nested foreach so if
      
*/

?>