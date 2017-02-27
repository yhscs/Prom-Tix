<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		// Load student info
		require_once('db.php');
		$type = $_POST['type'];
		$id = $_POST['id'];

		$result=$dbh->prepare("SELECT * FROM `promTix` WHERE `ID` = ? LIMIT 1");
		$result->execute(array($id));
		$info=$result->fetch();
		
		exit($info['Name'].'##'.$info['Payment'].'##'.$info['Shirt'].'##'.$info['Ticket']);
	}
?>