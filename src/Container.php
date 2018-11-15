<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 15/11/18
 * Time: 07:42 AM
 */

namespace jlaucho\practica;


use http\Exception\InvalidArgumentException;
use ReflectionClass;

class Container
{
    protected $bindings = [];
    protected $shared = [];

    public function bind($name, $resolver )
    {
        $this->bindings[$name] = [
            'resolver' => $resolver
        ];
    }

    public function make($name)
    {
        if(isset($this->shared[$name])) {
            return $this->shared[$name];
        }


        $resolver = $this->bindings[$name]['resolver'];
        if ($resolver instanceof \Closure){

            $object = $resolver($this);
        } else {

            $object = $this->build($resolver);
        }
        return $object;

    }


    public function instance($name, $object)
    {
        $this->shared[$name] = $object;
    }

    protected function build($name)
    {
        $reflection = new ReflectionClass($name);

        if(!$reflection->isInstantiable()) {
            throw new \InvalidArgumentException($name . " No es instanciable");
        }

        $constructor = $reflection->getConstructor();

        if(!$constructor) {
            return new $name;
        }

        $constructorParameters = $constructor->getParameters();

        $arguments = array();
        foreach ($constructorParameters as $constructorParameter) {
            $parameterClassName = $constructorParameter->getClass()->getName();
            $arguments[] = $this->build($parameterClassName);
        }

        return $reflection->newInstanceArgs($arguments);
    }


}