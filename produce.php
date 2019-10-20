
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
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$user = $_SESSION['user'];
		$tmp = 'cd node_sdk;node invoke.js Mint %s %s 20/10/2019';

		if($_POST['color']=='green'){
			// MINT GREEN TOKEN
			$cmd = sprintf($tmp, $_POST['UserID'], '1');
			shell_exec($cmd);
		} else{
			// MINT RED TOKEN
			$cmd = sprintf($tmp, $_POST['UserID'], '0');
			shell_exec($cmd);
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
				<br>
				<br>
				<?php
					if(!isset($_POST['visited'])) {
						echo '<div class="alert alert-info" role="alert">
								<strong>Notice!</strong> You have a request from <strong>GMR</strong> for a Green Token pending.
							</div>';
					} else {
						echo '<div class="alert alert-success" role="alert">
								<strong>Success!</strong> Green Token generated for <strong>GMR</strong>.
							</div>';
					}
				?>
				
			</div>
			<div class='content'>
				<h1 class="text-center">Produce Tokens</h1>
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
						<div class="wrap-input100">
							<input class="input100" type="text" name="UserID" placeholder="Enter UserID">
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

						<input type="hidden" name="visited" value="true">
						
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