<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$userId = $_SESSION['userId'];
	$db->openConnection();
	
	$movieName = $_POST["movieName"];
	$movieDate = $_POST['movieDate'];
	$resNumber = $db->bookTicket($movieName, $movieDate, $userId);
	$db->closeConnection();
?>

<html>
<head><title>Booking 4</title><head>
<body><h1>Booking 4</h1>
	One ticket booked. Booking number: <?php print $resNumber ?>
	<?php if(!is_numeric($resNumber)){
		print "<center><img src='http://i.minus.com/ibmBjsEEBkOtyy.gif'></center>";
	} ?>
	<form method=post action="booking1.php">
		<input type="hidden" name="movieName" value="<?php print $movieName?>">
		<input type=submit value="New booking">
	</form>
</body>
</html>
