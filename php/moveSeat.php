<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		// Find tables with open seats
		require_once('db.php');
		$result=$dbh->prepare("SELECT * FROM `promTables` WHERE `Open` > 0 ORDER BY `Table`");
		$result->execute();
		$tableCount=$result->rowCount();
		$tables=$result->fetchAll();

		$emptySeats = array();
		// Find seats with no students
		for ($i=0;$i<$tableCount;$i++)
		{
			$result=$dbh->prepare("SELECT * FROM `promTix` WHERE `Table` = ? LIMIT 10");
			$result->execute(array($tables[$i]['Table']));
			$count=$result->rowCount();
			$result=$result->fetchAll();

			for ($chair=1; $chair<=10; $chair++)
			{
				$foundEmpty = true;
				for ($j=0;$j<$count;$j++)
				{
					if ($chair == $result[$j]['Chair'])
					{
						$foundEmpty = false;
						break;
					}			   
				}
				
				if ($foundEmpty === true)
					array_push($emptySeats, $tables[$i]['Table'].'-'.$chair);
			}
		}
		
		$finalEmptySeats = array();
		
		// Find seats with no guests
		for ($i=0;$i<$tableCount;$i++)
		{
			$result=$dbh->prepare("SELECT * FROM `promGuests` WHERE `Table` = ? LIMIT 10");
			$result->execute(array($tables[$i]['Table']));
			$count=$result->rowCount();
			$result=$result->fetchAll();

			for ($chair=1; $chair<=10; $chair++)
			{
				$foundEmpty = true;
				for ($j=0;$j<$count;$j++)
				{
					if ($chair == $result[$j]['Chair'])
					{
						$foundEmpty = false;
						break;
					}			   
				}

				if ($foundEmpty === true && array_search($tables[$i]['Table'].'-'.$chair, $emptySeats) !== false)
					array_push($finalEmptySeats, $tables[$i]['Table'].'-'.$chair);
			}
		}
	}

	// Output empty seats
	for ($i=0; $i<count($finalEmptySeats);$i++)
	{
		echo $finalEmptySeats[$i].'##';
	}
?>