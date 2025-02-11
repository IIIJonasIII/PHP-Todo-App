<?php 
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function sparaJson($filename, $array){
        file_put_contents($filename, json_encode($array, JSON_PRETTY_PRINT));
    }

    function laddaJson($filename) {
        $array = [];
        if (file_exists($filename)) {
            $content = trim(file_get_contents($filename));
            if (!empty($content)) {
                $array = json_decode($content, true);
                if (!is_array($array)) {
                    $array = []; // Säkerhetsåtgärd om filen har ogiltig JSON
                }
            }
        }
        return $array;
    }

    
?>