<?php
  class RegisterModel extends CI_Model{
    public function __construct(){
      $this->load->database();
    }
    public function insert($username, $email, $password){
      $this->db->query("
      INSERT INTO Person (Name, Email, Password)
      VALUES ('$username', '$email', '$password')
      ");

      // $this->db->insert('Person', $data);
      // return $this->db->insert_id();
    }
  }
?>