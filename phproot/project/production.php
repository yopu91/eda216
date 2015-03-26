<?php
	require_once('database.inc.php');
	
	session_start();
	$db = $_SESSION['db'];
	$db->openConnection();

	$avalPallets = $db->getAllPallets();
	$blockedPallets = $db->getBlockedPallets();
?>

<html>
<head><title>Krusty Kookies Sweden AB</title><head>
<body>
<h1>Production</h1>
<h1>Blocking</h1>
<h1>Search</h1>
	Current user: <?php print $userId ?>
	<p>
	Movies showing:
	<p>
	<form method=post action="booking2.php">
		<select name="movieName" size=10>
		<?php
			$first = true;
			foreach ($movieNames as $name) {
				if ($first) {
					print "<option selected>";
					$first = false;
				} else {
					print "<option>";
				}
				print $name;
			}
		?>
		</select>		
		<input type=submit value="Select movie">
	</form>
</body>
</html>
