<?php
session_start();
// by default, error messages are empty



$call_login=$set_email=$emailErr=$passErr='';
  
 extract($_POST);

if(isset($login))
{
   
   //input fields are Validated with regular expression
  
   $validEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
   
 
//Email Address Validation
if(empty($email)){
  $emailErr="Email is Required"; 
}
else if (!preg_match($validEmail,$email)) {
  $emailErr="Invalid Email Address";
}
else{
  $emailErr=true;
}
    
// password validation 
if(empty($password)){
  $passErr="Password is Required"; 
} 
else{
   $passErr=true;
}

// check all fields are valid or not
if( $emailErr==1 && $passErr==1)
{
 
   //legal input values
   $email=     legal_input($email);
   $password=  legal_input(md5($password));

   //  Sql Query to insert user data into database table
   $db=$conn;// database connection  
   $call_login=login($db,$email,$password);

}else{
   $set_email=$email;
}

}

// convert illegal input value to ligal value formate
function legal_input($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}

// function to check valid login data into database table
function login($db,$email,$password){

  

   // checking valid user
  $check_email="SELECT email FROM users WHERE email='$email' AND status=1";
  $run_email=mysqli_query($db,$check_email);
  if($run_email){
  if(mysqli_num_rows($run_email)>0)
  {
    // checking email and password
    $check_user="SELECT * FROM users WHERE email='$email' AND password='$password'";
    $run_user= mysqli_query($db,$check_user);
    $row = mysqli_fetch_array($run_user);
    if(mysqli_num_rows($run_user)>0)
     {
     
      $_SESSION['email']=$email;
      $_SESSION['id']=$row['id'];
      $_SESSION['role']=$row['role'];
      $_SESSION['username']=$row['username'];
      $_SESSION['password']=$row['password'];
      $_SESSION['position']=$row['position'];
      $_SESSION['full_name']=$row['full_name'];
      $_SESSION['sidebar']="Home";
      $user_id = $row['id'];
      $query2 = "SELECT * FROM employee WHERE user_id='$user_id'";
      $res2 = mysqli_query($db,$query2);
      $user2 = mysqli_fetch_array($res2);
      if(mysqli_num_rows($res2)>0){

      $_SESSION['full_name'] = $user2['name'];
      $_SESSION['profile_pic'] = $user2['image'];
      }

      if($_SESSION['position'] == 'Employee'){
        header("location:../Admin/index.php");
      }else{
        
        header("location:../index.php");
      }

      
     }else
     {
      return "Your Password is wrong" ;
     }

  }
  else
  {
    return "Your Email is not exist";
  }
   }else{
    echo $db->error;
   } 
    
}
?>