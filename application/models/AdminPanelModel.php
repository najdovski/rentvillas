<?php
  class AdminPanelModel extends CI_Model{
    public function __construct(){
      parent:: __construct();
    }

    public function removeUser($personID){
      $this->db->query("
      DELETE FROM Person
      WHERE Person_ID = $personID
      ");
    }


    public function getAllUsers(){
      $query = $this->db->query("
      SELECT * FROM Person
      ");

      return $query->result_array();
    }

    public function getUserDetails($personID){
      $query = $this->db->query("
      SELECT * FROM Person
      WHERE Person_ID = $personID
      ");

      return $query->result_array();
    }

    public function saveChanges($personID, $username, $email, $password, $admin){
      $this->db->query("
      UPDATE Person
      SET Name = '$username',
      Email = '$email',
      Password = '$password',
      Admin = $admin
      WHERE Person_ID = $personID
      ");
    }

    public function getIslands(){
      $query = $this->db->query("
      SELECT * FROM Islands
      ");

      $query = $query->result_array();
      return $query;
    }

    public function getAmenities(){
      $query = $this->db->query("
      SELECT * FROM Amenities
      ORDER BY Amenity_ID DESC"
    );

      $query = $query->result_array();
      return $query;
    }

    public function insertVilla($name, $location, $maxPax, $adults, $children, $bathrooms, $bedrooms, $poolType, $island, $amenities, $availableFrom, $availableTo, $price){


      // //getting the position from $availableFrom      
      // $datePartsAF = explode('-', $availableFrom);
      // $yearAF = $datePartsAF[0];
      // $monthAF = $datePartsAF[1];
      // $dayAF = $datePartsAF[2];
      
      // $startTimeStampAF = strtotime("$yearAF/01/01");
      // $endTimeStampAF = strtotime("$yearAF/$monthAF/$dayAF");
      // $timeDiffAF = abs($endTimeStampAF - $startTimeStampAF);
      // $availableFromString = ($timeDiffAF/86400);
      
      // //getting the position from $availableTo
      // $datePartsAT = explode('-', $availableTo);
      // $yearAT = $datePartsAT[0];
      // $monthAT = $datePartsAT[1];
      // $dayAT = $datePartsAT[2];
      
      // $startTimeStampAT = strtotime("$yearAT/01/01");
      // $endTimeStampAT = strtotime("$yearAT/$monthAT/$dayAT");
      // $timeDiffAT = abs($endTimeStampAT - $startTimeStampAT);
      // $availableToString = ($timeDiffAT/86400);
      
      // //generating the new string
      // $theString = '0';
      // for ($i=1; $i<365; $i++){
      //  $theString .= '0'; 
      // }
      
      // //changing the values from 0 to 1 based on the positions (FROM and TO)
      // // $theString[$availableFromString] = 1;
      // // $theString[$availableToString] = 1;

      // //changing the zeros to 1 (ALL FROM DATEFROM TO DATETO)
      // for ($i=$availableFromString; $i<=$availableToString; $i++){
      //   $theString[$i] = '1';
      //  }   


      //TRANSACTION START
      // $this->db->trans_start();

      //Properties query
      $this->db->query("
      INSERT INTO Properties (Prop_Name, Location, Max_Pax, Adults, Children, Bathrooms, Bedrooms, Pool_Type_ID, Island_ID)
      VALUES ('$name', '$location', $maxPax, $adults, $children, $bathrooms, $bedrooms, $poolType, $island)
      ");
      
      $lastID = $this->db->insert_id();

      //Amenities query
      foreach($amenities as $singleAmenity){
      $this->db->query("
      INSERT INTO Prop_Amenities (Prop_ID, Amenity_ID)
      VALUES ($lastID, $singleAmenity)
      ");
      }


      $theString = '';
      for ($i=0; $i<=366; $i++){
        $theString .= '0';
      }

      $currentYear = date('Y');
      //Availability query
      $this->db->query("
      INSERT INTO Availability (Prop_ID, Year, Availability_String) VALUES
      ($lastID, $currentYear, '$theString')
      ");

      //Price query
      $this->db->query("
      INSERT INTO Prices (Prop_ID, From_Date, To_Date, Price)
      VALUES
      ($lastID, '$availableFrom', '$availableTo', $price)
      ");
    
      // $this->db->trans_complete();
      //TRANSACTION END

    }

    public function addNewCountry($countryName){
      $this->db->query("
      INSERT INTO Countries (Country_Name)
      VALUES ('$countryName')
      ");
    }

    public function getCountries(){
      return $this->db->query("
      SELECT * FROM Countries
      ")->result_array();
    }

    public function addNewRegion($regionName, $countryID){
      $this->db->query("
      INSERT INTO Regions (Region_Name, Country_ID)
      VALUES ('$regionName', $countryID)
      ");
    }

    public function getRegions(){
      return $this->db->query("
      SELECT * FROM Regions
      ")->result_array();
    }

    public function addNewIsland($islandName, $regionID){
      $this->db->query("
      INSERT INTO Islands (Island_Name, Region_ID)
      VALUES ('$islandName', $regionID)
      ");
    }

    public function addNewAmenity($newAmenity){
      $this->db->query("
      INSERT INTO Amenities (Amenity_Name)
      VALUES ('$newAmenity')
      ");
    }
  }
?>