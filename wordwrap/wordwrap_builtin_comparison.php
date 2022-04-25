<?php

function main() {
    $inputString = file_get_contents("./data/dummy_string.txt");
    $length = 40;
    echo wordwrap($inputString, $length);
}

main();

