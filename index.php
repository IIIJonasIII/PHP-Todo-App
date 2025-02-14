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
        <a href="index.php">
            <h1>TODO-APP</h1>
        </a>
        <form method="GET" class="textfält">
            <input type="text" name="textruta">
            <button type="submit">+</button>
        </form>
        
        <?php
            //Input text
            if (!empty($_GET["textruta"])) {
                $note = test_input($_GET["textruta"]);
                $notes[] = ["task" => $note, "done" => false];
                sparaJson($jsonFile, $notes);
            }

            //Klar-knapp
            if (isset($_GET["klar"])){
                $klar = $_GET["klar"];
                if ($notes[$klar]["done"] == true){
                    $notes[$klar]["done"] = false;
                    $färg = "white";
                }
                else if ($notes[$klar]["done"] == false){
                    $notes[$klar]["done"] = true;
                    $färg = "green";
                }
                sparaJson($jsonFile, $notes); 
            }

            //Redigera-knapp
            if (isset($_GET["redigera"])) {
                $index = $_GET["redigera"];
            }

            //Input för redigering
            if (isset($_GET["ändraruta"]) && isset($_GET["index"])) {
                $index = $_GET["index"];
                $nyÄndring = test_input($_GET["ändraruta"]);
                $notes[$index]['task'] = $nyÄndring;
                sparaJson($jsonFile, $notes);
            }
            
            //Ta bort-knapp
            if (isset($_GET["tabort"])) {
                $tabort = $_GET['tabort'];
                unset($notes[$tabort]);  
                $notes = array_values($notes);  
                sparaJson($jsonFile, $notes);
            }

            //Utskrift av anteckningar + knappar
            foreach ($notes as $index => $note) {
                $färg = $note["done"] ? "green" : "white";
                echo '<form method="GET" class="notes">
                            <p>' . ($index + 1) . '. ' . test_input($note["task"]) . '</p>
                        <section class="small-buttons">
                            <button style="color: '.$färg.'" type="submit" name="klar" value="' . $index . '">✓</button>
                            <button type="submit" name="redigera" value="' . $index . '">✎</button>
                            <button type="submit" name="tabort" value="' . $index . '">X</button>
                        </section>
                    </form>
                   ';
            }

            //Om redigera-kanppen är tryckt skrivs redigera-input ut
            if (isset($_GET["redigera"]) && isset($notes[$_GET["redigera"]])) {
                $index = $_GET["redigera"];
                echo '
                <form method="GET" class="textfält">
                    <input type="hidden" name="index" value="' . $index . '">
                    <input type="text" name="ändraruta" value="' . test_input($notes[$index]["task"]) . '">
                    <button type="submit">></button>
                </form>';
            }
            ?>

    </section>
</body>
</html>