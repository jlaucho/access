<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 08:05 AM
 */

namespace jlaucho\practica;


class SessionFileDriver
{
    /**
     * @return array
     */
    public function load()
    {
        $file = __DIR__ . '/../storage/session/session.json';

        if(file_exists($file)){
            return json_decode(file_get_contents($file), true);
        }

        return [];
    }
}