<?php 
include('../../db/connection.php'); 
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

  function update_user_id($data, $tableName, $id){

   global $db;
   $columnsValues = ''; 
   $num = 0; 
   foreach($data as $column=>$value){ 
                  
           $comma = ($num > 0)?', ':''; 
           $columnsValues.=$comma.$column." = "."'".$value."'"; 
           $num++; 
    } 

     $updateQuery="UPDATE ".$tableName." SET ".$columnsValues." WHERE user_id=".$id;
    
    $updateResult=$db->query($updateQuery);
    if($updateResult){
      return true;
    }else{
      echo "Error: " . $updateResult . "<br>" . $db->error;
    }


}

  function update_advance_status_data($data, $tableName, $id){

   global $db;
   $columnsValues = ''; 
   $num = 0; 
   foreach($data as $column=>$value){ 
                  
           $comma = ($num > 0)?', ':''; 
           $columnsValues.=$comma.$column." = "."'".$value."'"; 
           $num++; 
    } 

     $updateQuery="UPDATE ".$tableName." SET ".$columnsValues." WHERE emp_id=".$id;
    
    $updateResult=$db->query($updateQuery);
    if($updateResult){
      return true;
    }else{
      echo "Error: " . $updateResult . "<br>" . $db->error;
    }


}

function update_data($data, $tableName, $id){

   global $db;
   $columnsValues = ''; 
   $num = 0; 
   foreach($data as $column=>$value){ 
                  
           $comma = ($num > 0)?', ':''; 
           $columnsValues.=$comma.$column." = "."'".$value."'"; 
           $num++; 
    } 

     $updateQuery="UPDATE ".$tableName." SET ".$columnsValues." WHERE id=".$id;
    
    $updateResult=$db->query($updateQuery);
    if($updateResult){
      return true;
    }else{
      echo "Error: " . $updateResult . "<br>" . $db->error;
    }


}

function delete_data($tableName, $id){
   global $db;
 
   $query="DELETE FROM ".$tableName." WHERE id=".$id;
   $result= $db->query($query);
   if($result){
      return true;
   }else{
      echo "Error found in ".$db->error;
   }
 
 }

 function get_advanced_status($tableName, $emp_id){
   global $db;

   $query = "SELECT * FROM ".$tableName." WHERE emp_id=".$emp_id;
   $result= $db->query($query);
   if($result){
      $data = $result->fetch_assoc();
      return $data['amount'];
   }else{
      echo "New";
   }
 }
  ?>