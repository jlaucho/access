<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 02:19 PM
 */

namespace jlaucho\practica;


class SessionArrayDriver implements SessionDriversInterface
{
    protected $data;

    public function __construct(array $data = array())
    {

        $this->data = $data;
    }

    public function load()
    {
        return $this->data;
    }
}