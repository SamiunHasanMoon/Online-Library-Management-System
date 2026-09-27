<?php

include "config/database.php";


$id = $_GET['id'];


// Existing book data

$result = $conn->query(
    "SELECT * FROM books WHERE id=$id"
);


$book = $result->fetch_assoc();



if(isset($_POST['update'])){


$title = htmlspecialchars($_POST['title']);

$author = htmlspecialchars($_POST['author']);

$category = htmlspecialchars($_POST['category']);

$description = htmlspecialchars($_POST['description']);



$stmt = $conn->prepare(
"UPDATE books SET
title=?,
author=?,
category=?,
description=?
WHERE id=?"
);


$stmt->bind_param(
"ssssi",
$title,
$author,
$category,
$description,
$id
);



if($stmt->execute()){

    echo "Book Updated Successfully";

}
else{

    echo "Error: ".$stmt->error;

}


if($conn->query($sql)){


echo "Book Updated Successfully";


}

else{


echo "Error: ".$conn->error;


}


}


?>


<!DOCTYPE html>

<html>


<head>

<title>Edit Book</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>

<?php include "includes/navbar.php"; ?>
<h1>Edit Book</h1>


<form method="POST">


<input 
type="text"
name="title"
value="<?php echo $book['title']; ?>"
required>


<br>


<input 
type="text"
name="author"
value="<?php echo $book['author']; ?>"
required>


<br>


<input 
type="text"
name="category"
value="<?php echo $book['category']; ?>">


<br>


<textarea name="description">

<?php echo $book['description']; ?>

</textarea>


<br>


<button name="update">

Update Book

</button>


</form>
<?php include "includes/footer.php"; ?>

</body>

</html>