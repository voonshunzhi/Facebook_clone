<?php
$con = mysqli_connect("localhost","root","Shunzhivoon112893332030","swirlfeed");

if(mysqli_connect_errno())
{
    //mysqli_connect_errno() - returns the error code if the connection to the database failed
    echo "Connection has failed".mysqli_connect_errno();
}

$query = mysqli_query($con,"INSERT INTO test VALUES(2,'Reece Kenney')");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
</body>
</html>