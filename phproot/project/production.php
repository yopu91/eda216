<?php
	require_once('database.inc.php');

	$avalPallets = $db->getAllPallets();
	$blockedPallets = $db->getBlockedPallets();
?>

<html>
<head><title>Krusty Kookies Sweden AB</title><head>
<body>
<h1>Pallets</h1>

<a href=/project/>Back to start</a>

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
        $blocked = $pallet['blocked'] ? 'BLOCKED' : '';

        echo '<tr>';
        echo "<td>$barcode</td>";
        echo "<td>$cookie</td>";
        echo "<td>$blocked</td>";
        echo '</tr>';
    }
?>
</tbody>
</table>
</body>
</html>
