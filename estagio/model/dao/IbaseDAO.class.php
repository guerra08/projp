<?php

interface IBaseDAO {
    public function inserir($obj);
    public function alterar($obj);
    public function excluir($obj);
    public function listarTodos($param=null);
    public function listarUnico($param);
}
