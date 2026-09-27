<?php

session_start();

include "config/database.php";


if(isset($_POST['login'])){


    $email = trim($_POST['email']);

    $password = $_POST['password'];



    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email=?"
    );


    $stmt->bind_param(
        "s",
        $email
    );


    $stmt->execute();


    $result = $stmt->get_result();



    if($result->num_rows > 0){


        $user = $result->fetch_assoc();



        if(password_verify($password, $user['password'])){


            $_SESSION['user'] = $user['name'];



            echo "
            <script>
            alert('Login Successful');
            window.location='dashboard.php';
            </script>
            ";


        }

        else{


            echo "
            <script>
            alert('Wrong Password');
            </script>
            ";


        }



    }

    else{


        echo "
        <script>
        alert('User Not Found');
        </script>
        ";


    }



}


?>



<!DOCTYPE html>

<html>

<head>

<title>User Login</title>

<link rel="stylesheet" href="css/style.css">

</head>



<body>



<?php include "includes/navbar.php"; ?>



<div class="login-box">



<h1>
User Login
</h1>



<form method="POST">



<input

type="email"

name="email"

placeholder="Enter Email"

required>



<input

type="password"

name="password"

placeholder="Enter Password"

required>



<button 
type="submit"
name="login">

Login

</button>



</form>



<p>

Don't have an account?

<a href="register.php">
Register
</a>

</p>



</div>



<?php include "includes/footer.php"; ?>



</body>

</html>