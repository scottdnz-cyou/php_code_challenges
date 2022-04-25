<?php

function wrap(string $string, int $length) : string {
    $lineBreakChar = "\n";
    $chars = str_split($string);
    $lenStr = count($chars);
    
    $eolReached = false;
    $currentLineChars = "";
    $currentWord = "";
    $currentLinePosition = 0;
    $maxPosition = $lenStr - 1;
    
    $lines = [];
    
    for ($i = 0; $i < $lenStr; $i++) {
        if ($i > 0 && ($i % $length === 0 || $i === $maxPosition)) {
            $eolReached = true;
            echo "\n*EOL reached\n";
        }
        
        if ($i === $maxPosition) {
            $currentWord .= $chars[$i];
            $currentLineChars .= $currentWord;
            $lines[] = $currentWord;
        }
            
        
        $isWantedChar = preg_match("/[a-zA-z\d]/", $chars[$i], $matches);
        
        
        if ($isWantedChar) {
            $currentWord .= $chars[$i];
        }
        else {
            if ($eolReached ) {
//                echo "\n* eol reached && !isWantedChar, i: " . 
//                        $currentLinePosition . "\n";
                
                if ($chars[$i] === " ") {
                    
                    if ( (strlen($currentLineChars) + strlen($currentWord)) <= $length) {
                        $currentLineChars .= $currentWord;
                        $lines[] = $currentLineChars;
//                        $currentLineChars = "";
                        
                    }
                    else {
                        $lines[] = $currentLineChars;
//                        $currentLineChars = ""; 
                    }
                }
                else {
                    // Seems problem with going beyond boundary & a wanted character
                    
                    if ( (strlen($currentLineChars) + (strlen($currentWord)) + 1) <= $length) {
                        $currentLineChars .= $currentWord;
                        $currentLineChars .= $chars[$i];
                        $lines[] = $currentLineChars;
//                        $currentLineChars = ""; 
                    }
                    else {
                        $lines[] = $currentLineChars;
//                        $currentLineChars = ""; 
                        
                    }
                }
                $currentLineChars = ""; 
                $currentWord .= $chars[$i];
                
                $eolReached = false;
                
            }
            else {
                echo $currentWord . "\t";
                $currentLineChars .= $currentWord;
                $currentLineChars .= $chars[$i];
                $currentWord = "";
            }
        }
    }
    
    return implode("\n", $lines);
}



function main() {
    $inputString = file_get_contents("./data/dummy_string.txt");
    $length = 40;
    echo wrap($inputString, $length);
}

main();

