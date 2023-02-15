<?php
include("header.php");
?>
<div class="content-wraper mt-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="customer-login-register">
<!-- banner -->
	<div class="banner">
		<?php
		include("sidebar.php");
		?>
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">

			<div class="checkout-left row">	
<div class="col-md-3"></div>
				<div class="col-md-6">
				<?php				
	if($_GET['status'] == "failed")
	{
		echo "<centeR><b style='color: red;'>Paypal Transaction Failed. Kindly try again..</b></center>";
	}
?>
		<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >				
		<tr>
		    <th>Deposit amount</th>
		    <td>
			<?php
			$sql = "SELECT IFNULL(SUM(purchase_amount),0) FROM billing WHERE customer_id='" . $_SESSION['customer_id'] . "' and status='Active' and payment_type='Deposit'";
			$qsql = mysqli_query($con,$sql);
			$rs = mysqli_fetch_array($qsql);
			echo $currencysymbol . $depamt =  $rs[0];
			?>
			</td>
		</tr>

		<tr>
		    <th>Withdrawn amount</th>
		    <td>
			<?php
			$sql = "SELECT IFNULL(SUM(paid_amount),0) FROM payment WHERE customer_id='" . $_SESSION['customer_id'] . "' and status='Active' and payment_type='Bid'";
			$qsql = mysqli_query($con,$sql);
			$rs = mysqli_fetch_array($qsql);
			echo $currencysymbol  . $widamt = $rs[0];
			?></td>
		</tr>

		<tr>
		    <th>Balance amount</th>
		    <td><?php echo $currencysymbol; ?> &nbsp<?php echo $depamt-$widamt; ?></td>
		</tr>

		
		</table>
</div>
		<div class="col-md-3"></div>
</div>
		<hr>
		
			

			<div class="checkout-left row">	
<div class="col-md-3"></div>
				<div class="col-md-6">
				<center><h3>Deposit <span>Amount to Bid</span></h3></center>
				<form action="" method="post" class="creditly-card-form agileinfo_form" onsubmit="return validateform()">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
											<div class="first-row form-group">
											<div class="w3_agileits_card_number_grid_right">
	

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Deposit amount <span class="errormsg"  id="errpaid_amount"></span></label>
		<input name="paid_amount" id="paid_amount" class="form-control" type="text" placeholder="Deposit amount" value="<?php echo $rsedit['paid_amount']; ?>">
	</div>
</div>

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
<div class="col-md-3"></div>
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
<!--<script src="https://www.paypal.com/sdk/js?client-id=ATfvpXP3eWeABU46mKtkx8BA4J4ue-DCEoChNZ86ml4WLoYR9-1MrCvLyfUk8v-K1bwU2ldfnwP1iVEX&disable-funding=credit,card"></script>-->
<script src="https://www.paypal.com/sdk/js?client-id=ATfvpXP3eWeABU46mKtkx8BA4J4ue-DCEoChNZ86ml4WLoYR9-1MrCvLyfUk8v-K1bwU2ldfnwP1iVEX"></script>
<script>
paypal.Buttons({
createOrder: function (data, actions) {
	/* #######start 1######### */
	var alphaspaceExp = /^[a-zA-Z\s]+$/;//Variable to validate only alphabets with space
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	$("span").html("");
	var i=0;
	/* ########end 1######## */
	if(!document.getElementById("paid_amount").value.match(numericExpression))
	{
		document.getElementById("errpaid_amount").innerHTML ="Amount must be digits...";	
		i=1;		
	}
	if(document.getElementById("paid_amount").value=="")
	{
		document.getElementById("errpaid_amount").innerHTML ="Paid amount should not be empty....";	
		i=1;		
	}
	/* #######start 2######### */
	if(i==0)
	{
		return actions.order.create({
		purchase_units : [{
			amount: {
				value: $('#paid_amount').val()
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
		$.post("jsdeposit.php",
		{
			paid_amount: $('#paid_amount').val(),
			payment_detail: details
		},
		function(paymentid){
			alert("You have deposited " + $('#paid_amount').val() +" successfully...");
			window.location="paymentreceipt.php?paymentid="+paymentid;
		});
	})
},
onCancel: function (data) {
	window.location.replace("deposit.php?status=failed")
}
}).render('#paypal-payment-button');
</script>