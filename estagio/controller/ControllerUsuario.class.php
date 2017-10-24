<?php
class Controllerusuario extends Controllerbase{
    private $visao;
    private $dao;
    private $usuario;
     
      public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        
        //Cria uma instância da classe usuario e DAO
        $this->usuario = new Usuario();
        $this->dao = new UsuarioDAO();
    }
    
    public function controleAcao($acao,$param=null){
        
        switch ($acao) {
            //Permite adição de ações que não estão no ControleBase
            default:
                //Senão, utiliza os que estão no ControleBase
                return parent::controleAcao($acao,$param);
            case "logar":
                return $this->logar();
                break;
			case "listarSolicitacoes":
                return $this->listarSolicitacoes();
                break;
            case "confirmarCadastro":
                return $this->confirmarCadastro();
                break;
			case "countSolicitacoes":
                return $this->countSolicitacoes();
                break;
        }
    }
      private function preencheModelo(){
        // Passa dados do formulário para a classe Cliente
        $this->usuario->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
        $this->usuario->setCpf((isset($this->visao["cpf"]) && $this->visao["cpf"] != null) ? $this->visao["cpf"] : "");
        $this->usuario->setEmail((isset($this->visao["email"]) && $this->visao["email"] != null) ? $this->visao["email"] : "");
        $this->usuario->setTipo((isset($this->visao["tipo"]) && $this->visao["tipo"] != null) ? $this->visao["tipo"] : "");
        $this->usuario->setSenha((isset($this->visao["senha"]) && $this->visao["senha"] != null) ? $this->visao["senha"] : "");
        $this->usuario->setId_usuario((isset($this->visao["id_usuario"]) && $this->visao["id_usuario"] != null) ? $this->visao["id_usuario"] : "");
		$this->usuario->setStatus((isset($this->visao["status"]) && $this->visao["status"] != null) ? $this->visao["status"] : "");
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe usuario
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->dao->inserir($this->usuario);
    }
    
    protected function alterar() {
        // Passa dados do formulário para a classe usuario
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->dao->alterar($this->usuario);
    }

    protected function excluir(){
        // Passa dados do formulário (via GET) para a classe usuario
        $this->usuario->setId_usuario((isset($this->visao["id_usuario"]) && $this->visao["id_usuario"] != null) ? $this->visao["id_usuario"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->dao->excluir($this->usuario);
    }
    
    protected function listarTodos($param=null){
        
        //Chama o método para listar os usuario do banco de dados de acordo com um filtro
        return $this->dao->listarTodos($param);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um usuario específico do banco de dados
        return $this->dao->listarUnico($param);
    }
	
	protected function logar(){
		
		$this->usuario->setEmail((isset($this->visao["email"]) && $this->visao["email"] != null) ? $this->visao["email"] : "");
		$this->usuario->setSenha((isset($this->visao["senha"]) && $this->visao["senha"] != null) ? $this->visao["senha"] : "");
      
        return $this->dao->logar($this->usuario);
    }
	
	protected function listarSolicitacoes(){
      
        return $this->dao->listarSolicitacoes();
    }

    protected function confirmarCadastro(){

        $this->usuario->setId_usuario((isset($this->visao["id_usuario"]) && $this->visao["id_usuario"] != null) ? $this->visao["id_usuario"] : "");

        return $this->dao->confirmarCadastro($this->usuario);
    }
	
	 protected function countSolicitacoes(){
        
          return $this->dao->countSolicitacoes();
      }
}