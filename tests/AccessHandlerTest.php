<?php

use jlaucho\practica\AccessHandler;
use jlaucho\practica\Autenticatior;
use jlaucho\practica\SessionArrayDriver;
use jlaucho\practica\SessionManager;
use jlaucho\practica\Stubs\AuthenticatedStubs;

class AccessHandlerTest extends PHPUnit\Framework\TestCase
{
    public function test_grant_access()

    {
        $auth = new AuthenticatedStubs();

        $access = new AccessHandler( $auth );
        $this->assertTrue(

        $access->check('admin')
        );
    }

    public function test_deny_access()
    {
        $auth = new AuthenticatedStubs();

        $access = new AccessHandler($auth);

        $this->assertFalse(
            $access->check('usuario')
        );
    }
}