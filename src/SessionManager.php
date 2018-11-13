<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 07:57 AM
 */

namespace jlaucho\practica;



class SessionManager
{
    /**
     * @var SessionFileDriver
     */
    private $fileDriver;

    protected $data = array();

    public function __construct(SessionDriversInterface $fileDriver)
    {

        $this->fileDriver = $fileDriver;
        $this->load();
    }

    public function load()
    {


        $this->data = $this->fileDriver->load();

    }
    public function get( $key )
    {
        return $this->data[$key] ?? null;
    }
}