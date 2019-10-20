
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Producer</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	
</head>
<style>
body{
  background: url('images/skyrim.jpg');
  background-attachment: fixed;
}</style>

<body>
	<style>
		.content{
			background:white;
			border-radius: 10px;
			padding: 50px;
			width:1000px;
			margin-bottom: 50px;
		}
		a{
			font-size: 1.2em;
			color: white;
		}
		a:hover{
			color: blue;
		}
		.alert-success{
			background: #00c853;
			border-radius: 7px;
		}
		.alert-danger{
			background: #e53935;
			border-radius: 7px;
		}
	</style>
		<p style='color:white;'>
	<?php 
	session_start();
	$_SESSION['invalid'] = 0;
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$user = $_SESSION['user'];

		if(isset($_POST['num'])) {
			if($_POST['num'] < 1.5 || $_POST['num'] > 4.5) {
				$_SESSION['invalid'] = 1;
			} else {
				$_SESSION['invalid'] = 2;
			}
		}

		if($_POST['color']=='green'){
			// MINT GREEN TOKEN
			$cmd = sprintf($tmp, $_POST['UserID'], '1');
			echo shell_exec($cmd);
		} else{
			// MINT RED TOKEN
			$cmd = sprintf($tmp, $_POST['UserID'], '0');
			echo shell_exec($cmd);
		}
	}
	?>
	</p>
	<div class="limiter">
		<div class="container-login100">
			<div class='content' style=''>
				<h1 class="text-center"> Welcome <?php echo $_SESSION['user']; ?>!</h1>
				<a href="/EnergyLedger" style="float: right" class="btn btn-danger">
          			<span class="glyphicon glyphicon-log-out"></span> Log out
        		</a>
				
			</div>
			<div class='content'>
				<h1 class="text-center">Request Tokens</h1>
				<div class="row py-5 justify-content-around">
					<div class="login100-pic js-tilt" data-tilt>
						<img id="electric_img" src="Logo/electric_orange.png" alt="IMG">
					</div>					

					<form method="POST">

						<!-- <div class="wrap-input100">
							<input class="input100" type="text" name="buyer" placeholder="Buyer">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-address-book" aria-hidden="true"></i>
							</span>
						</div> -->

						<!-- <div class="wrap-input100">
							<input class="input100" type="text" name="num" placeholder="Number of Units">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-hashtag"></i>
							</span>
						</div> -->
						<?php
							if($_SESSION['invalid'] == 1) {
								echo '<div class="alert alert-warning" role="alert">
										<strong>Anomaly Detected!</strong> This submission will be reported.
						  			  </div>';
							} else if($_SESSION['invalid'] == 2) {
								echo '<div class="alert alert-success" role="alert">
										<strong>Submitted!</strong> Request submitted to marketplace.
						  			  </div>';
							}
						?>
						<div class="wrap-input100">
							<input class="input100" type="text" name="num" placeholder="Units to be sold">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-hashtag"></i>
							</span>
						</div>
						
						
						<div class="wrap-input100">
						
						<select onchange="toggleImage()" class='input100' name="color"> // Initializing Name With An Array
							<option value="red">Red</option>
							<option value="green">Green</option>
						</select>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-tint"></i>
							</span>
						</div>
						
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Confirm
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
		
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})

		function toggleImage() {
			img_ele = document.getElementById('electric_img');
			console.log(img_ele.src);
			if(img_ele.src == "http://localhost/EnergyLedger/Logo/electric_orange.png") {
				var div = $("#electric_img");
				div.animate({opacity: '0'}, 200);
				setTimeout(function() { document.getElementById('electric_img').src = "http://localhost/EnergyLedger/Logo/electric_green.png"; }, 200);
				div.animate({opacity: '1'}, 200);
			} else {
				var div = $("#electric_img");
				div.animate({opacity: '0'}, 200);
				setTimeout(function() { document.getElementById('electric_img').src = "http://localhost/EnergyLedger/Logo/electric_orange.png"; }, 200);
				div.animate({opacity: '1'}, 200);
			}
		}
	</script>
	<script src="js/main.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>