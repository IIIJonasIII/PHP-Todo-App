<?php 
    require("php/functions.php");
    $txtFile = "assets/todo.txt";
    $jsonFile = "assets/todo.json";
    $csvFile = "assets/todo.csv";
    $knappFärg = isset($_POST["nuvarandeFärg"]) && $_POST["nuvarandeFärg"] === "white" ? "green" : "white";
    $notes = ["Handla", "Fotbollsträning", "Laga mat"];
    
    // $notes = file_exists($jsonFile) ? laddaJson($jsonFile) : ["Handla", "Fotbollsträning", "Laga mat"];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["textruta"])){
        $notes[] = $_POST["textruta"];
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

        <form method="POST" class="textfält">
            <input type="text" name="textruta">
            <button type="submit">+</button>
        </form>
        <form method="post" class='notes'>
            <p>$note</p>
            <section class='small-buttons'>
                <button type="submit" name="klar" style="color: <?php echo $knappFärg?>">✓</button>
                <input type="hidden" name="nuvarandeFärg" value="<?php echo $knappFärg ?>">
                <button type="submit" name="redigera">✎</button>
                <button type="submit" name="tabort">X</button>
            </section>
        </form>
        <?php 
            skrivUt($notes);
        ?>

        <form method="POST" class="big-buttons">
            <section class="spara">
                <p>Spara: </p>
                <button type="submit" name="sparatxt">.TXT</button>
                <button type="submit" name="sparajson">.JSON</button>
                <button type="submit" name="sparacsv">.CSV</button>
            </section>
            <section class="ladda">
                <p>Ladda: </p>
                <button type="submit" name="laddatxt">.TXT</button>
                <button type="submit" name="laddajson">.JSON</button>
                <button type="submit" name="laddacsv">.CSV</button>
            </section>
        </form>
        
        <?php 
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if(isset($_POST["sparatxt"])){
                    sparaTxt($txtFile, $notes);
                }
                if(isset($_POST["sparajson"])){
                    sparaJson($jsonFile, $notes);
                }
                if(isset($_POST["sparacsv"])){
                    sparaCsv($csvFile, $notes);
                }
                if(isset($_POST["laddatxt"])){
                    $notes = laddaTxt($txtFile);
                }
                if(isset($_POST["laddajson"])){
                    $notes = laddaJson($jsonFile);
                }
                if(isset($_POST["laddacsv"])){
                    $notes = laddaCsv($csvFile);
                }
            }
            
        ?>
 
    </section>
</body>
</html>