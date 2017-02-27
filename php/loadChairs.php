<?php
	// Load all 10 chairs from selected table
	require_once('db.php');
	$table = $_POST['table'];
	$result=$dbh->prepare("SELECT * FROM `promTix` WHERE `Table` = ? LIMIT 10");
	$result->execute(array($table));
	$result=$result->fetchAll();

	// Output table information in pop-up window
	echo '<a href="javascript:void(0)" id="chairsClose" class="closeButton"><img src="images/close.png" alt="Close Window"></a><h2>Choose Your Seat</h2>';
	for ($i=1;$i<=10;$i++)
	{
		// Output chair information
		$result=$dbh->prepare("SELECT * FROM `promTix` WHERE `Table` = ? AND `Chair` = ? LIMIT 1");
		$result->execute(array($table, $i));
		$count=$result->rowCount();
		$result=$result->fetchAll();
		
		if ($count > 0)
		{
			$name = $result[0]['Name'];
			echo "<div class='chair inactive' id='c$i'>$name</div>";
		}
		else
		{
			$result=$dbh->prepare("SELECT * FROM `promTix` WHERE `Table` = ? AND `Chair` = ? LIMIT 1");
			$result->execute(array($table, $i));
			$count=$result->rowCount();
			$result=$result->fetchAll();
			
			if ($count > 0)
			{
				$name = $result[0]['Name'];
				echo "<div class='chair inactive' id='c$i'>$name</div>";
			}
			else
				echo "<div class='chair' id='c$i'>$i</div>";
		}
	}
	echo "<div class='mainTable'>$table</div>";
?>