<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 04:56 PM
 */

namespace jlaucho\practica;


interface AuthenticatioInterface
{
    public function check();

    public function user();
}