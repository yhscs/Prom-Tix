<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		// Edit student info
		require_once('db.php');
		$payment = $_POST['payment'];
		$shirt = $_POST['shirt'];
		$ticket = $_POST['ticket'];
		$id = $_POST['id'];

		$result=$dbh->prepare("UPDATE `promTix` SET `Payment` = ?, `Shirt` = ?, Ticket = ? WHERE `ID` = ?");
		$result->execute(array($payment, $shirt, $ticket, $id));
		
		exit('The information has been updated.');
	}
?>