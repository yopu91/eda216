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
    <form action=/project/baking.php method=get>
        <select name=cookie>
        <option<?php if (!$cookie) { echo' selected'; } ?>>
<?php
        foreach ($cookies as $name) {
            echo "<option value='$name'";
            if ($name == $cookie) {
                echo ' selected';
            }
            echo ">$name</option>";
        }
?>
        </select>
    <input type=submit value=Get>
    </form>

    <table>
    <thead>
        <th>Ingredient</th>
        <th>Amount</th>
    </thead>
    <tbody>
<?php
    foreach ($cookieRecipe as $recipe) {
        $ingredient = $recipe['ingredientName'];
        $amount = $recipe['amount'];

        echo '<tr>';
        echo "<td>$ingredient</td>";
        echo "<td>$amount</td>";
        echo '</tr>';
    }
?>
</body>
</html>

