<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		// Count number of prom tables
		require_once('db.php');
		$result=$dbh->prepare("SELECT `Table` FROM `promTables` ORDER BY `Table`");
		$result->execute();
		$numTables=$result->rowCount();
		$result=$result->fetchAll();

		// Output information for each prom table
		for ($i=0;$i<$numTables;$i++)
		{
			$table = $result[$i]['Table'];
			echo "<h3>Table $table</h3>";
			
			// Output students at table
			$query2=$dbh->prepare("SELECT * FROM `promTix` WHERE `Table` = ? ORDER BY `Chair`");
			$query2->execute(array($table));
			$count=$query2->rowCount();
			$query2=$query2->fetchAll();
			
			echo '<table border="1"><tr><th></th><th>Student</th><th>Grade</th><th>Seat</th><th>Payment Info</th><th>T-Shirt Size</th><th>Ticket Number</th></tr>';
			for ($j=0; $j<$count; $j++)
			{
				
				$name = $query2[$j]['Name'];
				$chair = $query2[$j]['Chair'];
				$grade = $query2[$j]['Grade'];
				$payment = $query2[$j]['Payment'];
				$payor = $query2[$j]['Payor'];
				$shirt = ucfirst($query2[$j]['Shirt']);
				$ticket = $query2[$j]['Ticket'];
				$id = $query2[$j]['ID'];
				
				if ($payor != '' && $payor != ' ')
					$payment = "$payment by $payor";
				
				
				echo "<tr><th id='stud$id'><a href='javascript:void(0);' onclick='move(\"$pass\", $id,\"student\");'>Move</a></th><td>$name</td><td>$grade</td><td>$chair</td><td>$payment</td><td>$shirt</td><td>$ticket</td>";
			}
			
			// Output guests at table
			$query2=$dbh->prepare("SELECT * FROM `promGuests` WHERE `Table` = ? ORDER BY `Chair`");
			$query2->execute(array($table));
			$count=$query2->rowCount();
			$query2=$query2->fetchAll();
			
			for ($j=0; $j<$count; $j++)
			{
				if ($j==0)
					echo '<tr><th></th><th colspan="2">Name</th><th colspan="2">Guest Of</th><th>Seat</th><th>T-Shirt Size</th></tr>';
				
				$id = $query2[$j]['ID'];
				$name = $query2[$j]['Name'];
				$date = $query2[$j]['Date'];
				$chair = $query2[$j]['Chair'];
				$shirt = ucfirst($query2[$j]['Shirt']);
				
				echo "<tr><th id='stud$id'><a href='javascript:void(0);' onclick='move(\"$pass\", $id,\"guest\");'>Move</a></th><td colspan='2'>$name</td><td colspan='2'>$date</td><td>$chair</td><td>$shirt</td></tr>";
			}
			echo '</table>';
		}
	}
?>