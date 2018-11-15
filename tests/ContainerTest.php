<?php

use jlaucho\practica\Container;

/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 15/11/18
 * Time: 07:34 AM
 */

class ContainerTest extends PHPUnit\Framework\TestCase
{
    public function test_bind_clousure()
    {
        $container = new Container();
        $container->bind('key', function() {
            return 'Object';
        });

        $this->assertSame('Object', $container->make('key'));
    }

    public function test_bind_instance()
    {
        $container = new Container;

        $stdClass = new StdClass();

        $container->instance('key', $stdClass);

        $this->assertSame($stdClass, $container->make('key'));
    }
    public function test_bind_from_class_name()
    {
        $container = new Container();

        $container->bind('key', 'StdClass');

        $this->assertInstanceOf('StdClass', $container->make('key'));
    }

    public function test_bind_with_automatic_resolution()
    {
        $container = new Container();
        $container->bind('foo', 'Foo');

        $this->assertInstanceOf('Foo', $container->make('foo'));

    }


}
class Foo {

    public function __construct(Bar $bar, Baz $baz, Pedro $pedro)
    {

    }
}
class Bar {

    public function __construct(FooBar $fooBar)
    {

    }

}
class FooBar {

}

class Baz {

}
