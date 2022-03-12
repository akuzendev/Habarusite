<?php

DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','hdb');
DEFINE('DB_USERNAME','root');
DEFINE('DB_PASS','');
DEFINE('CHARSET','utf-8');


class Database{

    public function __construct(){
    
        try{
          $conn = "mysql:host=".DB_HOST.";dbname=".DB_NAME."";
          $this->conn = new PDO($conn,DB_USERNAME, DB_PASS,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
          ]);
          //echo "connected successfully";
        }catch(Exception $e){
          echo 'An Error occured'.$e;
          exit();
        
      }
      
        
      }
    
      public function getConnection(){
        return $this->conn;
      }
    
    
      public function executesql($qtype,$sql,$args){
    
        switch($qtype){
          case 'selectall':
            $args = null;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
          break;
          case 'selectone':
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($args);
            $result = $stmt->fetch();
            return $result;
          break;
           case 'crud':
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($args);
            $result = $stmt->fetchAll();
            return $result;
           break;
           default:
             echo "Unknown Argument";
         }
        
    
}



}



