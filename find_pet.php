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
if(isset($_SESSION["phone"])&&isset($_SESSION["password"]) ){
     
     if($_SESSION['user_type'] === 'admin'){
          
     ?>
<form action="find_pet.php" method="POST">

    <label>Please enter pet id</label>  
      <input type="text" name="pet_id" placeholder="Pet id"><br>
    <button type="submit">Find</button>

    <label class="logout">
      <input name="out" type="submit" value="log out">
    </label>


</form>
<?php
}
else{
    header("Location logout.php");
}
}else{
      header("Location logout.php");
}
if (isset($_POST['out'])){
     
        header("Location: logout.php");
}

elseif(isset($_POST['pet_id'])){

      function validate($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
        
         return $data;
         }

      $pet_id = validate($_POST['pet_id']);

      $sql_pet = "SELECT * from pets WHERE petid='$pet_id'";

      $result_pet = mysqli_query($conn, $sql_pet);
      
      if (mysqli_num_rows($result_pet) === 1) {
         $row_pet = mysqli_fetch_assoc($result_pet);
         $_SESSION['change_pet'] = $pet_id;
         ?>
         <h2 style="text-align:center; font-size:20px; color:#b991b2">Pet info:</h2>
         <p style="text-align:center; font-size:15px; color:#b991b2">Type: <?php print  $row_pet["type"]; ?></p>
         <p style="text-align:center; font-size:15px; color:#b991b2">Name: <?php print  $row_pet['name']; ?></p>
         <p style="text-align:center; font-size:15px; color:#b991b2">Gender: <?php print $row_pet["gender"]; ?></p>
         <p style="text-align:center; font-size:15px; color:#b991b2">Age: <?php print  $row_pet["age"]; ?></p>
         
         <form action="find_pet.php" method="POST">

         <label>
             <input name="change" type="submit" value="Change info">
             <input name="delete" type="submit" value="Delete pet">
        </label>

        </form>
         <?php
        }else{
             print "Pet not found!! Try again!!";
        }

}
elseif(isset($_POST['change'])){
    
    header("Location: change_pet.php");
}
elseif(isset($_POST['delete'])){
  
    header("Location: delete_pet.php");
   
}

?>     
     
</body> 
</html>
