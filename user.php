<?php 
	session_start();
?>
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
	</style>
	<div class="limiter">
		<div class="container-login100">
			<div class='content' style=''>
				<h1 class="text-center"> Welcome <?php echo $_SESSION['user']; ?>!</h1>
				<div class="row py-5 justify-content-around">
					<div class="col text-right">
						<h3>Tokens produced</h3>
						<br>
						<p>FF0fOWX3YWeOLbyncYpLI2Wq4NIWhpnC</p>
						<p>iZ1ZxcVxL4M9EdbvPDjn9daNmgza2Dxa</p>
						<p>bMjkmfTk9XJB2p5SgFhsZ2NXqS2Z4RBm</p>
						<p>OHddb5VWhfynNSZu0KZggF42ll6P6LNb</p>
					</div>
				</div>
			</div>
			<div class='content'>
				<h1 class="text-center">Send Tokens</h1>
				<div class="row py-5 justify-content-around">
					<div class="login100-pic js-tilt" data-tilt>
						<img src="Logo/electric_orange.png" alt="IMG">
					</div>					

					<form method="POST">

						<div class="wrap-input100">
							<input class="input100" type="text" name="buyer" placeholder="Buyer">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-address-book" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100">
							<input class="input100" type="text" name="green" placeholder="green token">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-hashtag"></i>
							</span>
						</div>

						<div class="wrap-input100">
							<input class="input100" type="text" name="red" placeholder="red tokens">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-hashtag"></i>
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
	</script>
	<script src="js/main.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>