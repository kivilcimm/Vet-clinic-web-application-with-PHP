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
    border: 2px solid #b991b2;
    padding: 5px 10px;
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
<h1 style="text-align: center"> <img src="logo.jpg" alt="Kiwi's Vet Clinic" style="width:200px;height:100px;"/></h1>
<h1 style="text-align: center; font-size:30px; color:#b991b2">Kiwi's Vet Clinic</h1>

<form action="vacc_info.php" method="POST">
<?php
session_start();
include "sql_connection.php";
if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){

    if (isset($_SESSION['petid'])){
     
      $id = $_SESSION['petid'];
      $sql_vacc = "SELECT * FROM appvacc WHERE petid='$id'";
      $result_vacc = mysqli_query($conn, $sql_vacc);
     
      if (mysqli_num_rows($result_vacc) >= 1) {
              $i=1;
              while($row_vacc = mysqli_fetch_assoc($result_vacc)){
                    ?>
                  <h2 style="text-align:center; font-size:20px; color:#b991b2">Vaccine Number: 
                             <?php print $i;?> </h2>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Application id: <?php print $row_vacc['appid']; ?></p>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Vaccine Name: <?php print $row_vacc['vaccname']; ?></p>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Pet Age: <?php print $row_vacc['age']; ?></p>
                   <p style="text-align:center; font-size:15px; color:#b991b2">Application Date: <?php print $row_vacc['date']; ?></p>
                    
<?php
$i = $i + 1;
}}else{
       echo "There is no vaccines!!";

}
?> 
  <label>
      <input name="add_vacc" type="submit" value="Add new vaccine">
      <input name="back" type="submit" value="Back pet info page">
 </label>
 <label class="logout">
      <input name="out" type="submit" value="log out">
 </label>

<?php

}}else{
        header("Location: login.php");
}
       
?> 

</form>
<?php
if (isset($_POST['add_vacc'])){
     
        header("Location: add_vacc_info.php");
}
  if (isset($_POST['back'])){
     
        header("Location: pet_info.php");
}

if (isset($_POST['out'])){
     
        header("Location: logout.php");
}
?>     

       
</body> 
</html>