<?php

use jlaucho\practica\Container;

require __DIR__ . '/../bootstrap/start.php';

function studentController(){

$access = Container::getInstance()->access();

view('student',compact('access'));
}

studentController();

