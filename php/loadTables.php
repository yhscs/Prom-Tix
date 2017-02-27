<?php
	// Select all prom tables
	require_once('db.php');
	$result=$dbh->prepare("SELECT * FROM `promTables`");
	$result->execute();
	$count=$result->rowCount();
	$result=$result->fetchAll();

	// Pop up window to choose table
	echo '<a href="javascript:void(0)" class="closeButton"><img src="images/close.png" alt="Close Window"></a><h2>Choose Your Table</h2>';
	echo '<div style="float:right;height:750px;margin-right:100px;"><div style="margin-top:150px;">Bar</div><br><div style="margin-top:150px;">Bar</div><br><div style="margin-top:250px;">Bar</div></div>';
	echo '<div style="float:left;height:750px;margin-top:150px;">Door<br><div style="margin-top:200px;">Door</div><br><div style="margin-top:300px;">Door</div></div>';
	for ($i=0;$i<$count;$i++)
	{
		// Formatting
		if ($i==0)
			$offset = 0;
		else if ($i%6==0)
		{
			echo '<br>';
			if ($offset==0)
				$offset = 5;
			else
				$offset = 0;
		}

		// Table
		$table = $result[$i+$offset]['Table'];
		if ($result[$i+$offset]['Open'] == 0)
			echo "<div class='table inactive' id='t$table'>$table</div>";
		else
			echo "<div class='table' id='t$table'>$table</div>";
		
		if ($offset!=0)
			$offset-=2;
	}
	echo '<div id="danceFloor">Dance Floor</div>';
?>