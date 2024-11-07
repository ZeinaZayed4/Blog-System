<?php
    
    //    $command = readline();
    
    if (!defined('STDIN')) {
        defined('STDIN', "fopen('php://stdin', 'r')");
    }

    $command = fgets(STDIN);
    $output = "Hello " . $command . "!";
    
    fwrite(STDOUT, $output);
    