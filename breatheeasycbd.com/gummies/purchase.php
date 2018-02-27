<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
	
	// If visitor has already purchased - redirect to upsale path
	if(@$_SESSION['Order']['mainSuccess'] == 1) {
		// Redirect to Special Offer #1
		$forwardUrl = $config['upsaleUrl'].'?orderId='.$_SESSION['Order']['orderId'];
		header("LOCATION: $forwardUrl");
		exit;
	}
	
	// Calculate Estimated Arrival Date
	$arrivalDate = date('F j, Y');
	
	// Set Default Product and/or Re-Select Previously Selected Product
	switch(@$_SESSION['Order']['packageSelection']) {
		case 2287:
			$productSelection = $_SESSION['Order']['packageSelection'];
			break;
		case 2286:
			$productSelection = $_SESSION['Order']['packageSelection'];
			break;
		case 2285:
			$productSelection = $_SESSION['Order']['packageSelection'];
			break;
		default:
			$productSelection = 2287;
			break;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['productName']; ?> | Checkout</title>
	<link href="ordercss/style.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<link href="ordercss/order_responsive.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="orderjs/jquery.min.js"></script>
	<script type="text/javascript" src="orderjs/jquery.validate.min.js"></script>
	<script type="text/javascript" src="orderjs/countries.js"></script>
	<script type="text/javascript" src="orderjs/offer.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<style>
		#sameship2 {display:none}
		#sameship:checked ~ #sameship2 {display:block;}
		.desktoponly {display:block;}
		.mobileonly {display:none}
		@media(max-width:1000px) {
			.desktoponly {display:none}
			.mobileonly {display:block}
			
		}
		@media(min-width:600px) {
			.bigger {font-size:15px}
		}
		.checkoutstripe {background-color:white;}
		.checkoutstripe .container {max-width:1070px;margin:0 auto;position:relative}
		
		.checkoutstripe .container {height:auto;min-height;84px;vertical-align:middle;line-height:84px;}
		.checkoutstripe .container  img {vertical-align:middle;}
		.steps {display:block;margin:0 auto;max-width:100%;padding-top:18px}
		.usa {float:right;max-width:40vw;padding-top:20px;padding-bottom:20px;}
		.hllogo {float:left;max-width:40vw;padding-top:12px}
		.warn {padding:10px;border:1px solid #989594;color:#395F24;background-color:#d9e8d4;text-align:middle;margin-bottom:12px;text-align:center;font-family:Open Sans, sans-serif;font-size:16px;}
		.warn img {vertical-align:middle;padding-right:10px;font-size:16px;}
		.summary {font-size:14px;font-family:Open Sans, sans-serif;color:#555555;font-weight:300;margin-bottom:20px;}
		.summary b {font-weight:700;color:#ED145B}
		.claim {margin-left:-24px;}
		@media(max-width:800px) {
			.claim {margin-left:0}
		}
	</style>


</head>
<body>
<div id="pagecontainer">
	
	<div class="discount-confirmation" style="display:none;"><span>
Less than 175 discounted bottles remaining in this program!
</span>
	</div>
	<div id="checkoutpagecontainer">
		<div style="padding:30px 0">
			<div class="checkoutstripe">
				<div class="container">
					<img src="orderimages/hllogo.png" alt="Healthy Leaf" class="hllogo">
					<img src="orderimages/us.png" alt="Special USA Only Internet Offer" class="usa">
					<img src="orderimages/steps.png" class="steps">
					<div style="clear:both"></div>
				</div>
			
			</div></div>
		
		
		<div class="order-header">
		</div>
		
		<div class="order-bg-outer">
			<center class="mobileonly"><!--Tap a Package to Select It...--></center>
			<div id="order-coloum-left">
				<div class="warn">
					<img src="orderimages/eye.png"> 7 others are viewing this offer right now - <span id="ticker">00:00</span>
				</div>
				<script>
                    var secs=0;
                    function tick() {
                        secs++;
                        mins=Math.floor(secs/60);
                        ds=secs-(mins*60);
                        if(mins<10) mins="0"+mins;
                        if(ds<10) ds="0"+ds;
                        document.getElementById("ticker").innerHTML=mins+":"+ds;
                        setTimeout(tick,1000);
                    }
                    tick();
				</script>
				
				<div class="summary">
					<span style="font-size:24px;font-weight:bold"><span style="color:#ee306a">Hi!</span> Act Now So You Don't Miss Out On This Offer!</span><br /><br />
					Current Availability&nbsp;&nbsp; <img src="orderimages/stock.png" style="vertical-align:middle"> <b>LOW STOCK</b> Sell-out Risk: <b>HIGH</b><br />
					Enjoy your FREE SHIPPING TODAY!<br />
					Your order is scheduled to arrive by <b><?php echo $arrivalDate; ?></b>
				</div>
				
				<hr>
				<div style="cursor:pointer" onclick="selectitem(2287)" class="prod" id="product2287"><div><img src="orderimages/2287.png"></div><h2>Buy 3 Get 2 Free</h2>5 pack of 300mg pure cbd gummies. <span class="bigprice"><b>$<span id="price2287"></span></b>/bottle <i>Free Shipping!</i></span><img id="select2287" src="orderimages/select.png" class="selectbutton"><div style="clear:both;float:none"></div></div><hr><div style="cursor:pointer" onclick="selectitem(2286)" class="prod" id="product2286"><div><img src="orderimages/2286.png"></div><h2>Buy 2 Get 1 Free</h2>3 pack of 300mg pure cbd gummies. <span class="bigprice"><b>$<span id="price2286"></span></b>/bottle <i>Free Shipping!</i></span><img id="select2286" src="orderimages/select.png" class="selectbutton"><div style="clear:both;float:none"></div></div><hr><div style="cursor:pointer" onclick="selectitem(2285)" class="prod" id="product2285"><div><img src="orderimages/2285.png"></div><h2>One Month Supply</h2>1 bottle of 300mg pure cbd gummies. <span class="bigprice"><b>$<span id="price2285"></span></b>/bottle</span><img id="select2285" src="orderimages/select.png" class="selectbutton"><div style="clear:both;float:none"></div></div><hr>
				
				
				
				<div id="total-pricing">
					<div class="usps" style="width: 175px;float: left;text-align: center;">
					
					</div>
					<div class="summery" style="width: 380px;float: right;">
						<table border="0" cellpadding="0" cellspacing="5" width="100%">
							<tbody>
							
							<tr>
								<td align="right">Shipping Type:</td>
								<td align="right" style="">
<span class="shipping-type" id="shiptype">
Shipping
</span>
								</td>
							</tr>
							<tr>
								<td align="right">Shipping Price:</td>
								<td class="bold-price"><span class="shipping-price">$ <span id="finalship"></span></span></td>
							</tr>
							<tr>
								<td align="right">Sales Tax:</td>
								<td class="bold-price"><span class="shipping-price">$ <span id="finaltax"></span></span></td>
							</tr>
							<tr>
								<td style="text-align: right;">
									Your Total
								</td>
								<td class="bold-price">
									<span class="checkout-total">$<span id="finaltotal"></span> USD</span>
								</td>
							</tr>
							<tr style="font-size:12px;">
								<td style="text-align: right;">
									Retail:<span class="retail-price">$<span id="fake"></span></span>
								</td>
								<td style="text-align:right;">You Save: $<span id="save"></span></td>
							</tr>
							</tbody>
						</table>
						<img src="orderimages/carriers.png" style="max-width:100%;display:block;margin:0 auto">
					</div>
					
					<div style="clear: both;"></div>
				
				</div>
			
			</div>
			<div id="order-coloum-right" >
				<div id="checkoutcontainer">
					<div style="padding:20px;background-color:#5d5d5d;"><img src="orderimages/final.png" style="margin:0 auto;display:block;max-width:100%"></div>
					<div id="requiredError"></div>
					<div id="shortcheckoutcontainer">
						<script type="text/javascript">

                            function stopRKey(evt) {
                                var evt = (evt) ? evt : ((event) ? event : null);
                                var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
                                if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
                            }

                            document.onkeypress = stopRKey;
						
						</script>
						
						
						<script>
                            var luhnChk=function(a){return function(c){for(var l=c.length,b=1,s=0,v;l;)v=parseInt(c.charAt(--l),10),s+=(b^=1)?a[v]:v;return s&&0===s%10}}([0,2,4,6,8,1,3,5,7,9]);
                            function suppress() {

                                if(document.getElementById("cardnumber").value.substring(0,1)!="4" &&document.getElementById("cardnumber").value.substring(0,1)!="5" &&document.getElementById("cardnumber").value.substring(0,1)!="6") {
                                    alert("We only Visa, Mastercard and Discover Card.");
                                    return false;
                                }
                                if(!luhnChk(document.getElementById("cardnumber").value)) {
                                    alert("Please enter a valid card number");

                                    return false;
                                }
                                document.getElementById("checkoutsubmitbutton").disabled=true;
                                document.getElementById("blocker").style.display="block";


                                return true;
                            }
                            function desuppress() {

                                document.getElementById("checkoutsubmitbutton").disabled=false;

                            }
						
						</script>
						<form id="fullcheckoutform" class="checkoutform" name="pay_form" method="POST" action="processor.php" onsubmit="return suppress()">
							<input type="hidden" name="Product" value="<?php echo $productSelection; ?>" id="prod">
							<input type="hidden" name="coupon" id="coupon" value="<?php echo @$_SESSION['Contact']['coupon']; ?>">
							
							
							
							<div style="clear:both;">
								<label>First Name:</label>
								<input id="firstname" name="firstname" value="<?php echo @$_SESSION['Contact']['firstname']; ?>" type="text" required>
							</div>
							<div style="clear:both;">
								<label>Last Name:</label>
								<input id="lastname" name="lastname" value="<?php echo @$_SESSION['Contact']['lastname']; ?>" type="text" required>
							</div>
							<div style="clear:both;">
								<label>Address:</label>
								<input id="address" name="address" value="<?php echo @$_SESSION['Contact']['address']; ?>" type="text" required>
							</div>
							<div style="clear:both;">
								<label>City:</label>
								<input id="city" name="city" value="<?php echo @$_SESSION['Contact']['city']; ?>" type="text" required>
							</div>
							<div style="clear:both;">
								
								<label>State/Province</label>
								<select name="state" id="state" required>
									<option value="" <?php if(!@$_SESSION['Contact']['state']){ print 'selected="selected"'; } ?>>- Select State -</option>
									<option value="AL" <?php if(@$_SESSION['Contact']['state'] == 'AL'){ print 'selected="selected"'; } ?>>Alabama</option>
									<option value="AK" <?php if(@$_SESSION['Contact']['state'] == 'AK'){ print 'selected="selected"'; } ?>>Alaska</option>
									<option value="AZ" <?php if(@$_SESSION['Contact']['state'] == 'AZ'){ print 'selected="selected"'; } ?>>Arizona</option>
									<option value="AR" <?php if(@$_SESSION['Contact']['state'] == 'AR'){ print 'selected="selected"'; } ?>>Arkansas</option>
									<option value="CA" <?php if(@$_SESSION['Contact']['state'] == 'CA'){ print 'selected="selected"'; } ?>>California</option>
									<option value="CO" <?php if(@$_SESSION['Contact']['state'] == 'CO'){ print 'selected="selected"'; } ?>>Colorado</option>
									<option value="CT" <?php if(@$_SESSION['Contact']['state'] == 'CT'){ print 'selected="selected"'; } ?>>Connecticut</option>
									<option value="DE" <?php if(@$_SESSION['Contact']['state'] == 'DE'){ print 'selected="selected"'; } ?>>Delaware</option>
									<option value="DC" <?php if(@$_SESSION['Contact']['state'] == 'DC'){ print 'selected="selected"'; } ?>>District Of Columbia</option>
									<option value="FL" <?php if(@$_SESSION['Contact']['state'] == 'FL'){ print 'selected="selected"'; } ?>>Florida</option>
									<option value="GA" <?php if(@$_SESSION['Contact']['state'] == 'GA'){ print 'selected="selected"'; } ?>>Georgia</option>
									<option value="HI" <?php if(@$_SESSION['Contact']['state'] == 'HI'){ print 'selected="selected"'; } ?>>Hawaii</option>
									<option value="ID" <?php if(@$_SESSION['Contact']['state'] == 'ID'){ print 'selected="selected"'; } ?>>Idaho</option>
									<option value="IL" <?php if(@$_SESSION['Contact']['state'] == 'IL'){ print 'selected="selected"'; } ?>>Illinois</option>
									<option value="IN" <?php if(@$_SESSION['Contact']['state'] == 'IN'){ print 'selected="selected"'; } ?>>Indiana</option>
									<option value="IA" <?php if(@$_SESSION['Contact']['state'] == 'IA'){ print 'selected="selected"'; } ?>>Iowa</option>
									<option value="KS" <?php if(@$_SESSION['Contact']['state'] == 'KS'){ print 'selected="selected"'; } ?>>Kansas</option>
									<option value="KY" <?php if(@$_SESSION['Contact']['state'] == 'KY'){ print 'selected="selected"'; } ?>>Kentucky</option>
									<option value="LA" <?php if(@$_SESSION['Contact']['state'] == 'LA'){ print 'selected="selected"'; } ?>>Louisiana</option>
									<option value="ME" <?php if(@$_SESSION['Contact']['state'] == 'ME'){ print 'selected="selected"'; } ?>>Maine</option>
									<option value="MD" <?php if(@$_SESSION['Contact']['state'] == 'MD'){ print 'selected="selected"'; } ?>>Maryland</option>
									<option value="MA" <?php if(@$_SESSION['Contact']['state'] == 'MA'){ print 'selected="selected"'; } ?>>Massachusetts</option>
									<option value="MI" <?php if(@$_SESSION['Contact']['state'] == 'MI'){ print 'selected="selected"'; } ?>>Michigan</option>
									<option value="MN" <?php if(@$_SESSION['Contact']['state'] == 'MN'){ print 'selected="selected"'; } ?>>Minnesota</option>
									<option value="MS" <?php if(@$_SESSION['Contact']['state'] == 'MS'){ print 'selected="selected"'; } ?>>Mississippi</option>
									<option value="MO" <?php if(@$_SESSION['Contact']['state'] == 'MO'){ print 'selected="selected"'; } ?>>Missouri</option>
									<option value="MT" <?php if(@$_SESSION['Contact']['state'] == 'MT'){ print 'selected="selected"'; } ?>>Montana</option>
									<option value="NE" <?php if(@$_SESSION['Contact']['state'] == 'NE'){ print 'selected="selected"'; } ?>>Nebraska</option>
									<option value="NV" <?php if(@$_SESSION['Contact']['state'] == 'NV'){ print 'selected="selected"'; } ?>>Nevada</option>
									<option value="NH" <?php if(@$_SESSION['Contact']['state'] == 'NH'){ print 'selected="selected"'; } ?>>New Hampshire</option>
									<option value="NJ" <?php if(@$_SESSION['Contact']['state'] == 'NJ'){ print 'selected="selected"'; } ?>>New Jersey</option>
									<option value="NM" <?php if(@$_SESSION['Contact']['state'] == 'NM'){ print 'selected="selected"'; } ?>>New Mexico</option>
									<option value="NY" <?php if(@$_SESSION['Contact']['state'] == 'NY'){ print 'selected="selected"'; } ?>>New York</option>
									<option value="NC" <?php if(@$_SESSION['Contact']['state'] == 'NC'){ print 'selected="selected"'; } ?>>North Carolina</option>
									<option value="ND" <?php if(@$_SESSION['Contact']['state'] == 'ND'){ print 'selected="selected"'; } ?>>North Dakota</option>
									<option value="OH" <?php if(@$_SESSION['Contact']['state'] == 'OH'){ print 'selected="selected"'; } ?>>Ohio</option>
									<option value="OK" <?php if(@$_SESSION['Contact']['state'] == 'OK'){ print 'selected="selected"'; } ?>>Oklahoma</option>
									<option value="OR" <?php if(@$_SESSION['Contact']['state'] == 'OR'){ print 'selected="selected"'; } ?>>Oregon</option>
									<option value="PA" <?php if(@$_SESSION['Contact']['state'] == 'PA'){ print 'selected="selected"'; } ?>>Pennsylvania</option>
									<option value="RI" <?php if(@$_SESSION['Contact']['state'] == 'RI'){ print 'selected="selected"'; } ?>>Rhode Island</option>
									<option value="SC" <?php if(@$_SESSION['Contact']['state'] == 'SC'){ print 'selected="selected"'; } ?>>South Carolina</option>
									<option value="SD" <?php if(@$_SESSION['Contact']['state'] == 'SD'){ print 'selected="selected"'; } ?>>South Dakota</option>
									<option value="TN" <?php if(@$_SESSION['Contact']['state'] == 'TN'){ print 'selected="selected"'; } ?>>Tennessee</option>
									<option value="TX" <?php if(@$_SESSION['Contact']['state'] == 'TX'){ print 'selected="selected"'; } ?>>Texas</option>
									<option value="UT" <?php if(@$_SESSION['Contact']['state'] == 'UT'){ print 'selected="selected"'; } ?>>Utah</option>
									<option value="VT" <?php if(@$_SESSION['Contact']['state'] == 'VT'){ print 'selected="selected"'; } ?>>Vermont</option>
									<option value="VA" <?php if(@$_SESSION['Contact']['state'] == 'VA'){ print 'selected="selected"'; } ?>>Virginia</option>
									<option value="WA" <?php if(@$_SESSION['Contact']['state'] == 'WA'){ print 'selected="selected"'; } ?>>Washington</option>
									<option value="WV" <?php if(@$_SESSION['Contact']['state'] == 'WV'){ print 'selected="selected"'; } ?>>West Virginia</option>
									<option value="WI" <?php if(@$_SESSION['Contact']['state'] == 'WI'){ print 'selected="selected"'; } ?>>Wisconsin</option>
									<option value="WY" <?php if(@$_SESSION['Contact']['state'] == 'WY'){ print 'selected="selected"'; } ?>>Wyoming</option>
								</select>
							</div>
							<div style="clear:both;">
								<label>Zip Code:</label>
								<input id="zipcode" name="zipcode" value="<?php echo @$_SESSION['Contact']['zipcode']; ?>" type="text" required>
								<input id="country" name="country" value="US" type="hidden">
							</div>
							<div style="clear:both;">
								<label>Phone:</label>
								<input id="phone" name="phone" value="<?php echo @$_SESSION['Contact']['phone']; ?>" maxlength="10" type="text" required>
							</div>
							<div style="clear:both;">
								<label>Email:</label>
								<input id="email" name="email" value="<?php echo @$_SESSION['Contact']['email']; ?>" type="text" required>
							</div>
							<div style="clear:both"></div>
							<input type="checkbox" style="width:auto;padding-right:5px" id="sameship" name="sameship">&nbsp;&nbsp;Billing Address Different from Shipping?<br />
							<div id="sameship2">
								<h3 style="text-align:center">Billing Address</h3>
								
								<div style="clear:both;">
									<label>Address:</label>
									<input id="bill_address" name="bill_address" value="<?php echo @$_SESSION['Contact']['bill_address']; ?>" type="text">
								</div>
								<div style="clear:both;">
									<label>City:</label>
									<input id="bill_city" name="bill_city" value="<?php echo @$_SESSION['Contact']['bill_city']; ?>" type="text">
								</div>
								<div style="clear:both;">
									
									<label>State/Province</label>
									<select name="bill_state" id="Bstate">
										
										<option value="" <?php if(!@$_SESSION['Contact']['bill_state']){ print 'selected="selected"'; } ?>>- Select State -</option>
										<option value="AL" <?php if(@$_SESSION['Contact']['bill_state'] == 'AL'){ print 'selected="selected"'; } ?>>Alabama</option>
										<option value="AK" <?php if(@$_SESSION['Contact']['bill_state'] == 'AK'){ print 'selected="selected"'; } ?>>Alaska</option>
										<option value="AZ" <?php if(@$_SESSION['Contact']['bill_state'] == 'AZ'){ print 'selected="selected"'; } ?>>Arizona</option>
										<option value="AR" <?php if(@$_SESSION['Contact']['bill_state'] == 'AR'){ print 'selected="selected"'; } ?>>Arkansas</option>
										<option value="CA" <?php if(@$_SESSION['Contact']['bill_state'] == 'CA'){ print 'selected="selected"'; } ?>>California</option>
										<option value="CO" <?php if(@$_SESSION['Contact']['bill_state'] == 'CO'){ print 'selected="selected"'; } ?>>Colorado</option>
										<option value="CT" <?php if(@$_SESSION['Contact']['bill_state'] == 'CT'){ print 'selected="selected"'; } ?>>Connecticut</option>
										<option value="DE" <?php if(@$_SESSION['Contact']['bill_state'] == 'DE'){ print 'selected="selected"'; } ?>>Delaware</option>
										<option value="DC" <?php if(@$_SESSION['Contact']['bill_state'] == 'DC'){ print 'selected="selected"'; } ?>>District Of Columbia</option>
										<option value="FL" <?php if(@$_SESSION['Contact']['bill_state'] == 'FL'){ print 'selected="selected"'; } ?>>Florida</option>
										<option value="GA" <?php if(@$_SESSION['Contact']['bill_state'] == 'GA'){ print 'selected="selected"'; } ?>>Georgia</option>
										<option value="HI" <?php if(@$_SESSION['Contact']['bill_state'] == 'HI'){ print 'selected="selected"'; } ?>>Hawaii</option>
										<option value="ID" <?php if(@$_SESSION['Contact']['bill_state'] == 'ID'){ print 'selected="selected"'; } ?>>Idaho</option>
										<option value="IL" <?php if(@$_SESSION['Contact']['bill_state'] == 'IL'){ print 'selected="selected"'; } ?>>Illinois</option>
										<option value="IN" <?php if(@$_SESSION['Contact']['bill_state'] == 'IN'){ print 'selected="selected"'; } ?>>Indiana</option>
										<option value="IA" <?php if(@$_SESSION['Contact']['bill_state'] == 'IA'){ print 'selected="selected"'; } ?>>Iowa</option>
										<option value="KS" <?php if(@$_SESSION['Contact']['bill_state'] == 'KS'){ print 'selected="selected"'; } ?>>Kansas</option>
										<option value="KY" <?php if(@$_SESSION['Contact']['bill_state'] == 'KY'){ print 'selected="selected"'; } ?>>Kentucky</option>
										<option value="LA" <?php if(@$_SESSION['Contact']['bill_state'] == 'LA'){ print 'selected="selected"'; } ?>>Louisiana</option>
										<option value="ME" <?php if(@$_SESSION['Contact']['bill_state'] == 'ME'){ print 'selected="selected"'; } ?>>Maine</option>
										<option value="MD" <?php if(@$_SESSION['Contact']['bill_state'] == 'MD'){ print 'selected="selected"'; } ?>>Maryland</option>
										<option value="MA" <?php if(@$_SESSION['Contact']['bill_state'] == 'MA'){ print 'selected="selected"'; } ?>>Massachusetts</option>
										<option value="MI" <?php if(@$_SESSION['Contact']['bill_state'] == 'MI'){ print 'selected="selected"'; } ?>>Michigan</option>
										<option value="MN" <?php if(@$_SESSION['Contact']['bill_state'] == 'MN'){ print 'selected="selected"'; } ?>>Minnesota</option>
										<option value="MS" <?php if(@$_SESSION['Contact']['bill_state'] == 'MS'){ print 'selected="selected"'; } ?>>Mississippi</option>
										<option value="MO" <?php if(@$_SESSION['Contact']['bill_state'] == 'MO'){ print 'selected="selected"'; } ?>>Missouri</option>
										<option value="MT" <?php if(@$_SESSION['Contact']['bill_state'] == 'MT'){ print 'selected="selected"'; } ?>>Montana</option>
										<option value="NE" <?php if(@$_SESSION['Contact']['bill_state'] == 'NE'){ print 'selected="selected"'; } ?>>Nebraska</option>
										<option value="NV" <?php if(@$_SESSION['Contact']['bill_state'] == 'NV'){ print 'selected="selected"'; } ?>>Nevada</option>
										<option value="NH" <?php if(@$_SESSION['Contact']['bill_state'] == 'NH'){ print 'selected="selected"'; } ?>>New Hampshire</option>
										<option value="NJ" <?php if(@$_SESSION['Contact']['bill_state'] == 'NJ'){ print 'selected="selected"'; } ?>>New Jersey</option>
										<option value="NM" <?php if(@$_SESSION['Contact']['bill_state'] == 'NM'){ print 'selected="selected"'; } ?>>New Mexico</option>
										<option value="NY" <?php if(@$_SESSION['Contact']['bill_state'] == 'NY'){ print 'selected="selected"'; } ?>>New York</option>
										<option value="NC" <?php if(@$_SESSION['Contact']['bill_state'] == 'NC'){ print 'selected="selected"'; } ?>>North Carolina</option>
										<option value="ND" <?php if(@$_SESSION['Contact']['bill_state'] == 'ND'){ print 'selected="selected"'; } ?>>North Dakota</option>
										<option value="OH" <?php if(@$_SESSION['Contact']['bill_state'] == 'OH'){ print 'selected="selected"'; } ?>>Ohio</option>
										<option value="OK" <?php if(@$_SESSION['Contact']['bill_state'] == 'OK'){ print 'selected="selected"'; } ?>>Oklahoma</option>
										<option value="OR" <?php if(@$_SESSION['Contact']['bill_state'] == 'OR'){ print 'selected="selected"'; } ?>>Oregon</option>
										<option value="PA" <?php if(@$_SESSION['Contact']['bill_state'] == 'PA'){ print 'selected="selected"'; } ?>>Pennsylvania</option>
										<option value="RI" <?php if(@$_SESSION['Contact']['bill_state'] == 'RI'){ print 'selected="selected"'; } ?>>Rhode Island</option>
										<option value="SC" <?php if(@$_SESSION['Contact']['bill_state'] == 'SC'){ print 'selected="selected"'; } ?>>South Carolina</option>
										<option value="SD" <?php if(@$_SESSION['Contact']['bill_state'] == 'SD'){ print 'selected="selected"'; } ?>>South Dakota</option>
										<option value="TN" <?php if(@$_SESSION['Contact']['bill_state'] == 'TN'){ print 'selected="selected"'; } ?>>Tennessee</option>
										<option value="TX" <?php if(@$_SESSION['Contact']['bill_state'] == 'TX'){ print 'selected="selected"'; } ?>>Texas</option>
										<option value="UT" <?php if(@$_SESSION['Contact']['bill_state'] == 'UT'){ print 'selected="selected"'; } ?>>Utah</option>
										<option value="VT" <?php if(@$_SESSION['Contact']['bill_state'] == 'VT'){ print 'selected="selected"'; } ?>>Vermont</option>
										<option value="VA" <?php if(@$_SESSION['Contact']['bill_state'] == 'VA'){ print 'selected="selected"'; } ?>>Virginia</option>
										<option value="WA" <?php if(@$_SESSION['Contact']['bill_state'] == 'WA'){ print 'selected="selected"'; } ?>>Washington</option>
										<option value="WV" <?php if(@$_SESSION['Contact']['bill_state'] == 'WV'){ print 'selected="selected"'; } ?>>West Virginia</option>
										<option value="WI" <?php if(@$_SESSION['Contact']['bill_state'] == 'WI'){ print 'selected="selected"'; } ?>>Wisconsin</option>
										<option value="WY" <?php if(@$_SESSION['Contact']['bill_state'] == 'WY'){ print 'selected="selected"'; } ?>>Wyoming</option>
									</select>
								</div>
								<div style="clear:both;">
									<label>Zip Code:</label>
									<input id="bill_zipcode" name="bill_zipcode" value="<?php echo @$_SESSION['Contact']['bill_zipcode']; ?>" type="text">
									<input id="bill_country" name="bill_country" value="US" type="hidden">
								</div>
							</div>
							
							<div style="clear:both;">
								<label>We Accept:</label>
								<p> <img src="orderimages/cards.png" class="weaccept" alt=""> <br>
							
							</div>
							<div style="clear:both;">
								<label>Card Type:</label>
								<select name="cardcompany" id="cardcompany" style="width:141px" required>
									<option selected="selected" value="">Select Card Type
									<option value="VISA">Visa
									<option value="MASTERCARD">MasterCard
									<option value="DISCOVER">Discover Card</option>
								</select>
							</div>
							<div style="clear:both;">
								<label>CC #:</label>
								<input name="card_number" id="cardnumber" maxlength="16" autocomplete="off" size="20" required>
							</div>
							<div style="clear:both;">
								<label>Exp. Date:</label>
								<select name="card_expMonth" id="cardmonth" style="width: 60px" required>
									<option selected="selected" value="">MM
									<option value="01">01
									<option value="02">02
									<option value="03">03
									<option value="04">04
									<option value="05">05
									<option value="06">06
									<option value="07">07
									<option value="08">08
									<option value="09">09
									<option value="10">10
									<option value="11">11
									<option value="12">12
								</select>
								
								<select name="card_expYear" id="cardyear" style="width: 77px" required>
									<option selected="selected" value="">YYYY</option>
									<option>2018</option><option>2019</option><option>2020</option><option>2021</option><option>2022</option><option>2023</option><option>2024</option><option>2025</option><option>2026</option><option>2027</option><option>2028</option><option>2029</option><option>2030</option><option>2031</option><option>2032</option><option>2033</option><option>2034</option><option>2035</option><option>2036</option><option>2037</option><option>2038</option>
								</select>
							
							</div>
							<div style="clear:both;">
								<label>CVV:</label>
								<input name="card_CVV" id="cardcode" size="5" maxlength="4" autocomplete="off" style="width: 56px" required>
								<b><a href="orderimages/CVV.jpg" onclick="javascript:void window.open ('orderimages/CVV.jpg','','width=650,height=500,toolbar=0,menu bar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0'); return false;" style="font-size: 12px;margin-left: 5px;">What's this?</a></b>
							</div>
							<div style="clear:both;"></div>
							<div id="requiredError"></div>
							<style>
								#fullcheckoutform div {padding:6px 0}
								@keyframes  bulge{0 {transform:scale(1,1);}
								50% { transform:scale(1.1,1.1);}
								100% { transform:scale(1,1);}
								}
								
								@keyframes  pulse{
								0 {opacity:1}
								50% { opacity:0}
								100% { opacity:1}
								}
								
								
								.discount-confirmation span {animation-name: pulse; animation-duration:2s;animation-iteration-count: infinite}
							
							
							</style>
							
							
							<div class="shifted"><button id="checkoutsubmitbutton" type="submit" onclick="ShowExitPopup = false;" style="background:none;"><img src="orderimages/get.png"></button></div>
							<div style="padding:17px 0;padding-top:10px;text-align:center;color:#555555,">
								<img src="orderimages/tinylock.png" style="margin-right:10px">Secure 256-Bit Encrypted Connection
							</div>
							<img src="orderimages/3dsecure.png" style="margin:10px auto;padding:10px 0; max-width:100%;display:block">
						</form>
					</div>
					<div style="clear:both"></div>
				</div>
				<span style="font-family:Times New Roman, serif;font-size:14px;color:#999999"><center>
<strong>Notice:</strong>
<span>
This is not a continuity or recurring order.<br />This is a one-time charge. </center>
</span>
				</span>
				<!--<center style="width:300px;">
<i><b>*Autoship Item:</i></b><br />
Due to high demand, we require a commitment to a subscription package. This means you will automatically be charged and sent one bottle of Healthy Leaf CBD oil every 30 days once you've ran out of your supply.
</center>-->
			
			</div>
			
			<div style="clear: both;"></div>
		</div>
		
		
		<span style=" padding: 0px; margin: 0px; border: 0px; position: fixed; bottom: 0px; top: auto; right: auto; left: 0px; z-index: 10001; background-color: transparent; height: auto; width: auto;" class="safe-buy">
<img src="orderimages/safe321.png" border="0" style="vertical-align: bottom;">
</span>
		<style type="text/css">#people_shopping_for{background:#edc52d;border:1px solid #ba9712;border-bottom:none;width:300px;height:63px;position:fixed;bottom:-70px;right:10px;font-family:Arial,Helvetica,sans-serif;font-size:14px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:15px 0 0 18px;-webkit-box-shadow:0 0 7px 2px rgba(0,0,0,.3);box-shadow:0 0 7px 2px rgba(0,0,0,.3);overflow:hidden;z-index:9999;}#close_people_shopping_for{position:absolute;top:0;right:5px;text-decoration:none;font-size:14px;font-weight:bold;color:#5d5d5d;}
			@media(max-width:500px) {
				#people_shopping_for {display:none}
			}
			.right a {color:#555555;}
		</style>
	</div>

</div>
<div id="people_shopping_for">
	<a href="" id="close_people_shopping_for">x</a>
	Most recent purchase of this product: less than
	<script language="Javascript">
        var rand_no = Math.floor((3-0)*Math.random()) + 1;
        document.write(rand_no);
	</script> minutes ago.
</div>

<div style="clear:both;height:10px"></div>
<div id="chk_footer">
	<div class="left">
		Copyright &copy;<?php echo date('Y'); ?> <b><?php echo $config['productName']; ?> | All Rights Reserved.</b>
	</div>
	<div class="right">
		<a href="#" onclick="javascript:void window.open ('terms.php','Terms and Conditions','width=650,height=500,toolbar=0,menu bar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0'); return false;">Terms and Conditions</a>
		&nbsp;|&nbsp;
		<a href="#" onclick="javascript:void window.open ('privacy.php','Privacy Policy','width=650,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">Privacy Policy</a>
	</div>
</div>
<div style="clear;both;"></div>

<br><script type="text/javascript">


</script>
<div id="hiddenOverlay"></div>
<div id="couponpath" style="display:none;">
	<a style="cursor:pointer" onclick="allcoupon('20OFF');document.getElementById('hiddenOverlay').style.display='none';document.getElementById('couponpath').style.display='none'"><img src="orderimages/coupon1.jpg"></a>
</div>
<span style="display: inline; padding: 0px; margin: 0px; border: 0px; position: fixed; bottom: 0px; top: auto; right: auto; left: 0px; z-index: 10001; background-color: transparent; height: auto; width: auto;" class="safe-buy">
<img src="orderimages/safe321.png" border="0" style="vertical-align: bottom;">
</span>
</div>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.discount-confirmation').delay(2000).slideDown();

        setTimeout(function() {
            $('#people_shopping_for').animate({
                bottom: '0px'
            }, 500);
        }, 1500);
        $(document).on('click', '#close_people_shopping_for', function(e) {
            e.preventDefault();
            $('#people_shopping_for').animate({
                bottom: '-70px'
            }, 500);
        });
    });

    jQuery(document).ready(function() {
        setInterval(function() {
            jQuery('#product_header_box').find('.active').fadeOut(500, function() {
                jQuery('#product_header_box').find('.rotate').toggleClass('active').promise().done(function() {
                    jQuery('#product_header_box').find('.active').fadeIn().animate({
                        top : '6px'
                    }, 500);
                });

            });

        }, 5000); // end interval
    });
</script>
<script type="text/javascript">
    var ShowExitPopup=false;
    window.onbeforeunload = function() {
        if(ShowExitPopup){
			/*document.getElementById("coupon").value="10OFF";
			 ShowExitPopup = false;
			 document.getElementById("hiddenOverlay").style.display = "block";
			 document.getElementById("couponpath").style.display = "block";
			 document.getElementById("amt1").innerHTML="32.05*";
			 document.getElementById("amt2").innerHTML="43.05*";
			 document.getElementById("amt3").innerHTML="61.96*";
			 console.log(444);
			 $("div.product-option.checked").click();
			 console.log(446);*/
            return "";
        }
    };




    $(".product-option").click(function(){
        $(".checked").removeClass("checked");
        $(this).addClass("checked");
    });
</script>

<div id="blocker" style="position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.7);display:none">
	<div style="position:fixed;top:50%;left:50%;margin-top:-100px;margin-left:-100px;width:200px;height:200px;box-sizing:border-box;border:5px solid red;border-radius:12px;background-image:url(ajax-loader.gif);background-position:center;background-color:white;background-repeat:no-repeat;padding:12px;font-size:16px;font-weight:bold;text-align:center;">
		Placing Order...
	</div>
</div>



<script type="text/javascript">
    var ShowExitPopup=false;
    window.onbeforeunload = function() {
        if(ShowExitPopup){

            ShowExitPopup = false;
            document.getElementById("hiddenOverlay").style.display = "block";
            document.getElementById("couponpath").style.display = "block";
            $("div.discount-confirmation").html("Additional discount activated: save a total of 50% plus free shipping available!");
            return "";
        }
    };
</script>


<script>
    var prices=new Array();
    var shippings=new Array();
    var quantities=new Array();
    var rebates=new Array();
    prices[2287]=195
    shippings[2287]=0
    quantities[2287]=1
    rebates[2287]=0
    prices[2286]=147
    shippings[2286]=0
    quantities[2286]=1
    rebates[2286]=0
    prices[2285]=69
    shippings[2285]=5.95
    quantities[2285]=1
    rebates[2285]=0
    function fake(item) {
        switch(item){
            case 2287: return "399.95";
            case 2286: return "239.97";
            case 2285: return "79.99";

        }
        return "399.95";
    }
    function ship(item) {
        return shippings[item].toFixed(2);

    }
    function totals(item, coupon) {
        pr=prices[item]
        if(coupon=="10OFF") pr=pr*.9;
        if(coupon=="20OFF") pr=pr*.8;
        if(coupon=="30OFF") pr=pr*.7;
        if(coupon=="40OFF") pr=pr*.6;
        if(coupon=="50OFF") pr=pr*.5;
        if(coupon=="60OFF") pr=pr*.4;
        if(coupon=="70OFF") pr=pr*.3;
        if(coupon=="80OFF") pr=pr*.2;
        if(coupon=="90OFF") pr=pr*.1;
        return pr.toFixed(2);

    }
    function price(item, coupon) {
        pr=prices[item]
        if(coupon=="10OFF") pr=pr*.9;
        if(coupon=="20OFF") pr=pr*.8;
        if(coupon=="30OFF") pr=pr*.7;
        if(coupon=="40OFF") pr=pr*.6;
        if(coupon=="50OFF") pr=pr*.5;
        if(coupon=="60OFF") pr=pr*.4;
        if(coupon=="70OFF") pr=pr*.3;
        if(coupon=="80OFF") pr=pr*.2;
        if(coupon=="90OFF") pr=pr*.1;


        pr=pr  - rebates[item];
        pr=pr / quantities[item];
        return pr.toFixed(2);






    }
    function tax(item, coupon) {
        if(document.getElementById("state").value.toUpperCase()=="")
            return ((totals(item,coupon))*(0/100)).toFixed(2);
        else
            return (0).toFixed(2);

    }
    function selectitem(item) {
        document.getElementById("prod").value=item;
        divs=document.querySelectorAll(".prod");
        for(i=0;i<divs.length;i++)
            divs[i].className="prod";

        divs=document.querySelectorAll(".selectbutton");
        for(i=0;i<divs.length;i++)
            divs[i].src="orderimages/select.png";

        document.getElementById("select"+item).src="orderimages/selectedlit.png";


        document.getElementById("product"+item).className="selectedprod prod";

        //document.getElementById("finalprice").innerHTML=price(item, document.getElementById("coupon").value);
        document.getElementById("finalship").innerHTML=ship(item);
        document.getElementById("finaltax").innerHTML=tax(item,document.getElementById("coupon").value);
        if(ship(item) ==0.00) document.getElementById("shiptype").innerHTML="Free Shipping"; else document.getElementById("shiptype").innerHTML="Shipping";
        document.getElementById("finaltotal").innerHTML=(totals(item, document.getElementById("coupon").value) - (-1*tax(item, document.getElementById("coupon").value))-(-1*ship(item))).toFixed(2);
        document.getElementById("fake").innerHTML=fake(item);
        document.getElementById("save").innerHTML=(fake(item)-totals(item, document.getElementById("coupon").value) -ship(item)).toFixed(2);
    }
    function allcoupon(coupon) {
        console.log(coupon);
        document.getElementById('coupon').value=coupon;
        pr=price(2287,coupon);pr=(pr/5).toFixed(2);document.getElementById("price2287").innerHTML=pr;pr=price(2286,coupon);pr=(pr/3).toFixed(2);document.getElementById("price2286").innerHTML=pr;pr=price(2285,coupon);document.getElementById("price2285").innerHTML=pr;
        selectitem(document.getElementById("prod").value);
    }
</script>




<script>
    selectitem(<?php echo $productSelection; ?>);
    allcoupon("")

</script>


</body>
</html>
