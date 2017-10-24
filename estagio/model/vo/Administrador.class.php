<?php

class Administrador extends Usuario{
    private $id_adm;
    private $area;
    function getId_adm() {
        return $this->id_adm;
    }

    function getArea() {
        return $this->area;
    }

    function setId_adm($id_adm) {
        $this->id_adm = $id_adm;
    }

    function setArea($area) {
        $this->area = $area;
    }


}