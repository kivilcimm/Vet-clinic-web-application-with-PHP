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
          $random= rand(100000000000,999999999999);
          $pet_id = 'p'. strval($random);
          
     ?>
<form action="add_pet.php" method="POST">
     
      <label>Owner Phone:</label>
        <input type="text" name="phone" placeholder="Owner Phone"><br>

      <label>Pet Name:</label>
        <input type="text" name="pet" placeholder="Pet Name"><br>
        
      <label>Birth Date:</label>
        <input type="date" name="date" placeholder="Birth Date"><br> 
      
      <label>Type:</label>
        <input type="text" name="type" placeholder="Type"><br> 

      <label>Breed:</label>
        <input type="text" name="breed" placeholder="Breed"><br> 

      <label>Gender:</label>
        <input type="text" name="gender" placeholder="Gender"><br> 

       <label>Age:</label>
        <input type="text" name="age" placeholder="Age"><br> 
        
       <button type="submit">Save</button>

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
elseif(isset($_POST['phone']) && isset($_POST['pet'])){

      function validate($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
        
         return $data;
         }

      $phone = validate($_POST['phone']);
      $pet = validate($_POST['pet']);
      $date = validate($_POST['date']);
      $breed = validate($_POST['breed']);
      $gender= validate($_POST['gender']);
      $type = validate($_POST['type']);
      $age = validate($_POST['age']);
      
      $sql_id= "SELECT id FROM pets WHERE phone='$phone'";

      $result_id = mysqli_query($conn, $sql_id);
     
      if (mysqli_num_rows($result_id) === 1) {

       $row_id = mysqli_fetch_assoc($result_id);
       $client_id = $row_id['id'];

       $sql = "INSERT INTO pets (petid, clientid, name, date, type, breed, gender, age) 
              VALUES  ('$pet_id', '$client_id', '$pet', ' $date', '$type','$breed','$gender','$age')";

      mysqli_query($conn, $sql) or die('Error, insert query failed');
      
      header("Location: admin_home.php");
      }else{

           print "Owner not found :( First add owner!";
}
}


?>     

       
</body> 
</html>
