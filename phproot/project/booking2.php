<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$userId = $_SESSION['userId'];
	$db->openConnection();
	
	$movieName = $_POST["movieName"];
	$movieDates = $db->getMovieDates($movieName);
	$db->closeConnection();
?>

<html>
<head><title>Booking 2</title><head>
<body><h1>Booking 2</h1>
	Current user: <?php print $userId ?>
	<p>
	Selected movie : <?php print $movieName ?>
	<p>
	Performance date:
	<p>
	<form method=post action="booking3.php">
		<input type="hidden" name="movieName" value="<?php print $movieName?>">
		<select name="movieDate" size=10>
		<?php
			$first = true;
			foreach ($movieDates as $date) {
				if ($first) {
					print "<option selected>";
					$first = false;
				} else {
					print "<option>";
				}
				print $date;
			}
		?>
		</select>		
		<input type=submit value="Select date">
	</form>
</body>
</html>
