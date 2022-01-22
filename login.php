<?php
 
session_start(); 

include "sql_connection.php";

if (isset($_POST['phone']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $phone = validate($_POST['phone']);

    $pass = validate($_POST['password']);

    if (empty($phone)) {

        header("Location: login.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: login.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE phone='$phone' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['phone'] === $phone && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['phone'] = $row['phone'];
                
                $_SESSION['password'] = $row['password'];

                $_SESSION['user_type'] = $row['type'];
                
                $_SESSION['user_id'] = $row['id'];
               
                $_SESSION['user_name'] = $row['name'];
                 
               if($row['type'] === "admin"){
                       
                      header("Location: admin_home.php");

                        }
               if($row['type'] === "vet"){
                       
                      header("Location: vet_home.php");

                        }
               if($row['type'] === "client"){
                       
                      header("Location: client_home.php");

                        }
                

                exit();

            }else{

                header("Location: login.html?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: login.html?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: login.html");

    exit();

}

