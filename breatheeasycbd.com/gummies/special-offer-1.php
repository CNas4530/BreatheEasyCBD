<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['productName']; ?> | Special Offer!</title>
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
	
	<div class="notcomplete-notification" style="display:none;">
		<span>YOUR ORDER IS NOT COMPLETE - DO NOT EXIT OR CLOSE THIS PAGE!</span>
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
				
			
			</div>
			<div id="order-coloum-right">
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

        $('.notcomplete-notification').delay(1000).slideDown();
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
</script>

<div id="blocker" style="position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.7);display:none">
	<div style="position:fixed;top:50%;left:50%;margin-top:-100px;margin-left:-100px;width:200px;height:200px;box-sizing:border-box;border:5px solid red;border-radius:12px;background-image:url(ajax-loader.gif);background-position:center;background-color:white;background-repeat:no-repeat;padding:12px;font-size:16px;font-weight:bold;text-align:center;">
		Placing Order...
	</div>
</div>


</body>
</html>
