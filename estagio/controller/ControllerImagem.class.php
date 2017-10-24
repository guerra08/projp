<?php

class ControllerImagem extends ControllerBase{
    private $visao;
    private $dao;
    private $imagem;
    
     public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        
        //Cria uma instância da classe imagem e DAO
        $this->imagem = new Imagem();
        $this->dao = new ImagemDAO();
    }
    
    public function controleAcao($acao, $param=null){
        
        switch ($acao) {
            //Permite adição de ações que não estão no ControleBase
            default:
                //Senão, utiliza os que estão no ControleBase
                return parent::controleAcao($acao,$param);
                break;
            case "confirmarImagem":
                return $this->confirmarImagem($param);
                break;
			case "countSolicitacoes":
                return $this->countSolicitacoes($param);
                break;
        }
    }
      private function preencheModelo(){
          
          
        // Passa dados do formulário para a classe imagem
        $this->imagem->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
        $this->imagem->setDescricao((isset($this->visao["descricao"]) && $this->visao["descricao"] != null) ? $this->visao["descricao"] : "");
        $this->imagem->setData_insercao((isset($this->visao["data_insercao"]) && $this->visao["data_insercao"] != null) ? $this->visao["data_insercao"] : "");
        $this->imagem->setAutoria((isset($this->visao["autoria"]) && $this->visao["autoria"] != null) ? $this->visao["autoria"] : "");
        $this->imagem->setData_imagem((isset($this->visao["data_imagem"]) && $this->visao["data_imagem"] != null) ? $this->visao["data_imagem"] : "");
        $this->imagem->setCategoria((isset($this->visao["categoria"]) && $this->visao["categoria"] != null) ? $this->visao["categoria"] : "");
        $this->imagem->setImagem((isset($this->visao["imagem"]) && $this->visao["imagem"] != null) ? $this->visao["imagem"] : "");
        $this->imagem->setid_imagem((isset($this->visao["id_imagem"]) && $this->visao["id_imagem"] != null) ? $this->visao["id_imagem"] : "");
		$this->imagem->setStatus((isset($this->visao["status"]) && $this->visao["status"] != null) ? $this->visao["status"] : "");
        
        
      }
    
    
    protected function inserir() {
       
        // Passa dados do formulário para a classe imagem
        $this->preencheModelo();
        
        //Chama o método para inserir os dados no banco de dados
        return $this->dao->inserir($this->imagem);
    }
    
    protected function alterar() {
        // Passa dados do formulário para a classe imagem
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->dao->alterar($this->imagem);
    }

    protected function excluir(){
        // Passa dados do formulário (via GET) para a classe imagem
        $this->imagem->setId((isset($this->visao["id_imagem"]) && $this->visao["id_imagem"] != null) ? $this->visao["id_imagem"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->dao->excluir($this->imagem);
    }
    
    protected function listarTodos($param){
        
        //Chama o método para listar os imagem do banco de dados de acordo com um filtro
        return $this->dao->listarTodos($param);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um imagem específico do banco de dados
        return $this->dao->listarUnico($param);
    }

    protected function confirmarImagem($id){
        
        
        //Chama o método para listar um imagem específico do banco de dados
        return $this->dao->confirmarImagem($id);
    }
	
	protected function countSolicitacoes($param){
        
        return $this->dao->countSolicitacoes($param);
    }
}


