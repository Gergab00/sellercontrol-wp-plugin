<?php

namespace SELLERCONTROL;

class add_async_defer_attributes
{

    public function __construct()
    {
    }

    /**
     * Esta función agrega los parámetros "async" y "defer" a recursos de Javascript.
     * Solo se debe agregar "async" o "defer" en cualquier parte del nombre del 
     * recurso (atributo "handle" de la función wp_register_script).
     *
     * @param $tag
     * @param $handle
     *
     * @return mixed
     */
    static function add_async_defer_attributes($tag, $handle)
    {

        // Busco el valor "async"
        if (strpos($handle, "async")) :
            $tag = str_replace(' src', ' async src', $tag);
        endif;

        // Busco el valor "defer"
        if (strpos($handle, "defer")) :
            $tag = str_replace(' src', ' defer src', $tag);
        endif;

        return $tag;
    }
}
