<?php
include("header.php");
if(isset($_SESSION['customer_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['btnforgotpassword']))
{
	$_SESSION['tokenid'] = rand(1000000000,9999999999);	
	$_SESSION['tokenemailid'] = $_POST['emailid'];	
	//######################################
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
	$url = "https://";
    else
    $url = "http://";
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];
    // Append the requested resource location to the URL   
    $url.= dirname($_SERVER['PHP_SELF']) . "/resetpassword.php";
	$url = $url . "?tokenid=$_SESSION[tokenid]&email_id=$_POST[emailid]";
	//######################################
	include("phpmailer.php");
	$sqlcustomer = "SELECT * FROM customer WHERE email_id='$_POST[emailid]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rsmailcustomer = mysqli_fetch_array($qsqlcustomer);
	
	$mailmsg = "Dear $rsmailcustomer[customer_fname] $rsmailcustomer[customer_lname],<br> Looks like you forgot your password!
	<br>
	<br>
	No worries! Click on the Link below to enter your new password.
	<br>
	<a href='$url' target='_blank'><b>Reset Password</b></a> <br><br>If you didn't make this request, just ignore this email.<br><br>Sincerely,<br>$rswebconfig[web_title]";
	sendmail($rsmailcustomer['email_id'],$rsmailcustomer['customer_fname'] . " " . $rsmailcustomer['customer_lname'], "Reset your $rswebconfig[web_title] account password!..", $mailmsg);
	echo "<script>alert('Password Reset Link sent to your E-mail ID...');</script>";
	echo "<script>window.location='index.php';</script>";
}
?>
            <!-- breadcrumb-area start -->
            <div class="breadcrumb-area bg-gray">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb-list">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Forgot Password </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area end -->
            
            <!-- content-wraper start -->
            <div class="content-wraper mt-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="customer-login-register">
                                <center><h3>Forgot Password </h3></center>
                                <div class="login-Register-info">
                                    <form action="" method="post" action=""   onsubmit="return validateform()"> 
                                        <p class="coupon-input form-row-first">
                                            <label>Enter Email ID to Recover Password <span class="required">*</span>  
											<span id='idemailid' style="color:red;"></span></label>
                                            <input type="email" name="emailid" id="emailid" placeholder="Email ID" >
                                        </p>
                                        <p class="coupon-input form-row-last">
                                           <input type="submit" name="btnforgotpassword" class="btn btn-info" value="Recover Password">
                                        </p>
                                       <div class="clear"></div>
									   <hr>
<center><a href="customerlogin.php" class="btn btn-warning">Click Here to Login</a>					
<a href="register.php" class="btn btn-warning">Click Here to Register</a></center>
                                    </form>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-3 col-md-3 col-sm-3"></div>
					</div>
                </div>
            </div>
            <!-- content-wraper end -->
            

<?php
include("footer.php");
?>
<script>
function validateform()
{
	/* #######start 1######### */
	var emailpattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; //For email id
		      
	$("#idemailid").html("");
	var i=0;
	/* ########end 1######## */
	
	if(!document.getElementById("emailid").value.match(emailpattern))
	{
		document.getElementById("idemailid").innerHTML ="Entered email id is not valid....";	
		i=1;		
	}
	if(document.getElementById("emailid").value == "")
	{
		document.getElementById("idemailid").innerHTML ="Email ID should not be empty....";	
		i=1;		
	}
	/* #######start 2######### */
	if(i==0)
	{
		return true;
	}
	else
	{
	return false;
	}
	/* #######end 2######### */
}
</script>
