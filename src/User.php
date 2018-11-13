<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 08:11 AM
 */

namespace jlaucho\practica;


class User
{
    protected $attributes;

    public function __construct( array $attributes = array() )
    {
        $this->attributes = $attributes;
    }

    public function __get($var)
    {
        return $this->attributes[$var] ?? null;
    }
}