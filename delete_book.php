<?php

include "config/database.php";


$id = $_GET['id'];


$sql = "DELETE FROM books WHERE id=$id";


if($conn->query($sql)){


    echo "Book Deleted Successfully";


}
else{


    echo "Error: ".$conn->error;


}


header("refresh:2;url=books.php");


?>