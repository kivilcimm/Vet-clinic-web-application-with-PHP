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
    margin-right: 2px;
     
}
label {
    color: #888;
    font-size: 18px;
    padding: 10px;
}
button {
    float: center;
    padding: 5px 5px;
    border-radius: 5px;
    margin-right: 5px;
    margin-left: 50px;
    border: 2px solid #b991b2;
}
.logout{

   position:fixed;
   right:10px;
   top:5px;
}

</style>
</head>

<body>
<h1 style="text-align: center"> <img src="logo.jpg" alt="Kiwi's Vet Clinic" style="width:200px;height:100px;"/></h1>
<h1 style="text-align: center; font-size:30px; color:#b991b2">Kiwi's Vet Clinic</h1>

<form action="add_cons_info.php" method="POST">
<?php
session_start();

include "sql_connection.php";

header_remove("Location");

if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){
     
     if (isset($_SESSION['petid'])){
          $id = $_SESSION['petid'];
          $random= rand(100000,999999);
          $consid='cons'. substr($id,1) . strval($random) ;
     ?>

      <label>Consultation date:</label>
        <input type="date" name="date" placeholder="Date"><br>
        
      <label>Reason of consultation:</label>
        <input type="text" name="reason"  maxlength="100" placeholder="max 100"><br> 
        

      <label>Application:</label>
        <input type="text" name="app"  maxlength="100" placeholder="max 100"><br> 
   
      <label>Vet:</label>
        <input type="text" name="vet_name" placeholder="vet_name"><br> 
        
       <button type="submit">Save</button>

</form>
<?php
}}else{
      header("Location logout.php");
}

if(isset($_POST['date']) && isset($_POST['reason']) && isset($_POST['app']) && isset($_POST['vet_name'])){

      function validate($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         
         return $data;
         }

      $date = validate($_POST['date']);
      $reason = validate($_POST['reason']);
      $app = validate($_POST['app']);
      $name = validate($_POST['vet_name']);

      $sql = ("INSERT INTO consultations (consid, petid, date, reason, application, vetname) 
              VALUES  ('$consid', '$id', '$date', '$reason', '$app', '$name')");
 
      mysqli_query($conn, $sql) or die('Error, insert query failed');

      header("Location: cons_info.php");
}
?>     
     
</body> 
</html>
