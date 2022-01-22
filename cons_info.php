<html>
<head><title>Kiwi's Vet Clinic</title></head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
html {
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
}
input {
    float: center;
    border: 2px solid #b991b2;
    padding: 5px 5px;
    border-radius: 5px;
    margin-right: 5px;
    margin-left: 50px;
    
}
.logout{

   position:fixed;
   right:10px;
   top:5px;
}

</style>
</head>

<body>

<form action="cons_info.php" method="POST">
<?php
session_start();
ob_start();
include "sql_connection.php";
?>
<h1 style="text-align: center"> <img src="logo.jpg" alt="Kiwi's Vet Clinic" style="width:200px;height:100px;"/></h1>
<h1 style="text-align: center; font-size:30px; color:#b991b2">Kiwi's Vet Clinic</h1>
<?php

if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){

   if (isset($_SESSION['petid'])){
     
     $id = $_SESSION['petid'];

      $sql_cons = "SELECT * FROM consultations WHERE petid='$id'";
      $result_cons = mysqli_query($conn, $sql_cons);
     
      if (mysqli_num_rows($result_cons) >= 1) {
              $i=1;
              while($row = mysqli_fetch_assoc($result_cons)){
                    ?>
                  <h2 style="text-align:center; font-size:20px; color:#b991b2">Consultation number:<?php print $i;?></h2>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Consultation id:<?php print $row['consid']; ?></p>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Consultation date:<?php print $row['date']; ?></p>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Reason:<?php print $row['reason']; ?></p>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Application:<?php print $row['application']; ?></p>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Vet:<?php print $row['vetname']; ?></p>                 
<?php
$i = $i + 1;
}}else{
       echo "There is no consultation!!";

} 
?>
<label>
  <input name="add" type="submit" value="Add new consultation">
  <input name="back" type="submit" value="Back pet info page">
</label>
<label class="logout">
  <input name="out" type="submit" value="log out">
  </label>
</form>
<?php
}}else{
        header("Location: login.php");
}      

if (isset($_POST['add'])){
     
        header("Location: add_cons_info.php");
}
  if (isset($_POST['back'])){
     
        header("Location: pet_info.php");
}
if (isset($_POST['out'])){
     
        header("Location: logout.php");
}

ob_end_flush();
?>         
</body> 
</html>