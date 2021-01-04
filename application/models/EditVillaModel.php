<?php
  class EditVillaModel extends CI_Model{
    public function __construct(){
      $this->load->database();
    }

    public function villaProps($propID){
      $queryProps = $this->db->query("
        SELECT * FROM Properties
        JOIN Islands ON Islands.Island_ID = Properties.Island_ID
        JOIN Regions ON Regions.Region_ID = Islands.Region_ID
        JOIN Countries ON Countries.Country_ID = Regions.Country_ID
        JOIN Pool_Types ON Pool_Types.Pool_Type_ID = Properties.Pool_Type_ID
        LEFT JOIN Bookings ON Bookings.Prop_ID = Properties.Prop_ID
        WHERE Properties.Prop_ID = $propID
      ");
      return $queryProps = $queryProps->result_array();
    }

    public function getIslands($propID){
      $query = $this->db->query("
      SELECT * FROM Properties
      JOIN Islands ON Islands.Island_ID = Properties.Island_ID
      JOIN Regions ON Regions.Region_ID = Islands.Region_ID
      JOIN Countries ON Countries.Country_ID = Regions.Country_ID
      WHERE NOT Prop_ID = $propID
      ");

      return $query->result_array();
    }

    public function getAmenities($propID){
      $query = $this->db->query("
      SELECT * FROM Amenities
      JOIN Prop_Amenities ON Prop_Amenities.Amenity_ID = Amenities.Amenity_ID
      JOIN Properties ON Properties.Prop_ID = Prop_Amenities.Prop_Id
      WHERE Properties.Prop_ID = $propID
      ");

      return $query->result_array();
    }

    public function getAllAmenities(){
      $query = $this->db->query("
      SELECT * FROM Amenities
      ");

      return $query->result_array();
    }

    public function getPrices($propID){
      $query = $this->db->query("
      SELECT * FROM Prices
      WHERE Prop_ID = $propID");

      return $query->result_array();
    }

    public function updateTables($propID, $name, $location, $maxPax, $adults, $children, $bathrooms, $bedrooms, $poolType, $island, $amenities, $from, $to, $price){
      $this->db->query("
      UPDATE Properties
      SET Prop_Name = '$name',
      Location = '$location',
      Max_Pax = $maxPax,
      Adults = $adults,
      Children = $children,
      Bathrooms = $bathrooms,
      Bedrooms = $bedrooms,
      Pool_Type_ID = $poolType,
      Island_ID = $island
      WHERE Prop_ID = $propID
      ");


      $this->db->query("
      DELETE FROM Prop_Amenities
      WHERE Prop_ID = $propID
      ");

      foreach($amenities as $amenity){
        $this->db->query("
        INSERT INTO Prop_Amenities (Amenity_ID, Prop_ID)
        VALUES ($amenity, $propID)
        ");
      }


      $this->db->query("
      DELETE FROM Prices
      WHERE Prop_ID = $propID
      ");

      for ($i=0; $i<count($from); $i++){
        $fromNew = $from[$i];
        $toNew = $to[$i];
        $priceNew = $price[$i];

        $this->db->query("
        INSERT INTO Prices (Prop_ID, From_Date, To_Date, Price)
        VALUES ($propID, '$fromNew', '$toNew', $priceNew)
        ");
      }


      // $from = new ArrayIterator($from);
      // $to = new ArrayIterator($to);
      // $price = new ArrayIterator($price);

      // $fromToPrice = new MultipleIterator();
      // $fromToPrice->attachIterator($from);
      // $fromToPrice->attachIterator($to);
      // $fromToPrice->attachIterator($price);

      // foreach ($fromToPrice as $values){
      //   for ($i=0; $i<count($from); $i++){
      //     $this->db->query("
      //     INSERT INTO Prices (Prop_ID, From_Date, To_Date, Price)
      //     VALUES ($propID, '$values[$i]', '$values[$i]', $values[$i])
      //     ");
      //     }
      // }
    
    }

    public function removeVilla($propID){
      $this->db->query("
      DELETE FROM Availability
      WHERE Prop_ID = $propID
      ");

      $this->db->query("
      DELETE FROM Prop_Amenities
      WHERE Prop_ID = $propID
      ");

      $this->db->query("
      DELETE FROM Prices
      WHERE Prop_ID = $propID
      ");

      $this->db->query("
      DELETE FROM Properties
      WHERE Prop_ID = $propID
      ");
    }
  }
?>