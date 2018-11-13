<?php

use jlaucho\practica\AccessHandler;

class AccessHandlerTest extends PHPUnit\Framework\TestCase
{
    public function test_grant_access()

    {
//        $filedriver = new \jlaucho\practica\SessionFileDriver();
        $driver = new \jlaucho\practica\SessionArrayDriver([
            "user_data" => [
                "nombre" => "jesus Laucho",
                "role"  => "admin"
            ]
        ]);
        $session = new \jlaucho\practica\SessionManager($driver);
        $auth = new \jlaucho\practica\Autenticatior($session);
        $access = new AccessHandler( $auth );
        $this->assertTrue(

        $access->check('admin')
        );
    }

    public function test_deny_access()
    {
//        $filedriver = new \jlaucho\practica\SessionFileDriver();
        $driver = new \jlaucho\practica\SessionArrayDriver([
            "user_data" => [
                "nombre" => "jesus Laucjo",
                "role"  => "admin"
            ]
        ]);
        $session = new \jlaucho\practica\SessionManager($driver);
        $auth = new \jlaucho\practica\Autenticatior($session);
        $access = new AccessHandler($auth);

        $this->assertFalse(
            $access->check('usuario')
        );
    }
}