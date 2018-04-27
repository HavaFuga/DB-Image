<?php
require_once '../lib/Repository.php';
/**
 * Datenbankschnittstelle für die Benutzer
 */
  class LoginRepository extends Repository
  {
      protected $tableName = 'user';
      protected $tableId = 'uid';
      protected $order = 'name';

    public function create($name, $email, $password)
    {
        $query = "INSERT INTO $this->tableName (name, email, password) VALUES (?,?,?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss', $name, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        $statement->close();
    }

      public function login($email, $password){
          $query = "SELECT id, email, password FROM $this->tableName WHERE email='" . $email . "' AND password='" . $password . "'";
          $statement = ConnectionHandler::getConnection()->prepare($query);
          $statement->execute();
          $statement->store_result();//change here
          $result = $statement->num_rows;
/*          $statement->bind_param('ss', $email, $password);*/
          if ($result == 0) {
/*              throw new Exception($statement->error);*/
              return false;
          }else{
              return true;
          }
          $statement->close();

      }

      public function getEmail($email){
          $query = "SELECT email FROM $this->tableName WHERE email='\" . $email . \"'";
          $statement = ConnectionHandler::getConnection()->prepare($query);
          $statement->bind_param('s', $email);
          $statement->execute();
          $statement->store_result();
          /*var_dump($statement->store_result());
          die();*/
          $result = $statement->num_rows;
          if ($result == 0) {
              return true;
          }else{
              return false;
          }
          $statement->close();
      }
      public function getUid($email, $password){
          $query = "SELECT id FROM $this->tableName WHERE email='" . $email . "' AND password='" . $password . "'";
          $statement = ConnectionHandler::getConnection()->prepare($query);
          $statement->bind_param('ss', $email, $password);

          if (!$statement->execute()) {
              throw new Exception($statement->error);
          }else {
              $value = $statement->fetch_object;
              $userid = $value-row;
              var_dump($userid);
              die();
          }
          $statement->close();
      }










  }
?>