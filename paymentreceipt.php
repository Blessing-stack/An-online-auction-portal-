<?php
include("header.php");
$sqlpayment = "SELECT * FROM billing LEFT JOIN customer ON customer.customer_id=billing.customer_id WHERE billing_id='$_GET[paymentid]'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
echo mysqli_error($con);
$rspayment= mysqli_fetch_array($qsqlpayment);
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

			<div class="agileinfo_single">
		
				<div class="col-md-12 agileinfo_single_right">
					
						
				<h2>Payment Receipt</h2>
				
					<div class="snipcart-item block">
						<div class="w3agile_description">
<div id="printableArea">
<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >		
       <tr>
	   <th colspan="3"><center>Online Auction Hub</center></th>
	   </tr>
	   <tr>
	   <th colspan="3"><center>city light Mangalore</center></th>
	   </tr>
		<tr>
			<td><b>Bill No.</b> <?php echo $rspayment['billing_id']; ?> </td>
			<td><b>Date</b>  <?php echo $rspayment['purchase_date']; ?></td>
		</tr>
		<tr>
		    <td><b>Customer</b> <?php echo $rspayment['customer_fname']; ?> <?php echo $rspayment['customer_lname']; ?></td>
			<td><b>Payment type</b> <?php echo $rspayment['card_type']; ?></td>
		</tr>
			<tr>
			<th><b>Paid amount</b></th>
			<td><?php echo $ $currencysymbol; ?>  <?php echo $rspayment['purchase_amount']; ?>
			</td>
			</tr>
		<tr>
		<th>Previous balance</th>
		<td>
				<?php
				$sql = "SELECT SUM(purchase_amount) FROM billing WHERE customer_id='" . $_SESSION['customer_id'] . "' and status='Active' and payment_type='Deposit'";
				$qsql = mysqli_query($con,$sql);
				$rs = mysqli_fetch_array($qsql);
				$depamt =  $rs[0];
				?>
				<?php
				$sql = "SELECT SUM(paid_amount) FROM payment WHERE customer_id='" . $_SESSION['customer_id'] . "' and status='Active' and payment_type='Bid'";
				$qsql = mysqli_query($con,$sql);
				$rs = mysqli_fetch_array($qsql);
				$widamt = $rs[0];
				?><?php echo $ $currencysymbol; ?>   <?php echo ($depamt)-($widamt+$rspayment['purchase_amount']); ?>
		
		</td>
		</tr>
		<tr>
		<th>Balanced amount</th>
		<td><?php echo $ $currencysymbol; ?>   <?php echo ($depamt)-($widamt); ?>
		</td>
		</tr>
</table>
</div>
<hr>
<center><input type="button" name='print'  onclick="printDiv('printableArea')" value="Click here to Print" class="btn btn-primary"></center>
<hr>

						</div>	
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
                            </div>
                        </div>
					</div>
                </div>
            </div>

<!-- //banner -->
<?php
include("footer.php");
?>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>