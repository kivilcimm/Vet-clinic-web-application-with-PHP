<html><head><title>Kiwi's Vet Clinic</title></head>
<body>
<h1 style="text-align: center"> <img src="logo.jpg" alt="Kiwi's Vet Clinic" style="width:200px;height:100px;"/></h1>
<h1 style="text-align: center; font-size:30px; color:#b991b2 ">Kiwi's Vet Clinic</h1>

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
    border: 2px solid #b991b2 ;
    width: 95%;
    padding: 10px;
    margin: 10px auto;
    border-radius: 5px;
   
}
label {
    color: #888;
    font-size: 18px;
    padding: 10px;
}

button {
    float: center;
    background:  #b991b2;
    padding: 10px 15px;
    color: #fff;
    border-radius: 5px;
    margin-right: 10px;
    border: none;
}

.logout{

   position:fixed;
   right:10px;
   top:5px;
   
}

</style>
</head>
<body>


<form action="admin_home.php" method="POST">
<?php
session_start();
include "sql_connection.php";

if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){

       if (isset($_SESSION['user_id'])){
       ?>

      <label>
        <input name="add_vet" type="submit" value="Add a vet/admin/client">
        <input name="add_pet" type="submit" value="Add a pet">
        <input name="delete_vet" type="submit" value="Delete/Change a user">
        <input name="delete_pet" type="submit" value="Delete/Change a pet">
      </label>
      <label class="logout">
        <input name="out" type="submit" value="log out">
      </label>

</form>
<?php
}}else{
        header("Location: logout.php");
      }
if (isset($_POST['add_vet'])){
     
        header("Location: add_vet.php");
}
  if (isset($_POST['add_pet'])){
     
        header("Location: add_pet.php");
}
if (isset($_POST['delete_vet'])){
     
        header("Location: find_users.php");
}
if (isset($_POST['delete_pet'])){
     
        header("Location: find_pet.php");
}
if (isset($_POST['out'])){
     
        header("Location: logout.php");
}?>

</body> 
</html>