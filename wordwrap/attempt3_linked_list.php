<?php
require "./vendor/autoload.php";

 /**
  * A script to wrap text at $length characters.
  * This version uses a different data structure (a linked list) and has a bit 
  * of refactoring.
  */

//use LinkedList;

/**
 * @param int $lenLine
 * @param string $currentChar
 * @param int $length
 * @param string $currentLineChars
 * @param LinkedList $lines
 * @param string $currentWord
 * @param bool $eolReached
 */
function processEOLAndNonWordChar(int $lenLine, 
        string $currentChar,
        int $length, 
        string &$currentLineChars, 
        LinkedList &$lines,
        string &$currentWord,
        bool &$eolReached
        ) {
    if ($lenLine < $length) {
        // There's enough space to add the last word in the line
        $currentLineChars .= $currentWord;

        // Append the non-word character if it's not whitespace
        if (!empty(trim($currentChar))) {
            $currentLineChars .= $currentChar;
        }

        $lines->insert($currentLineChars);
        $currentLineChars = "";

    }
    else {
        // There's NOT enough space to add the last word in the line
        $lines->insert($currentLineChars);
        $currentLineChars = $currentWord . $currentChar;
    }

    $currentWord = "";
    $eolReached = false;
}

/**
 * 
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
    
    // Lines is our array acting like a "stack".
    $lines = new LinkedList();
    
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
                processEOLAndNonWordChar($lenLine, 
                    $currentChar,
                    $length, 
                    $currentLineChars, 
                    $lines,
                    $currentWord,
                    $eolReached);
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

    return $lines->display();
}


/**
 * Uncomment to see output, reading a test text file to get the string.
 * @return void
 */
function main() : void {
    $inputString = file_get_contents("./data/dummy_string.txt");
    $length = 40;
    echo wrap($inputString, $length);
}

main();
