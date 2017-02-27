<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		// Output all students from prom list
		require_once('db.php');
		$result=$dbh->prepare("SELECT * FROM `promTix` ORDER BY `Ticket`");
		$result->execute();
		$numStudents=$result->rowCount();
		$result=$result->fetchAll();

		echo '<h2>Prom Students</h2><table border="1"><tr><th></th><th></th><th>Student</th><th>Grade</th><th>Seat</th><th>Payment Info</th><th>T-Shirt Size</th><th>Ticket Number</th></tr>';
		for ($i=0;$i<$numStudents;$i++)
		{				
			$name = $result[$i]['Name'];
			$table = $result[$i]['Table'];
			$chair = $result[$i]['Chair'];
			$grade = $result[$i]['Grade'];
			$payment = $result[$i]['Payment'];
			$payor = $result[$i]['Payor'];
			$shirt = ucfirst($result[$i]['Shirt']);
			$ticket = $result[$i]['Ticket'];
			$id = $result[$i]['ID'];
			
			if ($payor != '' && $payor != ' ')
				$payment = "$payment by $payor";
			
			echo "<tr><th id='stud$id'><a href='javascript:void(0);' onclick='edit(\"$pass\", $id);'>Edit</a></th><th id='delete$id'><a href='javascript:void(0);' onclick='deleteStud(\"$pass\", $id, \"Student\");'>Delete</a></th><td>$name</td><td>$grade</td><td>$table - $chair</td><td>$payment</td><td>$shirt</td><td>$ticket</td>";
		}
		echo '</table>';
		
		// Output all guests
		$query2=$dbh->prepare("SELECT * FROM `promGuests` ORDER BY `Date`");
		$query2->execute();
		$count=$query2->rowCount();
		$query2=$query2->fetchAll();
		
		echo '<h2>Prom Guests</h2><table border="1"><tr><th></th><th colspan="2">Name</th><th colspan="2">Guest Of</th><th>Seat</th><th>T-Shirt Size</th></tr>';
		for ($j=0; $j<$count; $j++)
		{	
			$id = $query2[$j]['ID'];
			$name = $query2[$j]['Name'];
			$date = $query2[$j]['Date'];
			$chair = $query2[$j]['Chair'];
			$table = $query2[$j]['Table'];
			$shirt = ucfirst($query2[$j]['Shirt']);
			
			echo "<tr><th id='delete$id'><a href='javascript:void(0);' onclick='deleteStud(\"$pass\", $id, \"Guest\");'>Delete</a></th><td colspan='2'>$name</td><td colspan='2'>$date</td><td>$table - $chair</td><td>$shirt</td></tr>";
		}
		echo '</table>';
	}
?>