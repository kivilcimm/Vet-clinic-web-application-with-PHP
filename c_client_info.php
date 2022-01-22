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
     
          $id = $_SESSION['user_id'];
     ?>
<form action="c_client_info.php" method="POST">
     
    <label>Name:</label>
        <input type="text" name="name" placeholder="Name Surname"><br>

      <label>Phone:</label>
        <input type="text" name="phone" placeholder="Phone"><br>
        
      <label>Password:</label>
        <input type="text" name="password" placeholder="Password"><br> 
        
       <button type="submit">Save</button>

</form>
<?php
}else{
      header("Location logout.php");
}

if(isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['name'])){
      function validate($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         
         return $data;
         }

      $phone = validate($_POST['phone']);
      $_SESSION['phone'] = $phone;
      $password = validate($_POST['password']);
      $_SESSION['password'] = $password;
      $name = validate($_POST['name']);
      $_SESSION['user_name'] = $name;
      $type = $_SESSION['user_type'];

      $sql = ("UPDATE users SET phone='$phone', name='$name', password='$password', type='$type' WHERE id='$id'");
   
      mysqli_query($conn, $sql) or die('Error, insert query failed');
      
      header("Location: client_home.php");
}

?>     

       
</body> 
</html>
