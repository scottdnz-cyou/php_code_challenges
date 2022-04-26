<?php

/**
 * A script to wraps text at $length characters.
 * - adds line breaks between each segment of $length.
 * - when breaking at word boundaries, replace all the white space between the two 
 * words with a single newline character. 
 * - Any unbroken white space should be left unchanged.
 * @param string $string
 * @param int $length
 * @return string
 */
function wrap(string $string, int $length) : string {
    $lineBreakChar = "\n";
    $chars = str_split($string);
    $lenStr = count($chars);
    
    $eolReached = false;
    $currentLineChars = "";
    $currentWord = "";
    $maxPosition = $lenStr - 1;
    
    $lines = [];
    
    for ($i = 0; $i < $lenStr; $i++) {
        $lenLine = strlen($currentLineChars) + strlen($currentWord);
        if ($lenLine > $length || $i === $maxPosition) {
            $eolReached = true;
        }
        
        $currentChar = $chars[$i];

        $isWordChar = preg_match("/[a-zA-z\d]/", $chars[$i], $matches);
        if ($isWordChar) {
            $currentWord .= $currentChar;
        }
        
        if (!$isWordChar || $i === $maxPosition) {

            // A non-word character, e.g. space, dash, full stop or the final 
            // character in the string.
            if ($eolReached) {
                if ($lenLine < $length) {
                    // There's enough space to add the last word in the line
                    $currentLineChars .= $currentWord;
                    
                    // Append the non-word character if it's not whitespace
                    if (!empty(trim($currentChar))) {
                        $currentLineChars .= $currentChar;
                    }
                    
                    $lines[] = $currentLineChars;
                    $currentLineChars = "";
                    
                }
                else {
                    // There's NOT enough space to add the last word in the line
                    $lines[] = $currentLineChars;
                    $currentLineChars = $currentWord . $currentChar;
                }
                
                $currentWord = "";
                $eolReached = false;
            }
            else {
                // We don't want white space after moving to a new line at the start.
                if (empty(trim($currentLineChars . $currentWord . $currentChar))) {
                    continue;
                }
                
                $currentLineChars .= $currentWord . $currentChar;
                $currentWord = "";
            }
        }
        
    }

    return implode($lineBreakChar, $lines);
}


/**
 * Uncomment to see output, reading a test text file to get the string.
 * @return void
 */
//function main() : void {
//    $inputString = file_get_contents("./data/dummy_string.txt");
//    $length = 40;
//    echo wrap($inputString, $length);
//}
//
//main();

