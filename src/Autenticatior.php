<?php
/**
 * Created by PhpStorm.
 * User: jesus
 * Date: 13/11/18
 * Time: 07:51 AM
 */

namespace jlaucho\practica;

use jlaucho\practica\SessionManager as Session;


class Autenticatior implements AuthenticatioInterface
{
    protected $user;
    protected $session;

    public function __construct( Session $session)
    {
        $this->session = $session;
    }


    public function check ()
    {

       return $this->user() != null;

    }

    public function user ()
    {


        if ( $this->user != null ) {
            return $this->user;
        }
        $data = $this->session->get('user_data');

        if( ! is_null($data)){
            return $this->user = new User($data);
        }

        return null;
    }
}