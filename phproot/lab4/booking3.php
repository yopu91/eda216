<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$userId = $_SESSION['userId'];
	$db->openConnection();
	
	$movieName = $_POST["movieName"];
	$movieDate = $_POST['movieDate'];

	$movieData = $db->getMovieData($movieName, $movieDate);
	$db->closeConnection();
?>

<html>
<head><title>Booking 3</title><head>
<body><h1>Booking 3</h1>
	Current user: <?php print $userId ?>
	<h2>
	Data for selected movie:
	</h2>
	<dl>
	<dt>Movie: 
	<dd><?php print $movieName ?>
	<dt>Date:
	<dd><?php print $movieDate ?>
	<dt>Theatre:
	<dd><?php print $movieData['theatreName'] ?>
	<dt>Free seats:
	<dd><?php print $movieData['freeSeats'] ?>
	</dl>

	<form method=post action="booking4.php">
		<input type="hidden" name="movieName" value="<?php print $movieName?>">
		<input type="hidden" name="movieDate" value="<?php print $movieDate?>">
		<input type=submit value="Book ticket">
	</form>
</body>
</html>
