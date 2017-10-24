<?php

class Imagem {
    private $id_imagem;
    private $nome;
    private $descricao;
    private $data_insercao;
    private $autoria;
    private $data_imagem;
    private $categoria;
    private $imagem;
	private $status;
    
    function getImagem() {
        return $this->imagem;
    }
	
	function getStatus() {
        return $this->status;
    }
	
	function setStatus($status) {
        $this->status = $status;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

        function getid_imagem() {
        return $this->id_imagem;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getData_insercao() {
        return $this->data_insercao;
    }

    function getAutoria() {
        return $this->autoria;
    }

    function getData_imagem() {
        return $this->data_imagem;
    }

    function getCategoria() {
        return $this->categoria;
    }

  

    function setid_imagem($id_imagem) {
        $this->id_imagem = $id_imagem;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setData_insercao($data_insercao) {
        $this->data_insercao = $data_insercao;
    }

    function setAutoria($autoria) {
        $this->autoria = $autoria;
    }

    function setData_imagem($data_imagem) {
        $this->data_imagem = $data_imagem;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

 

}