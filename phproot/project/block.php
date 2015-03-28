<?php
require_once('database.inc.php');

$code = $_GET['code'];
$status_str = $_GET['status'];
$status = $status_str == 'Good sample' ? false : true;

if ($code) {
    $db->registerSample($code, $status);
} 
?>

<html>
<head><title>Krusty Kookies Sweden AB</title>
<style>
html {
    background: url('/virus.png') no-repeat right bottom;
    background-size: 300px;
    height: 100%;
}
</style>
</head>
<body>
    <h1>Register sample</h1>

    <a href=/project/>Back to start</a>

<?php
    if ($code) {
        echo '<h2>Sample was registered</h2>';
    }
?>

    <form action=/project/block.php method=get>
        <label id=code>Barcode</label>
        <input name=code>
        <input type=submit name=status value='Good sample'>
        <input type=submit name=status value='Bad sample'>
    </form>
</body>
</html>

