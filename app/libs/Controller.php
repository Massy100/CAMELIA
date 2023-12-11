<?php

class Controller
{
    public function mode($modelo)
    {
        require_once '../app/models/' . $modelo . '.php';

        return new $modelo;

    }

    public function view($view, $datos = [])
    {
        if (file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            echo 'la vista no existe';
        }
    }
}