<?php
session_start();
include("databaseconnection.php");
$dt = date("Y-m-d");
$imgname = rand(). $_FILES["file"]["name"];
move_uploaded_file($_FILES["file"]["tmp_name"],"imgwinner/".$imgname);
$sql ="UPDATE customer SET address='$_POST[address]',state='$_POST[state]',city='$_POST[city]',landmark='$_POST[landmark]',pincode='$_POST[pincode]',mobile_no='$_POST[mobile_no]' WHERE customer_id='$_POST[customer_id]'";
$qsql = mysqli_query($con,$sql);

$sql ="UPDATE winners SET winners_image='$imgname',status='Active' WHERE winner_id='$_POST[winner_id]'";
$qsql = mysqli_query($con,$sql);
$sql = "INSERT INTO  billing (purchase_date,product_id,purchase_amount,payment_type,payment_detail,status,customer_id) VALUES('$dt','$_POST[product_id]','$_POST[paid_amount]','Winners','$_POST[payment_detail]','Active','$_SESSION[customer_id]')";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
$paymentid=mysqli_insert_id($con);
echo $paymentid;
?>