<?php

class ControllerCategoria extends ControllerBase{
    private $visao;
    private $dao;
    private $categoria;
    
                public function getVisao() {
                    return $this->visao;
           }


                public function setVisao($visao) {
                    $this->visao = $visao;
           }


                public function __construct() {

                    //Cria uma instância da classe categoria e DAO
                    $this->categoria = new Categoria();
                    $this->dao = new CategoriaDAO();
           }
    
                public function controleAcao($acao,$param=null){

                    switch ($acao) {
                        //Permite adição de ações que não estão no ControleBase
                        default:
                            //Senão, utiliza os que estão no ControleBase
                            return parent::controleAcao($acao,$param);
                            break;
                    }
                }
                private function preencheModelo(){
                      // Passa dados do formulário para a classe categoria
                      $this->categoria->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
                       $this->categoria->setDescricao((isset($this->visao["descricao"]) && $this->visao["descricao"] != null) ? $this->visao["descricao"] : "");
                      $this->categoria->setId_categoria((isset($this->visao["id_categoria"]) && $this->visao["id_categoria"] != null) ? $this->visao["id_categoria"] : "");
            }
                protected function inserir() {
                    // Passa dados do formulário para a classe categoria
                    $this->preencheModelo();
                    //Chama o método para inserir os dados no banco de dados
                    return $this->dao->inserir($this->categoria);
                }

                protected function alterar() {
                    // Passa dados do formulário para a classe categoria
                    $this->preencheModelo();
                    //Chama o método para alterar os dados no banco de dados
                    return $this->dao->alterar($this->categoria);
                }

                protected function excluir(){
                    // Passa dados do formulário (via GET) para a classe categoria
                    $this->categoria->setId((isset($this->visao["id_categoria"]) && $this->visao["id_categoria"] != null) ? $this->visao["id_categoria"] : "");
                    //Chama o método para excluir os dados no banco de dados
                    return $this->dao->excluir($this->categoria);
                }

                protected function listarTodos($param=null){

                    //Chama o método para listar os categoria do banco de dados de acordo com um filtro
                    return $this->dao->listarTodos($param);
                }

                protected function listarUnico($param){


                    //Chama o método para listar um categoria específico do banco de dados
                    return $this->dao->listarUnico($param);
                }
                
                protected function Lista (){
                    return $this->dao->lista();
                }
                
 }

