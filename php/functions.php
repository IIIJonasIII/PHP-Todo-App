<?php 
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function skrivUt($array){
        foreach($array as $note){
            echo "
            <section class='notes'>
                <p>$note</p>
                <section class='small-buttons'>
                    <button>✓</button>
                    <button>✎</button>
                    <button>X</button>
                </section>
            </section>
            ";
        }
    }
    function sparaCsv($file, $array){
        $file = fopen("$file", "w");
        fputcsv($file, $array);
        fclose($file);
    }

    function sparaTxt($file, $array){
        file_put_contents($file, implode(PHP_EOL, $array));
    }

    function sparaJson($file, $array){
        file_put_contents($file, json_encode($array));
    }

    function laddaCsv($file){ //fel
        $file = fopen("$file", "r");
        fgetcsv($file);
        fclose($file);
    }

    function laddaTxt($file){
        return array_map('trim', file($file));
    }

    function laddaJson($file){
        return json_decode(file_get_contents($file), true);
    }
    function uppdateraSidan(){
        header("Location: " . $_SERVER["PHP_SELF"]); 
        exit;
    }
?>