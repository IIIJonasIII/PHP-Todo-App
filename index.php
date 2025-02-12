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

        
        <?php

            echo '   
            <form method="GET" class="textfält">
            <input type="text" name="textruta">
            <button type="submit">+</button>
            </form>';

            $gömd = 'type="hidden"';
            if (isset($_GET["redigera"])){
                $gömd = 'type="text"';
                $index = $_GET["redigera"];
                if (!empty($_GET["ändraruta"])) {
                    $nyÄndring = $_GET["ändraruta"];
                    $notes[$index]['task'] = $nyÄndring;
                    sparaJson($jsonFile, $notes);
                }
            }
            
            if (!empty($_GET["textruta"])) {
                $note = test_input($_GET["textruta"]);
                $notes[] = ["task" => $note, "done" => false];
                sparaJson($jsonFile, $notes);
            }
            
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

            if (isset($_GET["tabort"])) {
                $tabort = $_GET['tabort'];
                unset($notes[$tabort]);  
                $notes = array_values($notes);  
                sparaJson($jsonFile, $notes);
            }

            foreach ($notes as $index => $note) {
                $färg = $note["done"] ? "green" : "white";
                echo '<form method="GET" class="notes">
                        <section class="parent">
                            <input '.$gömd.' name="ändraruta" class="gömdbox" value="' . test_input($note["task"]) . '"></input>
                            <button '.$gömd.' class="gömdknapp" type="submit">+</button>
                            <p>' . ($index + 1) . '. ' . test_input($note["task"]) . '</p>
                        </section>
                        <section class="small-buttons">
                            <button style="color: '.$färg.'" type="submit" name="klar" value="' . $index . '">✓</button>
                            <button type="submit" name="redigera" value="' . $index . '">✎</button>
                            <button type="submit" name="tabort" value="' . $index . '">X</button>
                        </section>
                    </form>';
            }
            
        ?>

    </section>
</body>
</html>