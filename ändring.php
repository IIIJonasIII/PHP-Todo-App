<?php 
require("php/functions.php");
$jsonFile = "assets/todo.json";
$notes = laddaJson($jsonFile);  

$editIndex = isset($_GET["redigera"]) ? $_GET["redigera"] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["spara"])) {
    $index = $_POST["index"];
    $nyText = test_input($_POST["nyText"]);
    $notes[$index]['task'] = $nyText;
    sparaJson($jsonFile, $notes);
    header("Location: ändring.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Jonas---TODO-APP</title>
</head>
<body>
    <section class="page-wrapper">
        <h1>TODO-APP</h1>
        <form method="GET" class="textfält">
            <input type="text" name="textruta">
            <button type="submit">+</button>
        </form>
        <?php
        foreach ($notes as $index => $note) {
            if ($editIndex !== null && $editIndex == $index) {
                // Om vi redigerar detta index, visa en textruta
                echo '<form method="post" class="notes">
                        <input type="hidden" name="index" value="' . $index . '">
                        <input type="text" name="nyText" value="' . htmlspecialchars($note["task"]) . '">
                        <button type="submit" name="spara">Spara</button>
                      </form>';
            } else {
                // Visa bara texten om vi inte redigerar
                echo '<form method="get" class="notes">
                        <p>' . ($index + 1) . '. ' . htmlspecialchars($note["task"]) . '</p>
                        <button type="submit" name="redigera" value="' . $index . '">✎</button>
                      </form>';
            }
        }
        ?>
        
        <section class="big-buttons">
            <a href="index.php">
                <button>Tillbaka</button>
            </a>
        </section>
    </section>
</body>
</html>
