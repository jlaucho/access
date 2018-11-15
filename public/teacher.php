<?php

use jlaucho\practica\Container;

require __DIR__ . '/../bootstrap/start.php';


function teacherController()
{
    $access = Container::getInstance()->access();

    if (!$access->check('teacher')) {

        abort404();

    }

    view('teacher', compact('access'));
}

return teacherController();