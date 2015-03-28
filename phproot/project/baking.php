<?php
require_once('database.inc.php');

$cookie = $_GET['cookie'];

if ($cookie)
    $cookieRecipe = $db->getRecipe($cookie);

$cookies = $db->getCookies();
?>

<html>
<head><title>Krusty Kookies Sweden AB</title>
<style>
html {
    background: url('/swedish.jpg') no-repeat right bottom;
    background-size: 500px;
    height: 100%;
}
</style>
</head>
<body>
    <h1>Recipes</h1>

    <a href=/project/>Back to start</a>

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

<?php 
    if ($cookie) {
        echo "<h2>Required ingredients for $cookie</h2>";
        echo <<<eof
    <table>
    <thead>
        <th>Ingredient</th>
        <th>Amount</th>
    </thead>
    <tbody>
eof;
        foreach ($cookieRecipe as $recipe) {
            $ingredient = $recipe['ingredientName'];
            $amount = $recipe['amount'];

            echo '<tr>';
            echo "<td>$ingredient</td>";
            echo "<td>$amount</td>";
            echo '</tr>';
        }
    } 
?>
    </tbody>
    </table>
</body>
</html>

