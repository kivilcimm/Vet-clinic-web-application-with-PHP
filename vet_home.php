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


<form action="vet_home.php" method="POST">
<?php
session_start();
include "sql_connection.php";

if(isset($_SESSION["phone"])&&isset($_SESSION["password"])){
       ?>
     <label>Please enter pet id</label>  
     <input type="text" name="id" placeholder="Pet id"><br>
     <button type="submit">Find</button>

      <label class="logout">
      <input name="out" type="submit" value="log out">
      </label>

     <?php }else{
          header("Location: logout.php");
        }?>
</form>

<?php
  if (isset($_POST['id'])){
   
    $id = $_POST['id'];
   
    $sql_pet = "SELECT petid FROM pets WHERE petid='$id'";
    $result_pet = mysqli_query($conn, $sql_pet);

   
   if (mysqli_num_rows($result_pet) === 1) {

     $row_pet = mysqli_fetch_assoc($result_pet);

     $_SESSION['petid'] = $row_pet['petid'];
                
     header("Location: pet_info.php");

   }else{
        echo "Pet $id is not found!!Please try again";
      }
   }

   if(isset($_POST['out'])){

      header("Location: logout.php");

   }
   
   
?>


</body> 
</html>