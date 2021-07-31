<?php

namespace SELLERCONTROL;

class Usuarios
{

    public function __construct()
    {
    }

    public static function crearUsuario()
    {
       add_role( 'asociado', 'Asociado', array() );
    }
}
