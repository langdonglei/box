<?php

function __autoload($class)
{
    require_once "{$class}.php";
}

Box::zj()->mk('apple\Apple')->fuck();







