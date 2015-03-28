<?php
	require_once('database.inc.php');

	$avalPallets = $db->getAllPallets();
	$blockedPallets = $db->getBlockedPallets();
?>

<html>
<head><title>Krusty Kookies Sweden AB</title><head>
<body>

    <a href=/project/>Back to start</a>

<div>
    <h1>Pallets</h1>

    <table>
    <thead>
        <th>Barcode</th>
        <th>Cookie</th>
        <th></th>
    </thead>
    <tbody>
    <?php
        foreach ($avalPallets as $pallet) {
            $barcode = $pallet['barcode'];
            $cookie = $pallet['cookieName'];
            $blocked = $pallet['faulty'] ? 'BLOCKED' : '';

            echo '<tr>';
            echo "<td>$barcode</td>";
            echo "<td>$cookie</td>";
            echo "<td>$blocked</td>";
            echo '</tr>';
        }
    ?>
    </tbody>
    </table>
</div>
<div>
    <h1>Blocked pallets</h1>

    <table>
    <thead>
        <th>Barcode</th>
        <th>Cookie</th>
    </thead>
    <tbody>
    <?php
        foreach ($blockedPallets as $pallet) {
            $barcode = $pallet['barcode'];
            $cookie = $pallet['cookieName'];

            echo '<tr>';
            echo "<td>$barcode</td>";
            echo "<td>$cookie</td>";
            echo '</tr>';
        }
    ?>
    </tbody>
    </table>
</div>
</body>
</html>
