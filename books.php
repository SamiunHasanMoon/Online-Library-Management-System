<?php

session_start();

include "config/database.php";


// Search

$search = "";

if(isset($_GET['search'])){

    $search = htmlspecialchars($_GET['search']);

}



if($search != ""){


    $stmt = $conn->prepare(
        "SELECT * FROM books 
        WHERE title LIKE ? 
        OR author LIKE ? 
        OR category LIKE ?"
    );


    $like = "%".$search."%";


    $stmt->bind_param(
        "sss",
        $like,
        $like,
        $like
    );


    $stmt->execute();


    $result = $stmt->get_result();



}
else{


    $result = $conn->query(
        "SELECT * FROM books ORDER BY id DESC"
    );


}



?>


<!DOCTYPE html>

<html>

<head>

<title>Books</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<?php include "includes/navbar.php"; ?>



<h1 style="text-align:center;">
Available Books
</h1>



<div class="search-box">

<form method="GET">


<input 
type="text"
name="search"
placeholder="Search Book..."
value="<?php echo $search; ?>">



<button type="submit">
Search
</button>


</form>

</div>




<div class="books-container">



<?php


if($result->num_rows > 0){


while($row = $result->fetch_assoc()){



echo '

<div class="book-card">



<img 
src="uploads/'.$row['image'].'" 
class="book-cover">



<h2>
'.$row['title'].'
</h2>



<p>
<b>Author:</b>
'.$row['author'].'
</p>



<p>
<b>Category:</b>
'.$row['category'].'
</p>



<p>
'.$row['description'].'
</p>




<div class="book-buttons">


<a href="edit_book.php?id='.$row['id'].'">
Edit
</a>



<a href="delete_book.php?id='.$row['id'].'">
Delete
</a>



</div>



</div>


';



}



}
else{


echo '

<h2 style="text-align:center;">
No Books Found
</h2>

';


}


?>



</div>




<?php include "includes/footer.php"; ?>


</body>

</html>