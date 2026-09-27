<?php

session_start();


// Login check
if(!isset($_SESSION['user'])){

    header("Location: login.php");
    exit();

}


include "config/database.php";


// Add Book

if(isset($_POST['add'])){


    $title = htmlspecialchars($_POST['title']);

    $author = htmlspecialchars($_POST['author']);

    $category = htmlspecialchars($_POST['category']);

    $description = htmlspecialchars($_POST['description']);



    $stmt = $conn->prepare(
        "INSERT INTO books 
        (title, author, category, description)
        VALUES (?, ?, ?, ?)"
    );


    $stmt->bind_param(
        "ssss",
        $title,
        $author,
        $category,
        $description
    );



    if($stmt->execute()){

        echo "<script>
        alert('Book Added Successfully');
        window.location='books.php';
        </script>";

    }
    else{

        echo "Error: ".$stmt->error;

    }


}


?>


<!DOCTYPE html>

<html>

<head>

<title>Add Book</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php include "includes/navbar.php"; ?>


<h1>Add New Book</h1>



<form method="POST">


<input 
type="text"
name="title"
placeholder="Book Title"
required>


<br><br>


<input 
type="text"
name="author"
placeholder="Author Name"
required>


<br><br>


<input 
type="text"
name="category"
placeholder="Category">


<br><br>


<textarea 
name="description"
placeholder="Book Description"></textarea>


<br><br>


<button type="submit" name="add">

Add Book

</button>


</form>



<?php include "includes/footer.php"; ?>


</body>

</html>