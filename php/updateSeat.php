<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		// Find tables with open seats
		require_once('db.php');
		$type = $_POST['type'];
		$id = $_POST['id'];
		
		if ($type == 'student')
		{
			// Change student seat
			$result=$dbh->prepare("SELECT * FROM `promTix` WHERE `ID` = ? LIMIT 1");
			$result->execute(array($id));
			$studentInfo=$result->fetchAll();
			
			$seat = explode('-', $_POST['seat']);
			$oldTable = $studentInfo[0]['Table'];

			$result=$dbh->prepare("UPDATE `promTix` SET `Chair` = ?, `Table` = ? WHERE `ID` = ?");
			$result->execute(array($seat[1], $seat[0], $id));
			
			// Update table counts
			// Old Table Increases
			$result=$dbh->prepare("UPDATE `promTables` SET `Open` = `Open` + 1 WHERE `Table` = ?");
			$result->execute(array($oldTable));
			
			// New Table Decreases
			$result=$dbh->prepare("UPDATE `promTables` SET `Open` = `Open` - 1 WHERE `Table` = ?");
			$result->execute(array($seat[0]));
			
			exit('The student has been moved to seat '.$seat[1].' at table '.$seat[0].'.');
		}
		else if ($type == 'guest')
		{
			// Change guest seat
			$result=$dbh->prepare("SELECT * FROM `promGuests` WHERE `ID` = ? LIMIT 1");
			$result->execute(array($id));
			$studentInfo=$result->fetchAll();
			
			$seat = explode('-', $_POST['seat']);
			$oldTable = $studentInfo[0]['Table'];

			$result=$dbh->prepare("UPDATE `promGuests` SET `Chair` = ?, `Table` = ? WHERE `ID` = ?");
			$result->execute(array($seat[1], $seat[0], $id));
			
			// Update table counts
			// Old Table Increases
			$result=$dbh->prepare("UPDATE `promTables` SET `Open` = `Open` + 1 WHERE `Table` = ?");
			$result->execute(array($oldTable));
			
			// New Table Decreases
			$result=$dbh->prepare("UPDATE `promTables` SET `Open` = `Open` - 1 WHERE `Table` = ?");
			$result->execute(array($seat[0]));
			
			exit('The student has been moved to seat '.$seat[1].' at table '.$seat[0].'.');
		}
	}
?>