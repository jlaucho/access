<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 04:51 PM
 */

namespace jlaucho\practica\Stubs;


use jlaucho\practica\AuthenticatioInterface;
use jlaucho\practica\User;

class AuthenticatedStubs implements AuthenticatioInterface
{
    public function check()
    {
        return true;
    }

    public function user()
    {
        return new User([
            'name' => 'Jesus Laucho',
            'role' => 'admin'
        ]);
    }
}