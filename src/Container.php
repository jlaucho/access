<?php

namespace jlaucho\practica;

class Container {

   protected $shared = [];
   protected static $container;

    public static function getInstance()
    {
        if( static::$container == null ){
            static::$container = new Container;
        }
        return static::$container;
   }

    public static function setContainer(Container $container)
    {
        static::$container = $container;
   }

    public static function clearContainer()
    {
        static::$container = null;
   }
    public function session()
    {
        if( isset( $this->shared['session'] ) ){
            return $this->shared['session'];
        }
        $data = [
            'user_data' => [
                'Name' => 'Jesus Laucho',
                'role'  => 'teacher'
            ]
        ];
        $driver = new SessionArrayDriver($data);

        return $this->shared['session'] = new SessionManager($driver);
    }

    public function auth()
    {
        if( isset( $this->shared['auth'] ) ){
            return $this->shared['auth'];
        }

        return $this->shared['auth'] = new Autenticatior($this->session());
    }
    public function access()
    {
        if( isset( $this->shared['access'] ) ){
            return $this->shared['access'];
        }

        return $this->shared['access'] = new AccessHandler($this->auth());


    }
}