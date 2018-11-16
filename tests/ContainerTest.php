<?php

use jlaucho\practica\Container;
use jlaucho\practica\ContainerException;

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

    public function test_exception_if_dependency_no_exist () {

        $this->expectException(
            ContainerException::class,
            "Excepcion de inyeccion de dependencias controlada"
        );
        $container = new Container();

        $container->bind('qux', 'Qux');

        $container->make('qux');
    }

    public function test_class_does_not_exist () {
        $this->expectException(
            ReflectionException::class,
            "La clase [Abc] no existe"
        );
        $container = new Container();

        $container->bind('abc', 'Abc');

        $container->make('abc');
    }

    public function test_mail_container_with_parameters(){
        $container = new Container();

        $container->bind('mail', 'MailDummy');


        $this->assertInstanceOf(
            MailDummy::class,
            $container->make(
                'mail',
                ['url' => 'rbservicios.com', 'key'=> 'secret']
            )
        );
    }


}
class Foo {

    public function __construct(Bar $bar, Baz $baz)
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
class Qux {
    public function __construct(Norf $norf)
    {
    }

}

class MailDummy {
    private $url;
    private $key;

    public function __construct($url, $key)
    {
        $this->url = $url;
        $this->key = $key;
    }
}
