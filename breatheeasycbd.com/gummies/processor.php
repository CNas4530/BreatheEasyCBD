<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
	
	if(@$_POST && count($_POST) > 1) {
		
		// Update Selected Product
		$_SESSION['Order']['packageSelection'] = (int)$_POST['Product'];
		
		// Update Contact Info incase it's changed since partial form or not set at all
		$_SESSION['Contact']['firstname'] = $_POST['firstname'];
		$_SESSION['Contact']['lastname'] = $_POST['lastname'];
		$_SESSION['Contact']['address'] = $_POST['address'];
		$_SESSION['Contact']['city'] = $_POST['city'];
		$_SESSION['Contact']['state'] = $_POST['state'];
		$_SESSION['Contact']['zipcode'] = $_POST['zipcode'];
		$_SESSION['Contact']['country'] = $_POST['country'];
		$_SESSION['Contact']['phone'] = $_POST['phone'];
		$_SESSION['Contact']['email'] = $_POST['email'];
		
		
		if(@$_POST['sameship'] == 'on') {
			// Update Billing Info
			$_SESSION['Contact']['sameship'] = 1;
			$_SESSION['Contact']['bill_address'] = $_POST['bill_address'];
			$_SESSION['Contact']['bill_city'] = $_POST['bill_city'];
			$_SESSION['Contact']['bill_state'] = $_POST['bill_state'];
			$_SESSION['Contact']['bill_zipcode'] = $_POST['bill_zipcode'];
			$_SESSION['Contact']['bill_country'] = $_POST['bill_country'];
		} else {
			// Mark as USING same info
			$_SESSION['Contact']['sameship'] = 0;
		}
		
		// Send Order to CRM
		
		// TESTING ONLY - SIMULATE SUCCESS
		$_SESSION['Order']['mainSuccess'] = 1;
		$_SESSION['Order']['orderId'] = rand(10000,1000000);
		$_SESSION['Contact']['contactId'] = rand(10000,1000000);
		
		// Redirect to Special Offer #1
		$forwardUrl = $config['upsaleUrl'].'?orderId='.$_SESSION['Order']['orderId'];
		header("LOCATION: $forwardUrl");
		exit;
	}
?>