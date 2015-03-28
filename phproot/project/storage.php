<?php
require_once('database.inc.php');

$code = $_POST['code'];
$type = $_POST['type'];

if ($code) {
    $db->newPallet($code, $type);
    $db->locatePallet($code, 'Cold storage');
}

?>

<html>
<head><title>Krusty Kookies Sweden AB</title>
<style>
html {
    background: url('/replaceme') no-repeat right bottom;
    background-size: 300px;
    height: 100%;
}
</style>
</head>
<body>
    <h1>Storage</h1>

    <a href=/project/>Back to start</a>

<?php
    if ($code) 
        echo '<h2>Pallet was registered</h2>';
    else
        echo '<h2>Register new pallet</h2>';
?>

    <form action=/project/storage.php method=post>
        <label id=code>Barcode</label>
        <input name=code>
        <br>
        <label id=type>Type of cookie</label>
        <select name=type>
<?php
        foreach ($db->getCookies() as $cookie) {
            echo "<option value='$cookie'>$cookie</option>";
        }
?>
        </select>
        <input type=submit value=Register>
    </form>
</body>
</html>

