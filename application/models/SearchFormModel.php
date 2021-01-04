<?php
class SearchFormModel extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function searchResults($whereSearch, $personsSearch, $priceSearch){ 
    
    $query = $this->db->query("
    SELECT Properties.Prop_ID, Properties.Prop_Name, MIN(Price), Properties.Location, Islands.Island_Name, Countries.Country_Name, Properties.Max_Pax, Properties.Bathrooms, Properties.Bedrooms, Pool_Types.Pool_Type_String
    FROM Properties
    JOIN Pool_Types ON Pool_Types.Pool_Type_ID = Properties.Pool_Type_ID
    JOIN Islands ON Islands.Island_ID = Properties.Island_ID
    JOIN Regions ON Regions.Region_ID = Islands.Region_ID
    JOIN Countries ON Countries.Country_ID = Regions.Country_ID
    JOIN Prices on Prices.Prop_ID = Properties.Prop_ID
    WHERE
    (Countries.Country_Name LIKE '%$whereSearch%' OR Regions.Region_Name LIKE '%$whereSearch%' OR Properties.Prop_Name LIKE '%$whereSearch%')
    AND Properties.Max_Pax >= $personsSearch
    AND Price < $priceSearch
	  GROUP BY Properties.Prop_ID, Properties.Prop_Name, Properties.Location, Islands.Island_Name, Countries.Country_Name, Properties.Max_Pax, Properties.Bathrooms, Properties.Bedrooms, Pool_Types.Pool_Type_String
    ORDER BY Properties.Prop_ID DESC
    ");

    return $query->result_array();   
  }

  public function getPrices(){

    $query = $this->db->query("
    SELECT Prop_ID, MIN(Price)
    FROM Prices
    GROUP BY Prop_ID
    ");
    return $query->result_array();
  }

  public function getLocations(){
    $query = $this->db->query("
    SELECT Country_Name, Region_Name, Countries.Country_ID, Region_ID
    FROM Countries
    JOIN Regions ON Regions.Country_ID = Countries.Country_ID
    ");


    return $query->result_array();
  }

  public function getMaxPersons(){
    $query = $this->db->query("
    SELECT DISTINCT Max_Pax
    FROM Properties
    ");
    return $query->result_array();
  }

  public function getCountryNames(){
    $query = $this->db->query("
    SELECT Country_ID, Country_Name
    FROM Countries
    ");
    return $query->result_array();
  }
  

  public function getIslandNames(){
    $query = $this->db->query("
    SELECT Region_ID, Island_Name
    FROM Islands
    ");

    return $query->result_array();
  }

}
?>