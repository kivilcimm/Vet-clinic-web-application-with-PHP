<?php
 
session_start(); 

include "sql_connection.php";

if (isset($_SESSION['phone']) && isset($_SESSION['password'])) {

    if($_SESSION['user_type'] === 'admin'){

    $pet_id = $_SESSION['change_pet'];
       
    $sql_delete_pet = ("DELETE FROM pets WHERE petid='$pet_id'");

    mysqli_query($conn, $sql_delete_pet) or die('Error, delete query in pets failed');
    
    header("Location: admin_home.php");
        header("Location: admin_home.php");
       }}

?>