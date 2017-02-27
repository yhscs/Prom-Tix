<?php
	// Determine if name and ID match
	require_once('db.php');
	$first = trim($_POST['first']);
	$last = trim($_POST['last']);
	$id = trim($_POST['id']);
	
	$result=$dbhVote->prepare("SELECT * FROM `electionVoters` WHERE `First Name` = ? AND `Last Name` = ? AND `ID` = ? LIMIT 1");
	$result->execute(array($first, $last, $id));
	$count=$result->rowCount();

	if ($count == 0)
	{
		$query=$dbhVote->prepare("SELECT * FROM `electionVoters` WHERE `First Name` = ? AND `Last Name` = ? LIMIT 1");
		$query->execute(array($first, $last));
		$count=$query->rowCount();
		
		if ($count == 0)
			exit('Your name was not recognized.');
		else
			exit('Your ID number was incorrect.');
	}
	
	$first = $_POST['guestFirst'];
	$last = $_POST['guestLast'];
	$payerFirst = $_POST['payerFirst'];
	$payerLast = $_POST['payerLast'];
	if (strpos($first,'##') !== false)
		exit('You used illegal characters in the guest name');
	else if (strpos($last,'##') !== false)
		exit('You used illegal characters in the guest name');
	
	$first = $_POST['payerFirst'];
	$last = $_POST['payerLast'];
	if (strpos($first,'##') !== false)
		exit('You used illegal characters in the name of the person paying.');
	else if (strpos($last,'##') !== false)
		exit('You used illegal characters in the name of the person paying.');

	exit('OK');
?>