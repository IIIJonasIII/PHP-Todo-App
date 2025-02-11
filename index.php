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

        <form method="POST" class="textfält">
            <input type="text" name="textruta">
            <button type="submit">+</button>
        </form>

        <?php   
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["textruta"])) {
                $notes[] = test_input($_POST["textruta"]);
                sparaJson($jsonFile, $notes);
            }
            
            foreach ($notes as $index => $note) {
                echo "<form method='post' class='notes'>
                        <p>{$note}</p>
                        <section class='small-buttons'>
                            <button type='submit' name='klar'>✓</button>
                            <button type='submit' name='redigera'>✎</button>
                            <button type='submit' name='tabort'>X</button>
                        </section>
                    </form>";
            }
        ?>

    </section>
</body>
</html>