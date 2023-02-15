<?php
include("header.php");
$sqlproduct = "SELECT * FROM product WHERE product_id='$_GET[productid]'";
$qsqlproduct = mysqli_query($con,$sqlproduct);
$rsproduct= mysqli_fetch_array($qsqlproduct);
?>
<div class="content-wraper mt-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3"></div>
                        <div class="col-lg-9 col-md-6 col-sm-6">
                            <div class="customer-login-register">
							
<!-- banner -->
	<div class="banner">
		<?php
		include("sidebar.php");
		?>
		<div class="w3l_banner_nav_right">
<!-- about -->

		<div class="privacy about">
<?php				
	if($_GET['status'] == "failed")
	{
		echo "<centeR><b style='color: red;'>Paypal Transaction Failed. Kindly try again..</b></center>";
	}
?>		
			

			<div class="checkout-left">	

				<div class="col-md-8 ">
				<center><h3>Billing <span>Form</span></h3></center>
				<form action="" method="post" onsubmit="return validateform()" class="creditly-card-form agileinfo_form">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
											<div class="first-row form-group">
	<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >				
		<tr>
		    <th>Product name</th>
		    <td>
			<?php
				echo $rsproduct['product_name'];
			?>
			</td>
		</tr>
		<tr>
		    <th>Charges</th>
		    <td>
			<?php echo $currencysymbol; ?> 100
			<input type="hidden" name="charge" id="charge"  value="100" >
			<input type="hidden" name="productid" id="productid"  value="<?php echo $_GET['productid']; ?>" >
			</td>
			</tr>
	</table>		

<hr>
<center>
<div id="paypal-payment-button"></div>
</center>

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
					</div>
                </div>
            </div>

<?php
include("footer.php");
?>
<script src="https://www.paypal.com/sdk/js?client-id=ATfvpXP3eWeABU46mKtkx8BA4J4ue-DCEoChNZ86ml4WLoYR9-1MrCvLyfUk8v-K1bwU2ldfnwP1iVEX"></script>
<script>
paypal.Buttons({
createOrder: function (data, actions) {
	/* #######start 1######### */
	var alphaExp = /^[a-zA-Z\s]+$/;	//Variable to validate only alphabets
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	$("span").html("");
	var i=0;
	if(i==0)
	{
		return actions.order.create({
		purchase_units : [{
			amount: {
				value: $('#charge').val()
			}
		}]
		});
	}
	else
	{
		return false;
	}
	/* #######end 2######### */
},
onApprove: function (data, actions) {
	return actions.order.capture().then(function (details) {
		//console.log(details)
		//window.location.replace("deposit.php?status=success")
		$.post("jsbilling.php",
		{
			paid_amount: $('#charge').val(),
			productid:$('#productid').val(),
			payment_detail: details
		},
		function(paymentid){
			alert("You have deposited " + $('#charge').val() +" successfully...");
			window.location="billingreceipt.php?billingid="+paymentid;
		});
	})
},
onCancel: function (data) {
	window.location.replace("billing.php?status=failed")
}
}).render('#paypal-payment-button');
</script>