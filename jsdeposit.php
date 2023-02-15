<?php
session_start();
include("databaseconnection.php");
$dt = date("Y-m-d");
$sql = "INSERT INTO  billing (purchase_date,purchase_amount,payment_type,payment_detail,status,customer_id) VALUES('$dt','$_POST[paid_amount]','Deposit','" . serialize($_POST['payment_detail'])  . "','Active','$_SESSION[customer_id]')";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
echo $paymentid=mysqli_insert_id($con);
?>