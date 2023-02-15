<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql = "UPDATE customer SET customer_fname='" . $_POST['customer_fname'] . "',customer_lname='" . $_POST['customer_lname'] . "',email_id='" . $_POST['email_id'] . "',address='" . $_POST['address'] . "',state='" . $_POST['state'] . "',city='" . $_POST['city'] . "',mobile_no='" . $_POST['mobile_no'] . "' WHERE  customer_id='". $_SESSION['customer_id'] ."'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer Profile updated successfully...');</script>";
	}
}
if(isset($_SESSION['customer_id']))
{
	$sqledit = "SELECT * FROM customer WHERE customer_id='" .  $_SESSION['customer_id'] . "'";
	$qsqledit= mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
           <div class="content-wraper mt-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="customer-login-register">
							
							
<!-- banner -->
	<div class="banner">
		<?php
		include("sidebar.php");
		?>
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<h3>Customer <span>Profile</span></h3>

			<div class="checkout-left">	

				<div class="col-md-12 ">
				<form action="" method="post" class="creditly-card-form agileinfo_form" onsubmit="return validatecustomer()">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
											<div class="first-row form-group">
<div class="controls">
<label class="control-label">First Name</label><span class="errormsg" id="errcustomer_fname"></span>
<input class="billing-address-name form-control" type="text" name="customer_fname" id="customer_fname" placeholder="First name" value="<?php echo $rsedit['customer_fname']; ?>">
</div>

<div class="controls">
<label class="control-label">Last Name</label><span class="errormsg" id="errcustomer_lname"></span>
<input class="billing-address-name form-control" type="text" name="customer_lname" id="customer_lname" placeholder="Last name" value="<?php echo $rsedit['customer_lname']; ?>">
</div>


<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Email ID</label><span class="errormsg"  id="erremail_id"></span>
		<input name="email_id" id="email_id" class="form-control" type="text" placeholder="Email ID" value="<?php echo $rsedit['email_id']; ?>">
	</div>
</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Address</label><span class="errormsg"  id="erraddress"></span>
		<textarea name="address" id="address" class="form-control" placeholder="Enter Address"><?php echo $rsedit['address']; ?></textarea>
	</div>
</div>
<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">State</label><span  class="errormsg" id="errstate"></span>
	<select  name="state" id="state" class="form-control">
		<option value="" >------------Select State------------</option>
	<?php 
	$states = [
		"Abia",
		"Adamawa",
		"Akwa Ibom",
		"Anambra",
		"Bauchi",
		"Bayelsa",
		"Benue",
		"Borno",
		"Cross River",
		"Delta",
		"Ebonyi",
		"Edo",
		"Ekiti",
		"Enugu",
		"FCT - Abuja",
		"Gombe",
		"Imo",
		"Jigawa",
		"Kaduna",
		"Kano",
		"Katsina",
		"Kebbi",
		"Kogi",
		"Kwara",
		"Lagos",
		"Nasarawa",
		"Niger",
		"Ogun",
		"Ondo",
		"Osun",
		"Oyo",
		"Plateau",
		"Rivers",
		"Sokoto",
		"Taraba",
		"Yobe",
		"Zamfara"
	];

	foreach ($states as $key => $state) { ?>
		<option value="<?php echo $state; ?>"><?php echo $state; ?></option>
	<?php } ?>
</select>
	</div>
</div>
<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">City</label><span  class="errormsg" id="errcity"></span>
		<input name="city" id="city" class="form-control" placeholder="City" value="<?php echo $rsedit['city']; ?>">
	</div>
</div>
<!--
	postalcode='" . $_POST['postalcode'] . "',
<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Postal code</label><span class="errormsg"  id="errpostalcode"></span>
		<input name="postalcode" id="postalcode" class="form-control" placeholder="Postalcode" value="<?php echo $rsedit['postalcode']; ?>">
	</div>
</div>
-->
<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Mobile number</label><span class="errormsg"  id="errmobile_no"></span>
		<input name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile number" value="<?php echo $rsedit['mobile_no']; ?>">
	</div>
</div>

</div>
<button class="btn btn-info" type="submit" name="submit">Update Profile</button>
</div>
									</section>
								</form>
									
					</div>
			
				<div class="clearfix"> </div>
				
			</div>

		</div>
<!-- //about -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
                            </div>
                        </div>
						<div class="col-lg-3 col-md-3 col-sm-3"></div>
					</div>
                </div>
            </div>

<?php
include("footer.php");
?>
<script>
function validatecustomer()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	$('.errormsg').html('');
	var errchk = "False";
	
	if(document.getElementById("customer_fname").value.length > 15)
	{
		document.getElementById("errcustomer_fname").innerHTML="Customer First name not contain less than 15 characters...";
		errchk = "True";
	}
	if(!document.getElementById("customer_fname").value.match(alphaSpaceExp))
	{
		document.getElementById("errcustomer_fname").innerHTML = "Kindly enter valid Customer First name..";
		errchk = "True";
	}
	if(document.getElementById("customer_fname").value == "")
	{
		document.getElementById("errcustomer_fname").innerHTML="Customer First name should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("customer_lname").value.length > 15)
	{
		document.getElementById("errcustomer_lname").innerHTML="Customer Last name not contain less than 15 characters...";
		errchk = "True";
	}
	if(!document.getElementById("customer_lname").value.match(alphaSpaceExp))
	{
		document.getElementById("errcustomer_lname").innerHTML = "Kindly enter valid Customer Last name..";
		errchk = "True";
	}
	if(document.getElementById("customer_lname").value == "")
	{
		document.getElementById("errcustomer_lname").innerHTML="Customer Last name should not be empty...";
		errchk = "True";
	}
	if(!document.getElementById("email_id").value.match(emailExp))
	{
		document.getElementById("erremail_id").innerHTML = "Entered Email ID is not valid....";
		errchk = "True";
	}
	if(document.getElementById("email_id").value == "")
	{
		document.getElementById("erremail_id").innerHTML="Kindly enter Email ID.";
		errchk = "True";
	}	
	if(document.getElementById("address").value == "")
	{
		document.getElementById("erraddress").innerHTML="Address Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("state").value.match(alphaSpaceExp))
	{
		document.getElementById("errstate").innerHTML = "State should contain alphabets....";
		errchk = "True";
	}
	if(document.getElementById("state").value == "")
	{
		document.getElementById("errstate").innerHTML="State Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("city").value.match(alphaSpaceExp))
	{
		document.getElementById("errcity").innerHTML = "City should contain alphabets....";
		errchk = "True";
	}
	if(document.getElementById("city").value == "")
	{
		document.getElementById("errcity").innerHTML="City should not be empty..";
		errchk = "True";
	}
	
	/*if(document.getElementById("postalcode").value.length != 6)
	{
		document.getElementById("errpostalcode").innerHTML="POSTAL Code should contain 6 digits..";
		errchk = "True";
	}
	if(!document.getElementById("postalcode").value.match(numericExp))
	{
		document.getElementById("errpostalcode").innerHTML = "POSTAL code should contain digits....";
		errchk = "True";
	}
	if(document.getElementById("postalcode").value == "")
	{
		document.getElementById("errpostalcode").innerHTML="POSTAL Code should not be empty..";
		errchk = "True";
	}
	/*
	if(document.getElementById("mobile_no").value.length != 13)
	{
		document.getElementById("errmobile_no").innerHTML="Mobile Number should contain 10 digits..";
		errchk = "True";
	}
	*/
	if(document.getElementById("mobile_no").value == "")
	{
		document.getElementById("errmobile_no").innerHTML="Mobile number should not be empty..";
		errchk = "True";
	}
	if(errchk == "True")
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<script>
$('#state').val('<?php echo $rsedit['state']; ?>');
/*
$("#mobile_no").keydown(function(e) {
    var oldvalue=$(this).val();
    var field=this;
    setTimeout(function () {
        if(field.value.indexOf('+91') !== 0) {
            $(field).val(oldvalue);
        } 
    }, 1);
});
*/
</script>