<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		require_once('db.php');
		$type = $_POST['type'];
		$id = $_POST['id'];
		
		if ($type == 'Student')
		{
			//  Table Increase
			$result=$dbh->prepare("SELECT `Table` FROM `promTix` WHERE `ID` = ? LIMIT 1");
			$result->execute(array($id));
			$studentInfo=$result->fetch();
			
			$result=$dbh->prepare("UPDATE `promTables` SET `Open` = `Open` + 1 WHERE `Table` = ?");
			$result->execute(array($studentInfo['Table']));
			
			// Delete student
			$result=$dbh->prepare("DELETE FROM `promTix` WHERE `ID` = ?");
			$result->execute(array($id));
			
			exit('The student has been deleted from the prom list.');
		}
		else if ($type == 'Guest')
		{
			//  Table Increase
			$result=$dbh->prepare("SELECT `Table` FROM `promGuests` WHERE `ID` = ? LIMIT 1");
			$result->execute(array($id));
			$studentInfo=$result->fetch();
			
			$result=$dbh->prepare("UPDATE `promTables` SET `Open` = `Open` + 1 WHERE `Table` = ?");
			$result->execute(array($studentInfo['Table']));
			
			// Delete guest
			$result=$dbh->prepare("DELETE FROM `promGuests` WHERE `ID` = ?");
			$result->execute(array($id));
			
			exit('The guest has been deleted from the prom list.');
		}
	}
?>