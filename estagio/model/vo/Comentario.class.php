<?php

class Comentario{
    private $id_comentario;
    private $id_imagem;
    private $comentario;
    private $autor;
    private $data;
    private $status;

    function getId_comentario() {
        return $this->id_comentario;
    }

    function setId_comentario($id_comentario) {
        $this->id_comentario = $id_comentario;
    }

        function getId_imagem() {
        return $this->id_imagem;
    }
	
    function setId_imagem($id_imagem) {
        $this->id_imagem = $id_imagem;
    }

    function getComentario() {
        return $this->comentario;
    }

    function setComentario($comentario) {
		$this->comentario = $comentario;
    }

	function getAutor() {
        return $this->autor;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }
	
	function getData() {
        return $this->data;
    }

    function getStatus() {
        return $this->status;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
