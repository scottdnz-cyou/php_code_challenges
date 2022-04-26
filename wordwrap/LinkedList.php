<?php
require "./vendor/autoload.php";

/**
 * This class was mostly taken from the Packt Data Structures & Algorithms book.
 */
class LinkedList { 
    private $_firstNode = NULL; 
    private $_totalNodes = 0; 

    /**
     * 
     * @param string $data
     * @return boolean
     */
    public function insert(string $data = NULL) { 
       $newNode = new ListNode($data); 

        if ($this->_firstNode === NULL) {           
            $this->_firstNode = &$newNode;             
        } else { 
            $currentNode = $this->_firstNode; 
            while ($currentNode->next !== NULL) { 
                $currentNode = $currentNode->next; 
            } 
            $currentNode->next = $newNode; 
        } 
       $this->_totalNodes++; 
        return TRUE; 
    } 

    /**
     * 
     * @return string
     */
    public function display() : string {
//        echo "Total nodes: ".$this->_totalNodes."\n";
        $output = "";
        $currentNode = $this->_firstNode; 
        while ($currentNode !== NULL) { 
//            echo $currentNode->data . "\n"; 
            $output .= $currentNode->data . "\n";
            $currentNode = $currentNode->next; 
        } 
        return $output;
    } 
}