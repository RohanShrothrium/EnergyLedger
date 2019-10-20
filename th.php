<?php 
	if(!isset($_GET['id'])){
		  die('bye');
    }
    $cmd = 'cd node_sdk; node query Trace '.$_GET['id'];
    $cmd = json_decode(shell_exec($cmd));
?>
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
<body>
	<style>
		.content{
			background:white;
			border-radius: 10px;
			padding: 50px;
			width:1200px;
			margin-bottom: 20px;
      align-items: center;
		}
    body{
      background: url('images/skyrim.jpg');
      background-attachment: fixed;
    }
    .col p{
      font-size: 1.2em;
    }
	</style>
	<div class="limiter">
		<div class="container-login100">
      <div class="content">
        <h3><?php echo 'History of '.$_GET['id'];?></h3>
      </div>

      
      <?php
        // print_r($cmd[0]);
        foreach($cmd as $key => $value){
          $color = 'green';
          if($value->Value->Origin=='0'){
            $color = 'red';
          }
          echo '<div class="row content">
          <div class="col login100-pic js-tilt" data-tilt>
            <img src="images/block.png" alt="IMG" height=160>
          </div>	
          <div class="col">
            <p>txId:&nbsp'.$value->TxId.'</p>
            <p>User:&nbsp&nbsp'.$value->Value->UserID.'</p>
            <p>Origin:&nbsp&nbsp'.$color.'</p>
            <p>Date:&nbsp&nbsp'.$value->Timestamp.'</p>
          </div>
        </div>';
        }
      ?>
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