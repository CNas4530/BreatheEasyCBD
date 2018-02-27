<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
	
	$urlParams = array();
	
	// get Order ID
	$orderId = @$_SESSION['Order']['orderId'];
	if(!@$orderId) {
		$orderId = @$_GET['orderId'];
	}
	
	// If there is no order ID at this point - send to generic TY page
	if(!@$orderId) {
		$nextUrl = 'orderconfirmation.php';
		header("LOCATION: $nextUrl");
		exit;
	} else {
		// make sure orderId session gets set
		$_SESSION['Order']['orderId'] = $orderId;
	}
	
	
	$urlParams['orderId'] = $orderId;
	
	// TESTING ONLY
	/*unset($_SESSION['Order']['Upsales'][1]);*/

	if(@$_SESSION['Order']['Upsales'][1] == 'taken') {
		// This upsale has already been taken - forward to next upsale
		$urlParams['so1'] = 1;
		$nextUrl = 'offer2.php?'.http_build_query($urlParams);
		header("LOCATION: $nextUrl");
		exit;
	} else {
		$urlParams['so1'] = 0;
	}

	if(@isset($_GET['answer'])) {
		$answer = $_GET['answer'];
		
		if($answer == 1) {
			$urlParams['so1'] = 1;
			$_SESSION['Order']['Upsales'][1] = 'taken';
		} else {
			$urlParams['so1'] = 0;
		}
		
		$nextUrl = 'offer2.php?'.http_build_query($urlParams);
		header("LOCATION: $nextUrl");
		exit;
	}
	
	$orderURL = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../favicon.ico">
	
	<title>Special Offer!</title>
	
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
</head>
<body>

	<!-- Don't Exit Order Alert -->
	<div class="container-fluid sticky-top text-center doNotExitAlert">
		<h2>SPECIAL OFFER ACTIVATED - DO NOT EXIT OR CLOSE THIS PAGE!</h2>
	</div>
	<!-- /Don't Exit Order Alert -->

	<!-- Main Content Area -->
	<main role="main" class="container">
		<div class="row">
			<div class="col-12 text-center">
				<img src="images/Warningheader4.jpg" class="img-fluid">
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-12 text-center">
				<img src="images/Highlight1.jpg" class="img-fluid">
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-7 text-left largeText">
				<h2>Congratulations <?php echo @$_SESSION['Contact']['firstname']; ?>!</h2>
				<p>
					Many customers have voiced their concerns about getting <?php echo $config['productName']; ?> in the future, since it's almost completely sold out after recently being featured on T.V.
				</p>
				<p>
					You have been selected to receive 75% Off coupon. This coupon is valid for 1 additional bottle of <?php echo $config['productName']; ?>. This coupon is only valid for the next 5 minutes.
				</p>
				<p>
					Because of the high demand of <?php echo $config['productName']; ?>, there is a strict limit to only 1 bottle at this discounted price.
				</p>
				<p>
					It's recommended that you take <?php echo $config['productName']; ?> every day just like a vitamin to ensure you see maximum dietary results. This will also help you keep your body in peak physical performance. Secure 1 additional bottle right now to make sure you don't run out of your supply. Use the coupon code to get 1 more bottle at 75% off the current price.
				</p>
			</div>
			<div class="col-5">
				<div class="couponCountdown">
					<div class="text-center p-sm-2 p-md-4">
						<div><img src="images/thoff7.jpg" class="img-fluid"></div>
						<div class="font-weight-bold">This 75% OFF COUPON is presented to</div>
						<div class="smallText">selected VIP members and is only valid for the next 5 minutes</div>
						<div id="timercontainer" class="border rounded border-dark mt-4">
							<div class="font-weight-bold">Time Sensitive</div>
							<div id="timerbox" class="row">
								<div class="col-4 text-center">
									<img src="images/clock_icon.png" class="img-fluid">
								</div>
								<div class="col-5">
									<span id="minutes2" class="text-danger font-weight-bold timerText">0</span>
									<span class="text-danger font-weight-bold timerText">:</span>
									<span id="seconds2" class="text-danger font-weight-bold timerText">00</span>
								</div>
							</div>
						</div>

						<div class="mt-3 font-weight-bold medText">
							Click the redeem button below to add 1 more	bottle of <?php echo $config['productName']; ?> to your order today for only $19.99 which is more than 75% OFF the retail price
						</div>
						<div class="mt-2 font-weight-bold medText">
							You will also get FREE SHIPPING when you add this to your order today!
						</div>
						<div class="text-center mt-3">
							<a href="<?php echo $orderURL; ?>&answer=1"><img src="images/ogbutton.png" class="img-fluid"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-12 largeText">
				The normal price right now is $79.99 but when you use this coupon code now, you will be able to get 1 more bottle of <?php echo $config['productName']; ?> for <b>only $19.99</b>
			</div>
		</div>
		
		<div class="row mt-4">
			<div class="col-12 text-center">
				<h2>If You Dont Take Advantage Of This Now, You Will Hate Yourself Later</h2>
				<p class="largeText">
					This is only valid for the next <span id="minutes1" class="font-weight-bold">0</span> minutes and <span id="seconds1" class="font-weight-bold">00</span> seconds.
				</p>
			</div>
		</div>
		
		<div class="row mt-3">
			<div class=""
		</div>
	</main>
	<!-- /Main Content Area -->

</body>
</html>