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


<?php
session_start();
include "sql_connection.php";
header_remove("Location");
if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){
     
     if (isset($_SESSION['petid'])){
          $id = $_SESSION['petid'];
          $random= rand(10000,99999);
          $appid = 'vacc'. substr($id,1) . strval($random) ;
     ?>
<form action="add_vacc_info.php" method="POST">

      <label>Vaccine Name:</label>
        <input type="text" name="name" placeholder="Vaccine Name"><br>
        
      <label>Pet Age:</label>
        <input type="text" name="age" placeholder="Pet Age"><br> 
        

      <label>Application Date:</label>
        <input type="date" name="date" placeholder="Date"><br> 
        
       <button type="submit">Save</button>

</form>
<?php
}}else{
      header("Location logout.php");
}

if(isset($_POST['name']) && isset($_POST['age']) 
                && isset($_POST['date'])){

      function validate($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         
         return $data;
         }

      $name = validate($_POST['name']);
      $age = validate($_POST['age']);
      $date = validate($_POST['date']);

      $sql = "INSERT INTO appvacc (appid, petid, vaccname, age, date) 
              VALUES  ('$appid', '$id', '$name', '$age', '$date')";

      mysqli_query($conn, $sql) or die('Error, insert query failed');
      
      header("Location: vacc_info.php");
}

?>     

       
</body> 
</html>
