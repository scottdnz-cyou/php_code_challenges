<?php

/**
 * This class was mostly taken from the Packt Data Structures & Algorithms book.
 */
class ListNode { 
    /**
     * @var type
     */
    public $data = NULL; 
    
    /**
     * @var type
     */
    public $next = NULL; 

    /**
     * @param string $data
     */
    public function __construct(string $data = NULL) { 
        $this->data = $data; 
    } 
}
