<?php

namespace apple;

use water\Water;

class Apple
{
    public $p = 'p';

    public function __construct($a)
    {
        echo __CLASS__, " construct with $a";
    }

    public function fuck()
    {
        echo "apple echo" . PHP_EOL;
    }
}