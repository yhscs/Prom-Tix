<?php
	// Determine if selected seat is available
	require_once('db.php');
	$table = $_POST['table'];
	$chair = $_POST['chair'];
	$result=$dbh->prepare("SELECT 1 FROM `promTix` WHERE `Table` = ? AND `Chair` = ? LIMIT 1");
	$result->execute(array($table,$chair));
	$count=$result->rowCount();
	
	if ($count == 1)
		exit('That seat is no longer available. Please choose a new one.');
	
	// Determine if user has already chosen a seat
	$receipt = $_POST['receipt'];
	$receipt = explode('##',$receipt);
	$id = $receipt[2];
	$result=$dbh->prepare("SELECT 1 FROM `promTix` WHERE `ID` = ? LIMIT 1");
	$result->execute(array($id));
	$count=$result->rowCount();
	
	if ($count == 1)
		exit('You have already confirmed a seat. You cannot choose another seat.');

	// Decrease available seats at table
	$result=$dbh->prepare("UPDATE `promTables` SET `Open` =  `Open` - 1 WHERE `Table` = ? LIMIT 1");
	$result->execute(array($table));

	// Start to add student to prom list
	$first = $receipt[0];
	$last = $receipt[1];
	
	$result=$dbhVote->prepare("SELECT `Grade` FROM `electionVoters` WHERE `First Name` = ? AND `Last Name` = ? AND `ID` = ? LIMIT 1");
	$result->execute(array($first,$last,$id));
	$result=$result->fetch();
	
	// Gather receipt info
	$name = $receipt[0].' '.$receipt[1];
	$grade = $result['Grade'];
	$payment = $receipt[8];
	$guest = $receipt[3].' '.$receipt[4];
	$payor = $receipt[5].' '.$receipt[6];
	$shirt = $receipt[9];
	$ticket = $receipt[11];

	// Finally add student to prom list
	$guestChair = $_POST['guestChair'];
	if ($guest == 'undefined undefined')
		$guest = 'NONE';
		
	$result=$dbh->prepare("INSERT INTO `promTix` (`Table`,`Chair`,`Name`,`Grade`,`ID`,`Payment`,`Guest`,`Payor`,`Shirt`,`Ticket`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$result->execute(array($table,$chair,$name,$grade,$id,$payment,$guest,$payor,$shirt,$ticket));
	
	// Add guest to prom list
	if ($guestChair != 0 && $guest != 'NONE')
	{
		$result=$dbh->prepare("UPDATE `promTables` SET `Open` =  `Open` - 1 WHERE `Table` = ? LIMIT 1");
		$result->execute(array($table));
		
		$guestShirt = $receipt[10];
		$result=$dbh->prepare("INSERT INTO `promGuests` (`Table`,`Chair`,`Name`,`Date`,`Shirt`) VALUES (?, ?, ?, ?, ?)");
		$result->execute(array($table,$guestChair,$guest,$name,$guestShirt));
	}

	exit('OK');
?>