<?php

use jlaucho\practica\{AccessHandler, Autenticatior, Container, SessionArrayDriver, SessionManager};

require __DIR__ . '/../bootstrap/start.php';

function homeController() {

    $access = Container::getInstance()->access();

    view('index', compact('access'));
}

return homeController();
