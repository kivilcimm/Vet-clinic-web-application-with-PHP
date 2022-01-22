<html>
<head><title>Kiwi's Vet Clinic</title></head>

<body>
<h1 style="text-align: center"> <img src="logo.jpg" alt="Kiwi's Vet Clinic" style="width:200px;height:100px;"/></h1>
<h1 style="text-align: center; font-size:30px; color:#b991b2">Kiwi's Vet Clinic</h1>

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
    float:center;
    border: 2px solid #b991b2;
    padding: 5px 7px;
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


<form action="pet_info.php" method="POST">
<?php
session_start();
include "sql_connection.php";
header_remove("Location");
if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){

   if (isset($_SESSION['petid'])){
   
     $id = $_SESSION['petid'];
     $sql_pet = "SELECT * FROM pets WHERE petid='$id'";
     $result_pet = mysqli_query($conn, $sql_pet);
     $row_pet = mysqli_fetch_assoc($result_pet); 
    
     $clientid = $row_pet['clientid'];
     $sql_client = "SELECT * FROM users WHERE id = '$clientid'";
     $result_client = mysqli_query($conn,$sql_client);
     $row_client = mysqli_fetch_assoc($result_client);
    
     ?>
    <h2 style="text-align:center; font-size:20px; color:#b991b2">Pet info:</h2>
    <p style="text-align:center; font-size:15px; color:#b991b2">Name: <?php print $row_pet['name']; ?></p>
    <p style="text-align:center; font-size:15px; color:#b991b2">Birth Date: <?php print $row_pet['date']; ?></p>
    <p style="text-align:center; font-size:15px; color:#b991b2">Type: <?php print $row_pet['type']; ?></p>
    <p style="text-align:center; font-size:15px; color:#b991b2">Breed: <?php print $row_pet['breed']; ?></p>
    <p style="text-align:center; font-size:15px; color:#b991b2">Gender: <?php print $row_pet['gender']; ?></p>
    <p style="text-align:center; font-size:15px; color:#b991b2">Age: <?php print  $row_pet['age']; ?></p>

    <h2 style="text-align:center; font-size:20px; color:#b991b2">Client info:</h2>
    <p style="text-align:center; font-size:15px; color:#b991b2">Name Surname: <?php print $row_client['name']; ?></p>
    <p style="text-align:center; font-size:15px; color:#b991b2">Phone: <?php print $row_client["phone"]; ?></p>

    <label>
        <input name="cons" type="submit" value="Consultations">
        <input name="vacc" type="submit" value="Vaccines">
        <input name="back" type="submit" value="Back to pet search">
    </label>
    <label class="logout">
        <input name="out" type="submit" value="log out">
    </label>

</form>

<?php
 }}else{
        header("Location: login.php");
      }
  if (isset($_POST['cons'])){
     
        header("Location: cons_info.php");
}
  if (isset($_POST['vacc'])){
     
        header("Location: vacc_info.php");
}

if (isset($_POST['back'])){
     
        header("Location: vet_home.php");
}
if (isset($_POST['out'])){
     
        header("Location: logout.php");
}?>

</body> 
</html>