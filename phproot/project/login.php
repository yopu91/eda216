<?php
	require_once('database.inc.php');
	require_once("mysql_connect_data.inc.php");
	
	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();

	if (!$db->isConnected()) {
//		header("Location: cannotConnect.html");
		exit();
	}

        echo 'Wellkom!';
	
	session_start();
	$_SESSION['db'] = $db;
	header("Location: index.html");
?>
