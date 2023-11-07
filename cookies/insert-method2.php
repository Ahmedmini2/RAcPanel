<?php 
include('../db/connection.php'); 
$db= $conn; // update with your database connection
function insert_data(array $data, string $tableName){
       
       global $db;
  
       $tableColumns = $userValues = ''; 
       $num = 0; 
       foreach($data as $column=>$value){ 
            $comma = ($num > 0)?', ':''; 
            $tableColumns .= $comma.$column; 
            $userValues  .= $comma."'".$value."'"; 
            $num++; 
        } 
      $insertQuery="INSERT INTO ".$tableName."  (".$tableColumns.") VALUES (".$userValues.")";
      $insertResult=$db->query($insertQuery);
      if($insertResult){
         return true;
      }else{
         return "Error: " . $insertQuery . "<br>" . $db->error;
      }
  
  }
  ?>