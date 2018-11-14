<?php

use jlaucho\practica\AccessHandler;
use jlaucho\practica\Autenticatior;
use jlaucho\practica\AuthenticatioInterface;
use jlaucho\practica\Stubs\AuthenticatedStubs;
use jlaucho\practica\User;

class AccessHandlerTest extends PHPUnit\Framework\TestCase
{
    protected $auth;
    public function tearDown()
    {
        Mockery::close();
    }

    protected function getAutenticationMoc () {
        $this->auth = Mockery::mock(Autenticatior::class);
        $this->auth->shouldReceive('check')
            ->once()
            ->andReturn(true);

        $user = Mockery::mock(User::class);
        $user->role = 'admin';

       $this->auth->shouldReceive('user')
            ->once()
            ->andReturn($user);
    }
    public function test_grant_access()

    {
        $this->getAutenticationMoc();
        $access = new AccessHandler($this->auth);

        $this->assertTrue(
            $access->check('admin')
        );
    }

    public function test_deny_access()
    {
        $this->getAutenticationMoc();
        $access = new AccessHandler($this->auth);

        $this->assertFalse(
            $access->check('usuario')
        );
    }
}