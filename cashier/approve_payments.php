<?php
session_start();
error_reporting(0);
include('../connect.php');
if(strlen($_SESSION['admin-username'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
	
$username=$_SESSION['admin-username'];
date_default_timezone_set('Africa/Kigali');
$current_date = date('Y-m-d H:i:s');
if(isset($_GET['trcode']))
{
$uid=intval($_GET['trcode']);

mysqli_query($conn,"update payments set status='paid' where  transaction_code='$uid'");
header("location: pending_payments.php");

}
}
?>