<?php

session_start();

include "config/database.php";


$book_count = $conn->query(
"SELECT COUNT(*) as total FROM books"
)->fetch_assoc()['total'];


if(!isset($_SESSION['user'])){

    header("Location: login.php");

    exit();

}

?>


<!DOCTYPE html>

<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php include "includes/navbar.php"; ?>


<div class="login-box">


<h1>
Welcome
</h1>


<h2>
<?php echo $_SESSION['user']; ?>
</h2>


<p>
You are logged in successfully.
</p>


<a href="books.php">

<button>
Explore Books
</button>

</a>


</div>



<?php include "includes/footer.php"; ?>


</body>

</html>