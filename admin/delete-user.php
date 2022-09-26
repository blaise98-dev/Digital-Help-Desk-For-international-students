<?php
include('../connect.php');
$id=$_GET['id'];
$sql = "DELETE From `admission` where ID ='$id'";
$result = mysqli_query($conn, $sql);
//$row = mysqli_num_rows($result);
if ($result >0){

header("location: user-record.php");
}
?>