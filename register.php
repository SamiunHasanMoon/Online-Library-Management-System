<?php

include "config/database.php";


if(isset($_POST['register'])){


$name = trim($_POST['name']);

$email = trim($_POST['email']);

$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);



$stmt = $conn->prepare(
    "INSERT INTO users (name,email,password) VALUES (?,?,?)"
);


$stmt->bind_param(
    "sss",
    $name,
    $email,
    $password
);



if($stmt->execute()){


echo "
<script>

alert('Registration Successful');

window.location='login.php';

</script>
";


}

else{


echo "
<script>

alert('Registration Failed');

</script>
";


}



}


?>



<!DOCTYPE html>

<html>

<head>

<title>Create Account</title>

<link rel="stylesheet" href="css/style.css">

<script src="js/script.js"></script>

</head>



<body>


<?php include "includes/navbar.php"; ?>



<div class="login-box">



<h1>
Create Account
</h1>



<form method="POST" 
name="registerForm" 
onsubmit="return validateForm()">



<input

type="text"

name="name"

placeholder="Your Name"

required>



<input

type="email"

name="email"

placeholder="Your Email"

required>



<input

type="password"

name="password"

placeholder="Create Password"

required>



<button

type="submit"

name="register">

Register

</button>



</form>



<p>

Already have an account?

<a href="login.php">
Login
</a>

</p>



</div>



<?php include "includes/footer.php"; ?>


</body>

</html>