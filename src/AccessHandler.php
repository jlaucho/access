<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 07:20 AM
 */

namespace jlaucho\practica;

use jlaucho\practica\Autenticatior as Auth;


class AccessHandler
{

    protected $auth;

    /**
     * AccessHandler constructor.
     * @param jlaucho\practica\Autenticatior $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function check ($role)
    {
        return $this->auth->check() && $this->auth->user()->role === $role;
    }
}