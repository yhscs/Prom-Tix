<?php
	$pass = $_POST['pass'];

	if ($pass != 'PASS_HERE')
		exit('The password was incorrect.');
	else
	{
		// Find all shirt sizes
		require_once('db.php');
		$shirts=$dbh->prepare("SELECT DISTINCT `Shirt` FROM `promTix`");
		$shirts->execute();
		$numShirts=$shirts->rowCount();
		$shirts=$shirts->fetchAll();

		// Output count of shirt sizes
		echo '<h2>Shirt Sizes</h2>';
		
		// xs, s, m, l, xl, xxl
		for ($i=0;$i<$numShirts;$i++)
		{
			$result=$dbh->prepare("SELECT COUNT(`Shirt`) AS `Sum` FROM `promTix` WHERE `Shirt` = ?");
			$result->execute(array($shirts[$i]['Shirt']));
			$count=$result->fetch()['Sum'];
			
			$result=$dbh->prepare("SELECT COUNT(`Shirt`) AS `Sum` FROM `promGuests` WHERE `Shirt` = ?");
			$result->execute(array($shirts[$i]['Shirt']));
			$count+=$result->fetch()['Sum'];
			
			if ($shirts[$i]['Shirt'] == 'xs')
				echo '<h3>Extra Small: ';
			else if ($shirts[$i]['Shirt'] == 's')
				echo '<h3>Small: ';
			else if ($shirts[$i]['Shirt'] == 'm')
				echo '<h3>Medium: ';
			else if ($shirts[$i]['Shirt'] == 'l')
				echo '<h3>Large: ';
			else if ($shirts[$i]['Shirt'] == 'xl')
				echo '<h3>Extra Large: ';
			else if ($shirts[$i]['Shirt'] == 'xxl')
				echo '<h3>XXL: ';
				
			echo $count.'</h3>';
		}
	}
?>