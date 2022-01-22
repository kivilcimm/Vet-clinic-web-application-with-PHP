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
<form action="find_users.php" method="POST">

    <label>Please enter user phone</label>  
      <input type="text" name="phone" placeholder="Phone number"><br>
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

elseif(isset($_POST['phone'])){

      function validate($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
        
         return $data;
         }

      $phone = validate($_POST['phone']);

      $sql_user = "SELECT * from users WHERE phone='$phone'";

      $result_user = mysqli_query($conn, $sql_user);
      
      if (mysqli_num_rows($result_user) === 1) {
         $row_user = mysqli_fetch_assoc($result_user);
         $user_id = $row_user['id'];
         $_SESSION['change_id'] = $user_id;
         ?>
         <h2 style="text-align:center; font-size:20px; color:#b991b2">User info:</h2>
         <p style="text-align:center; font-size:15px; color:#b991b2">User Type: <?php print $row_user["type"]; ?></p>
         <p style="text-align:center; font-size:15px; color:#b991b2">Name Surname: <?php print $row_user['name']; ?></p>
         <p style="text-align:center; font-size:15px; color:#b991b2">Phone: <?php print $row_user["phone"]; ?></p>
         <p style="text-align:center; font-size:15px; color:#b991b2">Password: <?php print $row_user["password"]; ?></p>
         
         <form action="find_users.php" method="POST">

         <label>
             <input name="change" type="submit" value="Change info">
             <input name="delete" type="submit" value="Delete User">
        </label>

        </form>
         <?php
        }else{
             print "User not found!! Try again!!";
        }

}
elseif(isset($_POST['change'])){
    
    header("Location: change_user.php");
}
elseif(isset($_POST['delete'])){
  
    header("Location: delete_user.php");
   
}




?>     

       
</body> 
</html>
