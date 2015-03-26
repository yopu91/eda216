<?php
require_once('database.inc.php');

$cookie = $_GET['cookie'];

if ($cookie)
    $cookieRecipe = $db->getRecipe($cookie);

$cookies = $db->getCookies();
?>

<html>
<head><title>Krusty Kookies Sweden AB</title></head>
<body>
    <h1>Recipes</h1>

<?php 
    if ($cookie) {
        echo "<h2>$cookie</h2>";
    } 
?>
    <form action=/cookie.php method=get>
        <select name=cookie>
        <option<?php if (!$cookie) { echo' selected'; } ?>>
<?php
        foreach ($name as $cookies) {
            echo "<option value='$name'";
            if ($name == $cookie) {
                echo ' selected';
            }
            echo '>';
        }
?>
        </select>
    </form>

    <table>
    <thead>
        <th>Ingredient</th>
        <th>Amount</th>
    </thead>
</body>
</html>
