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
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

	 // for Cancel admission    	
if(isset($_GET['id']))
{
$id=intval($_GET['id']);

mysqli_query($conn,"update admission set status='0' where ID='$id'");
header("location: user-record.php");
}

// for admit user
if(isset($_GET['uid']))
{
$uid=intval($_GET['uid']);

mysqli_query($conn,"update admission set status='1' where ID='$uid'");
header("location: user-record.php");

}
}
?>