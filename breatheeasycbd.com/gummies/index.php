<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
	
	if(@$_POST && count($_POST) > 1) {
		
		// Update Session Values
		foreach ($_POST as $key=>$value) {
			$_SESSION['Contact'][$key] = $value;
		}
		
		// Add / Update Contact Record in CRM
		
		// Send to next page
		header("LOCATION: purchase.php");
	}
	
	$today = date('l, F j, Y');
	
	if(@$_GET['coupon']) {
		$couponCode = filter_var($_GET['coupon'],FILTER_SANITIZE_STRIPPED);
	} else {
		if(@$_SESSION['Contact']['coupon']) {
			$couponCode = $_SESSION['Contact']['coupon'];
		} else {
			$couponCode = '';
		}
	}
?>
<!doctype html>
<html>
<head>
	<title><?php echo $config['productName']; ?> | CBD Gummies</title>
	
	<meta name="viewport" content="width=device-width">
	<link href="https://fonts.googleapis.com/css?family=Dosis:300,400,700" rel="stylesheet">
	
	<link rel="stylesheet" href="css/cplus.css">
</head>
<body>


<div class="topheader">
	<div class="container">
		<div class="left">
			<img src="images/warning.png">
			Due to high demand from recent media coverage, we can no longer guarantee supply.  As of <b><?php echo $today; ?></b> we currently have product in-stock and will ship within 48 hours of purchase.
		</div>
		<div class="right"><b>Feel The Difference.</b></div>
		<div style="clear:both"></div>
	</div>
</div>
<div class="header2">
	<div class="container">
		<div class="left">
			<a href="/"><img src="images/logo.png" alt="<?php echo $config['productName']; ?>" border="0"></a>
		</div>
		<!--<div class="right">
		<img src="images/burger.png" style="cursor:pointer" onclick="toggle()">
		</div>-->
		<div style="clear:both"></div>
		<img src="images/bighex.png" class="bighex">
	</div>
</div>
<!--<div id="menu1">
<a href="">Menu Item</a>
<a href="">Menu Item</a>
<a href="">Menu Item</a>
<a href="">Menu Item</a>
</div>-->
<script>
    function toggle(){
        if(document.getElementById("menu1").style.display=="block") document.getElementById("menu1").style.display="none"; else document.getElementById("menu1").style.display="block";
    }
</script>
<div class="block1">
	<div class="orange"></div>
	<div class="container">
		<div class="leftside">
			<img src="images/bottle.png" class="bottle">
			<div class="orangestuff">
				<img src="images/ragged.png">
				<div class="innerorange">
					<h1><b>Feel The Difference</h1></b>
					
					<ul><li>Soothes Chronic Pain.</li>
						<li>Levels Your Mood &amp; Mindset.</li>
						<li>Combats Anxious Feelings.</li>
						<li>Aids In Regulating Blood Sugar.</li>
						<li>And Much More!</li>
					</ul>
				</div>
			</div>
			<div class="shifted"><br />
				<h3><b>What is <?php echo $config['productName']; ?>?</b></h3></div>
			
			<div style="clear:both"></div>
			<img src="images/doctor.png" class="doctor"><b style="font-weight:300;font-size:18px;">
				CBD, or Cannabidiol, is a powerful compound inside the cannabis plant.  Unlike its cousin THC, CBD is non-psychoactive and does not produce a "high."  This potent substance provides a host of medical benefits, as well as being legal in all 50 states - a great benefit for those looking for the effects of medical cannabis without the "high."  The body's ECS, or endocannabinoid system, regulates and assists many functions including relaxation, appetite, response to inflammation, and even the brain's cognitive function. </b>
			<br /><br />
		</div>
		<div class="rightside">
			<div class="bigform">
				<h3>Huge Discounts Available. <br />Get Premium CBD.</h3>
				<form id="partialform" class="partialform" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<a name="form"></a>
					<input type="hidden" id="coupon" name="coupon" value="<?php echo $couponCode; ?>">
					
					<div class="formitem">
						<label>First Name:</label>
						<input id="firstname" name="firstname" value="<?php echo @$_SESSION['Contact']['firstname']; ?>" type="text" required>
					</div>
					<div style="clear:both;"></div>
					<div class="formitem">
						<label>Last Name:</label>
						<input id="lastname" name="lastname" value="<?php echo @$_SESSION['Contact']['lastname']; ?>" type="text" required>
					</div>
					<div style="clear:both;"></div>
					<div class="formitem">
						<label>Address:</label>
						<input id="address" name="address" value="<?php echo @$_SESSION['Contact']['address']; ?>" type="text" required>
					</div>
					<div style="clear:both;"></div>
					<div class="formitem">
						<label>City:</label>
						<input id="city" name="city" value="<?php echo @$_SESSION['Contact']['city']; ?>" type="text" required>
					</div>
					<div style="clear:both;"></div>
					<div class="formitem">
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
						<input type="hidden" name="country" value="US">
					</div>
					<div style="clear:both;"></div>
					<div class="formitem">
						<label>Zip Code:</label>
						<input id="zipcode" name="zipcode" value="<?php echo @$_SESSION['Contact']['zipcode']; ?>" type="text" required>
					</div>
					<div style="clear:both;"></div>
					<div class="formitem">
						<label>Phone:</label>
						<input id="phone" name="phone" value="<?php echo @$_SESSION['Contact']['phone']; ?>" maxlength="10" type="text" required>
					</div>
					<div style="clear:both;"></div>
					<div class="formitem">
						<label>Email:</label>
						<input id="email" name="email" value="<?php echo @$_SESSION['Contact']['email']; ?>" type="text" required>
					</div>
					<div style="clear:both"></div>
					<hr style="height:1px;border:0;background-color:white;color:white;margin:25px 0;margin-top:10px">
					
					
					<button style="border:0;margin:0;padding:0;max-width:100%;display:block;margin:0 auto;background-color:transparent;" onclick="exitPop = false"><img src="images/get.png" id="partialsubmitbutton" name="partialsubmitbutton" type="image"  style="max-width:100%;display:block;margin:0 auto;background-color:transparent;"></button>
				</form>
				<img src="images/badges.png" style="display:block;margin:17px auto;max-width:100%;">
			
			</div>
			<img src="images/3bottles.png" style="display:block;margin:30px auto;max-width:100%">
		</div>
	
	</div>
	<div style="clear:both"></div>
