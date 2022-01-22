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
          $user_id = 'v'. strval($random);
          
     ?>
<form action="add_vet.php" method="POST">

     <label>User Type:</label>
        <input type="text" name="type" placeholder="User type"><br>

      <label>User Name:</label>
        <input type="text" name="name" placeholder="User Name"><br>
        
      <label>Phone:</label>
        <input type="text" name="phone" placeholder="Phone"><br> 
        

      <label>Password:</label>
        <input type="text" name="password" placeholder="Password"><br> 
        
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

elseif(isset($_POST['type']) && isset($_POST['name']) && isset($_POST['phone']) 
                && isset($_POST['password'])){

      function validate($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
        
         return $data;
         }

      $name = validate($_POST['name']);
      $phone = validate($_POST['phone']);
      $password = validate($_POST['password']);
      $type = validate(($_POST['type']));

      $sql = "INSERT INTO users (phone, name, password, id, type) 
              VALUES  ('$phone', '$name', '$password', ' $user_id', '$type')";

      mysqli_query($conn, $sql) or die('Error, insert query failed');
      
      header("Location: admin_home.php");
}

?>     

       
</body> 
</html>
