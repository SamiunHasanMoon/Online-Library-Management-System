<?php

$conn = new mysqli(
"sql201.infinityfree.com",
"if0_43019850",
"moon01638",
"if0_43019850_library"
);


if($conn->connect_error){

    die("Database Connection Failed: " . $conn->connect_error);

}

?>