</div>
<div class="midline">
	<img src="images/feel.png" alt="Feel The Difference">
</div>

<div class="container">
	<br />
	<h4>People Who Benefit From<br />Cannabidiol Suffer From Various Ailments</h4>
</div>
<div class="block2">
	<div class="orange"></div>
	<div class="container">
		
		<div class="orangestuff">
			<img src="images/ragged2.png">
			<div class="innerorange">
				<h5><b>These Can Include...</b></h5>
				<img src="images/0bottle.png" class="bottle1"><b style="font-weight:300;font-size:21px;">
					<ul><li>Low Energy</li><li>Chronic Pain</li><li>Hypertension</li><li>And More...</li></b>
				</ul>
			</div>
		</div>
		<img src="images/ache.jpg" class="ache">
		<div style="clear:both"></div>
	</div>

</div>

</div>
<div class="midline" style="margin-top:0">
	<img src="images/feel.png" alt="Feel The Difference">
</div>
<div class="container">
	<br />
	<h4>Along With Chronic Pain, CBD Also Helps...</h4><br />
	<div>
		<div class="left features">
			Soothes upset stomachs<hr>Nausea<hr>Helps relieve depression & anxiety
		</div>
		<div class="right features">
			<hr>Relieves inflammation at the source<hr><span style="text-transform:uppercase;">And Much More...</span>
			<br />
			<a href="#form"><img src="images/get.png" style="max-width:100%;margin:15px auto;display:block" alt="Feel The Difference - Get Yours Today"></a>
		
		</div>
		<img src="images/bottle4.png" class="mainbottle">
		
		<div style="clear:both;"></div><br /><br /><br />
	</div>

</div>
<div class="midline">
	<img src="images/feel.png" alt="Feel The Difference">
</div>
<div class="container">
	<div style="margin:0 auto;max-width:950px;padding-bottom:40px;font-size:18px;line-height:180%"><br />
		<img src="images/1bottle.png" class="bottle2"><br />
		<h4>Why is <?php echo $config['productName']; ?> Better?</h4>
		<?php echo $config['productName']; ?> is committed to providing the highest-quality cannabidiol products on the market.  Our supplements are 100% SAFE AND LEGAL TO USE IN ALL 50 STATES.  We take pride in our products being grown in America, processed in America, and NON-GMO.  You can be confident in your purchase!
		<div style="clear:both"></div>
	</div>
	
	<div>
		<div class="cell33">
			<img src="images/photo1.jpg">
			<b>Natural &amp; Safe Formula</b>
			The cannabis crops we use to create <?php echo $config['productName']; ?>, are not treated with any dangerous synthetic chemicals, pesticides, or growth boosters.  We're proud to be A healthy, organic, and toxin-free product.
		</div>
		<div class="cell33">
			<img src="images/photo2.jpg">
			<b>No Prescription Required</b>
			Here at <?php echo $config['productName']; ?> we work hard to make sure you're getting only the finest cannabidiol supplements, legal and hassle free.  Our products are available and fully legal in all 50 states.
		</div>
		<div class="cell33">
			<img src="images/photo3.jpg">
			<b>Side-Effect FREE</b>
			Along with no known side-effects, cannabidiol is non-psychoactive. You will benefit from all of its powerful properties while avoiding the "high" that comes from THC. The CBD is where the real medical benefits comes from.
		</div>
		<div style="clear:both;height:60px"></div><br /><br /><br />
	</div>
