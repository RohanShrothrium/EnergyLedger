
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
		$tmp = 'cd node_sdk; node invoke.js ChangeOwnership %s %s %s %s %s';
		if($_POST['color']=='green'){//send green tokens
			$cmd = sprintf($tmp, $user, $user, $_POST['buyer'], '1', $_POST['num']);
			echo shell_exec($cmd);
		}else{
			$cmd = sprintf($tmp, $user, $user, $_POST['buyer'], '0', $_POST['num']);
			echo shell_exec($cmd);
		}
	}
	?>
	</p>
	<div class="limiter">
		<div class="container-login100">
			<div class='content' style=''>
				<h1 class="text-center"> Welcome <?php echo $_SESSION['user']; ?>!</h1>
				<a href="/EnergyLedger" style='color: blue;'>logout</a>
				<div class="row py-5 justify-content-around">
					<?php
						//get user json
						$cmd = shell_exec('cd node_sdk;node query.js Query '.$_SESSION['user']);
						$cmd = json_decode($cmd, true);
					?>
					<div id='' class="col text-center">
						
							<h3>Tokens produced</h3><br>
						<div class="row">
							<div class="col mx-3 alert-success">
								<?php
									if(!empty($cmd['GoListGreen'])){
										foreach ($cmd['GoListGreen'] as $value) {
											if(!$value=='0'){
											echo '<a href="th.php?id='.$value.'".>'.$value.'</a><br>';}
										}
									}
								?>
								
							</div>
							<div class="col mx-3 alert-danger">
								<?php
									if(!empty($cmd['GoListRed'])){
										foreach ($cmd['GoListRed'] as $value) {
											if(!$value=='0'){
											echo '<a href="th.php?id='.$value.'".>'.$value.'</a><br>';}
										}
									}
								?>
								
								
							</div>
						</div>
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
							<input class="input100" type="text" name="num" placeholder="tokens">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-hashtag"></i>
							</span>
						</div>

						<div class="wrap-input100">
						<select class='input100' name="color"> // Initializing Name With An Array
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
	</script>
	<script src="js/main.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>