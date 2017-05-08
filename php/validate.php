<?php
	function verifySanitization($fieldName, $fieldContext)
	{
		$field = trim($_POST[$fieldName]);
		$sanitized = htmlspecialchars($field, ENT_QUOTES | ENT_HTML401, 'UTF-8');
		
		if (strpos($sanitized, '&') !== false || strpos($sanitized,'%') !== false)
			exit('Illegal input detected in $fieldContext');
		
		return $sanitized
	}

	// Determine if name and ID match
	require_once('db.php');
	
	$first = verifySanitization('first', 'your first name');
	$last = verifySanitization('last', 'your last name');
	$id = verifySanitization('id', 'your student id');
	
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
	
	verifySanitization('guestFirst','the first name of the guest');
	verifySanitization('guestLast','the last name of the guest');
	verifySanitization('payerFirst','the first name of the payer');
	verifySanitization('payerLast','the last name of the payer');

	exit('OK');
?>
