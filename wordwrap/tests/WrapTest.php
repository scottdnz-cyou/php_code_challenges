<?php
use PHPUnit\Framework\TestCase;

require_once getcwd() . "/attempt2.php";

/** 
 * Unit test(s) for the "attempt2" script.
 */
class WrapTest extends TestCase
{
    /**
     * 
     * @return void
     */
    public function testWrap(): void  {
        // Set up
        $inputString = file_get_contents(getcwd() . "/data/dummy_string.txt");
        $length = 40;
        
        $wrappedTextFromBuiltIn = wordwrap($inputString, $length);
        $linesFromBuiltIn = explode("\n", $wrappedTextFromBuiltIn);
        $linesFromBuiltIn = array_map(function($line) { return trim($line); },
            $linesFromBuiltIn
        );
        
        // Operate
        $wrappedTextFromAttempt = wrap($inputString, $length);
        $linesFromAttempt = explode("\n", $wrappedTextFromAttempt);
        $linesFromAttempt = array_map(function($line) { return trim($line); },
            $linesFromAttempt
        );
        
        // Assert - same number of lines
        $numLinesFromAttempt = count($linesFromAttempt);
        $this->assertSame(count($linesFromBuiltIn), $numLinesFromAttempt);
        
        // Assert - each line matches the expected
        for ($i = 0; $i < $numLinesFromAttempt; $i++) {
            $this->assertSame($linesFromBuiltIn[$i], $linesFromAttempt[$i]);
        }

    }
}
