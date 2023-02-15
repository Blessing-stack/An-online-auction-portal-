<?php
session_start();
include("databaseconnection.php");
$dt = date("Y-m-d");
$sql = "INSERT INTO  billing (purchase_date,purchase_amount,payment_type,status,customer_id,product_id,payment_detail) VALUES('$dt','$_POST[paid_amount]','Sell','Active','$_SESSION[customer_id]','$_POST[productid]','" . serialize($_POST['payment_detail'])  . "')";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
if(mysqli_affected_rows($con) == 1)
{
    echo $insid = mysqli_insert_id($con);
    $sql = "UPDATE product SET status='Active' WHERE product_id='$_POST[productid]'";
    mysqli_query($con,$sql);
}
?>