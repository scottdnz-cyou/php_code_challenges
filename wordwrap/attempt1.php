<?php

function wrap(string $string, int $length) : string {
    $lineBreakChar = "\n";
    $chars = str_split($string);
    $lenStr = count($chars);
    
    $eolReached = false;
    $currentLineChars = [];
    $currentWord = "";
//    $lastWordBreakPosition = -1;
    $currentLinePosition = 0;
    
    for ($i = 0; $i < $lenStr; $i++) {
        $isWantedChar = preg_match("/[a-zA-z\d]/", $chars[$i], $matches);
        
        
        if ($isWantedChar) {
            $currentWord .= $chars[$i];
        }
        else {
             if ($currentLinePosition < $length) {
                $currentLineChars[] = $currentWord;
                $currentLineChars[] = $chars[$i];
            }
            else {
                $currentLinePosition = 0;
                $currentLineChars = [];
            }
            $currentWord = "";
        }
        
        if ($i % $length === 0) {
            $eolReached = true;
            echo "*EOL\n";
        }
        
        if ($eolReached) {
            echo " " . $chars[$i] . " ";
        }
        
        if ($eolReached && !$isWantedChar ) {
            echo "eolReached && !isWantedChar\n";
            $currentLinePosition = 0;
            $eolReached = false;
            $lastWordBreakPosition = -1;
        }
        
        $currentLinePosition++;
    }
}

function main() {
    $inputString = file_get_contents("./data/dummy_string.txt");
    $length = 70;
    wrap($inputString, $length);
}

main();

