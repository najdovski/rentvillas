<?php
  class LoginModel extends CI_Model{
    public function __construct(){
      $this->load->database();
      $this->load->library('encryption');
      // $this->load->library('session');

    }
    public function get($username, $password){
      $query = $this->db->query("
      SELECT * FROM Person
      WHERE Name = '$username' AND Password = '$password' ");

      $query = $query->result_array();

     
        foreach($query as $row){
          if ($row['Name'] != null){
              if ($password === $row['Password'] && $row['Admin'] != NULL){
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['personID'] = $row['Person_ID'];
                $_SESSION['admin'] = true;
                return true;
              } else if ($password === $row['Password']){
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['personID'] = $row['Person_ID'];
                return true;
              }
          }
        }
    }


    public function upcomingTrips($user){
      $query = $this->db->query("
      SELECT * FROM Properties
      JOIN Bookings ON Bookings.Prop_ID = Properties.Prop_ID
      JOIN Person ON Person.Person_ID = Bookings.Person_ID
      WHERE Person.Name = '$user'
      ORDER BY From_Date ASC
      ");

      return $query->result_array();
    }
  }
?>