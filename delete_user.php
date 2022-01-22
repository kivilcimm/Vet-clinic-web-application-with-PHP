<?php
 
session_start(); 

include "sql_connection.php";

if (isset($_SESSION['phone']) && isset($_SESSION['password'])) {

  if($_SESSION['user_type'] === 'admin'){
          
    $user_id = $_SESSION['change_id'];

    $sql_user = "SELECT * from users WHERE id='$user_id'";
    $result_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);

    $type = $row_user["type"];

    if($type === 'client'){

        $sql_delete_client = ("DELETE FROM users WHERE id= '$user_id'");
        $sql_delete_pets = ("DELETE FROM pets WHERE clientid = '$user_id'");

        mysqli_query($conn, $sql_delete_client) or die('Error, delete query in users failed');
        mysqli_query($conn, $sql_delete_pets) or die('Error, delete query in pets failed');

        header("Location: admin_home.php");
    }

if($type === 'vet' || $type === 'admin'){
        
        $sql_delete_client =("DELETE FROM users WHERE id='$user_id'");

        mysqli_query($conn, $sql_delete_client) or die('Error, delete query in users failed');
        
        header("Location: admin_home.php");
       }
}else{header("Location: logout.php");}

}else{header("Location: logout.php");}

?>