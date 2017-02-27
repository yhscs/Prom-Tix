<?php
	$pass = $_POST['pass'];

	if ($pass == 'PASSWORD_HERE')
		exit('OK');
	else
		exit('The password was incorrect.');
?>