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
use ReflectionException;

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

    public function make($name, array $arguments = array())
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

    protected function build($name, array $arguments = array())
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

            $name = $constructorParameter->getName();
            try {
                $if_class = $constructorParameter->getClass();
            } catch (ReflectionException $e) {
                throw new ContainerException('Error al intentar construir la clase '. $name .': '. $e->getMessage(), 888, $e);
            }

            if($if_class !== null){
                $parameterClassName = $if_class->getName();

                $arguments[] = $this->build($parameterClassName);
            } else {
                throw new ContainerException("Introduce los datos de parametro[".$name."]");
            }
        }

        return $reflection->newInstanceArgs($arguments);
    }


}