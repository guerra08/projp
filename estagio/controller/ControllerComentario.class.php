<?php
class ControllerComentario extends Controllerbase{
    private $visao;
    private $dao;
    private $comentario;
     
      public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        
        //Cria uma instância da classe usuario e DAO
        $this->comentario = new Comentario();
        $this->dao = new ComentarioDAO();
    }
    
    public function controleAcao($acao,$param=null){
        
        switch ($acao) {
            //Permite adição de ações que não estão no ControleBase
            default:
                //Senão, utiliza os que estão no ControleBase
                return parent::controleAcao($acao,$param);
            case "confirmar":
                return $this->confirmar();
        }
    }
      private function preencheModelo(){
        // Passa dados do formulário para a classe Cliente
        $this->comentario->setId_comentario((isset($this->visao["id_comentario"]) && $this->visao["id_comentario"] != null) ? $this->visao["id_comentario"] : "");
        $this->comentario->setAutor((isset($this->visao["autor"]) && $this->visao["autor"] != null) ? $this->visao["autor"] : "");
        $this->comentario->setId_imagem((isset($this->visao["id_imagem"]) && $this->visao["id_imagem"] != null) ? $this->visao["id_imagem"] : "");
        $this->comentario->setComentario((isset($this->visao["comentario"]) && $this->visao["comentario"] != null) ? $this->visao["comentario"] : "");
        $this->comentario->setStatus((isset($this->visao["status"]) && $this->visao["status"] != null) ? $this->visao["status"] : "");
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe usuario
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->dao->inserir($this->comentario);
    }
    
    protected function alterar() {
        // Passa dados do formulário para a classe usuario
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->dao->alterar($this->comentario);
    }

    protected function excluir(){
        // Passa dados do formulário (via GET) para a classe usuario
        $this->comentario->setId((isset($this->visao["id_comentario"]) && $this->visao["id_comentario"] != null) ? $this->visao["id_comentario"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->dao->excluir($this->usuario);
    }

    protected function confirmar(){
        // Passa dados do formulário (via GET) para a classe usuario
        $this->comentario->setStatus((isset($this->visao["status"]) && $this->visao["status"] != null) ? $this->visao["status"] : "");
        $this->comentario->setId_comentario((isset($this->visao["id_comentario"]) && $this->visao["id_comentario"] != null) ? $this->visao["id_comentario"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->dao->confirmar($this->comentario);
    }
    
    protected function listarTodos($param=null){
        
        //Chama o método para listar os usuario do banco de dados de acordo com um filtro
        return $this->dao->listarTodos($param);
    }
    protected function listarUnico($param) {
        
    }
    
}