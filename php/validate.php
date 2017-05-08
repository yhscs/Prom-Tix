<?php
	function verifySanity($fieldName)
	{
		$field = trim($_POST[$fieldName]);
		$sanitized = htmlspecialchars($field);
		
		if (strpos($sanitized, '&') !== false) // Does this contain any special encoding characters?
			exit('Illegal input for $fieldName');
	}

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
	
	verifySanity('guestFirst');
	verifySanity('guestLast');
	verifySanity('payerFirst');
	verifySanity('payerLast');

	exit('OK');
?>
