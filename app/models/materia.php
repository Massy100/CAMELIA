<?php

class materia{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }
    public function register($datosMateria){
        $this->db->query('INSERT INTO materia (nombre, horas) VALUES (:nombre, :horas)');
        $this->db->bind(':nombre', $datosMateria['materia']);
        $this->db->bind(':horas', $datosMateria['horas']);

        if ($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}