</div>

</div>
<div class="midline">
	<img src="images/feel.png" alt="Feel The Difference">
</div>
<div class="container"><br />
	<h4>State-Of-The-Art Manufacturing</h4>
</div>
<div class="block3">
	<div class="orange"></div>
	<div class="container">
		
		<div class="innerorange">
			<img src="images/ragged.png"><br />
			<b style="font-weight:700;font-size:24px;"><?php echo $config['productName']; ?></b> Uses cutting-edge manufacturing and production processes to ensure that our product is pure, safe, and effective.  We use choice cannabis crops grown just for us, and extract it into a 99%+ pure crystal isolate, which is then used to make our range of consumer products.  Our laboratories undergo rigorous testing and calibration regularly, as well as being monitored for pesticides, heavy metals, solvents, and other contaminants.
			<br /><br />
			All of our products undergo third-party testing as well.  Our processes involve HPLC, or high-performance liquid chromatography, mass spectrometry, and column distillation testing, as we strive to be a leader in the industry.  This ensures that our advertised measurements and dosages are accurate, letting you dial in the exact amount of cannabidiol your individual body needs.  We are committed to providing timely and accurate information regarding cannabidiol and its effect, as well<br /> as educating the general populace about the possible benefits that can be found by using it.
		</div>
		<img src="images/midbottle.png" class="bottle3">
		<div style="clear:both;height:30px;"></div>
		<a href="#form"><img border="0" alt="Get yours now" src="images/label.png" style="max-width:100%;margin:0 auto;box-shadow:0 0 3px rgba(0,0,0,.2);margin-bottom:65px;" class="desktoponly"><img src="images/get.png" style="max-width:100%;margin:15px auto;margin-bottom:65px" alt="Feel The Difference - Get Yours Today" class="mobileonly"></a>
	</div>
</div>
<div class="midline">
	<img src="images/feel.png" alt="Feel The Difference">
</div>
<div class="container">
	<div style="max-width:800px;text-align:center;margin-bottom:60px;margin-left:auto;margin-right:auto"><br />
		<h4>Don't Just Take Our Word For It.</h4>
		Read for yourself the feedback and reviews we have received from our loyal and valuable customers.  We are proud to offer relief and ease the ailments so many people suffer through on a daily basis.  Give <?php echo $config['productName']; ?> a Try!
	</div>
	
	<div class="borderbox">
		<img src="images/bigquote.png" class="bigquote">
		<div class="testbox">
			<div class="test">
				<img src="images/test1.png">
				<img src="images/stars.png">
				<b>"Works Wonders on my Joints!"</b>
				"This product is a lifesaver.  I feel like I can walk again after taking <?php echo $config['productName']; ?> capsules.  My knee pain has kept me sitting what seems like hours, but after these capsules, the stiff, sore joints are gone!  My mobility has drastically increased along with decreasing my inflammation."
				<br /><br />
				<strong>Gustavo J.</strong>
				<small>Palo Alto, CA</small>
			
			</div>
			<div class="test">
				<img src="images/test3.png">
				<img src="images/stars.png">
				<b>"Cured my chronic nausea."</b>
				"This stuff is the BEST.  I have trouble eating due to a medical condition that causes severe, chronic nausea.  This <?php echo $config['productName']; ?> has cured it, it seems.  I find myself being able to eat again, something that's given me trouble for years.  It's remarkable how much better you feel when you can actually keep food & water down.  Thanks <?php echo $config['productName']; ?>!"
				<br /><br />
				<strong>Patricia M.</strong>
				<small>Albany, NY</small>
			
			</div>
			<div class="test">
				<img src="images/test2.png">
				<img src="images/stars.png">
				<b>"Soothes Inflammation Like a Charm."</b>
				"I've suffered from arthritis for years now, and my body likes to flare up with inflammation at the most inconvenient of times.  When I'm taking cannabidiol supplements I feel like me again, this stuff soothes inflammation like a charm!  My grand-kids have even started to notice that grandma can keep up again."
				<br /><br />
				<strong>Carolyn B.</strong>
				<small>Sheboygan, WI</small>
			
			</div>
			<div style="clear:both"></div>
		
		</div>
	
	</div>
</div>
<div class="midline" style="margin-bottom:0">
	<img src="images/feel.png" alt="Feel The Difference">
</div>
<div class="end">
	<div class="container">
		&copy; <?php echo date('Y'); ?> <?php echo $config['productName']; ?> | All Rights Reserved. | <a href="#" onclick="javascript:void window.open ('privacy.php','Privacy','width=650,height=500,toolbar=0,menu bar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0'); return false;">Privacy</a> | <a href="#" onclick="javascript:void window.open ('terms.php','Terms','width=650,height=500,toolbar=0,menu bar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0'); return false;">Terms</a>
	</div>
</div>

</body>
</html>