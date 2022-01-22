<html>
<head><title>Kiwi's Vet Clinic</title></head>

<body>
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
<h1 style="text-align: center"> <img src="logo.jpg" alt="Kiwi's Vet Clinic" style="width:200px;height:100px;"/></h1>
<h1 style="text-align: center; font-size:30px; color:#b991b2">Kiwi's Vet Clinic</h1>

<?php

session_start();
include "sql_connection.php";
header_remove("Location");
if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){

     if (isset($_SESSION['user_id'])){

            $user_id = $_SESSION['user_id'];
                  
            $sql_pets= "SELECT * FROM pets WHERE clientid='$user_id'";
            $result_pets = mysqli_query($conn, $sql_pets);
                    
            while($row_pets = mysqli_fetch_assoc($result_pets)){ 
                    ?>
                       
                <h2 style="text-align:center; font-size:20px; color:#b991b2">Pet info:</h2>
                <p style="text-align:center; font-size:15px; color:#b991b2">Name: <?php print $row_pets['name']; ?></p>
                <p style="text-align:center; font-size:15px; color:#b991b2">Birth Date: <?php print $row_pets['date']; ?></p>
                <p style="text-align:center; font-size:15px; color:#b991b2">Type: <?php print $row_pets['type']; ?></p>
                <p style="text-align:center; font-size:15px; color:#b991b2">Breed: <?php print $row_pets['breed']; ?></p>
                <p style="text-align:center; font-size:15px; color:#b991b2">Gender: <?php print $row_pets['gender']; ?></p>
                <p style="text-align:center; font-size:15px; color:#b991b2">Age: <?php print $row_pets['age']; ?></p>
                                       
<?php
}
?>
<h2 style="text-align:center; font-size:20px; color:#b991b2">Client info:</h2>
<p style="text-align:center; font-size:15px; color:#b991b2">Name Surname: <?php print  $_SESSION['user_name']; ?></p>
<p style="text-align:center; font-size:15px; color:#b991b2">Phone: <?php print $_SESSION["phone"]; ?></p>

<form action="client_home.php" method="POST">

<label>
   <input name="change" type="submit" value="Change client info">
</label>
   <label class="logout">
   <input name="out" type="submit" value="log out">
 </label>

</form>

<?php
}}else{
    header("Location: login.php");
}

if (isset($_POST['change'])){
     
    header("Location: c_client_info.php");
}

if (isset($_POST['out'])){
     
    header("Location: logout.php");
}
?>

</body> 
</html>
