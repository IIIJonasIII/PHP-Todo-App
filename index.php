<?php 
    require("php/functions.php");
    $jsonFile = "assets/todo.json";
    $notes = laddaJson($jsonFile);
        
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
            
            if (!empty($_GET["textruta"])) {
                $note = test_input($_GET["textruta"]);
                $notes[] = ["task" => $note, "done" => false];
                sparaJson($jsonFile, $notes);
            }

            foreach ($notes as $index => $note) {
                echo '<form method="GET" class="notes">
                        <p>' . ($index + 1) . '. ' . test_input($note["task"]) . '</p>
                        <section class="small-buttons">
                            <button type="submit" name="klar" value="' . $index . '">✓</button>
                            <button type="submit" name="redigera" value="' . $index . '">✎</button>
                            <button type="submit" name="tabort" value="' . $index . '">X</button>
                        </section>
                    </form>';
            }
        ?>

    </section>
</body>
</html>