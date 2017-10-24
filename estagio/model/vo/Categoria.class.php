<?php

class Categoria{
    private $id_categoria;
    private $nome;
    private $descricao;
    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

        function getId_categoria() {
        return $this->id_categoria;
    }

    function getNome() {
        return $this->nome;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }


}
