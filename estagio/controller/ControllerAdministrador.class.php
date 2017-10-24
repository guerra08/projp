<?php

Class Controlleradministrador extends ControllerBase{
   

    private $visao;
    private $administrador;
    private $administradorDAO;
    public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        
        //Cria uma instância da classe usuario e DAO
        
        $this->administrador = new Administrador();
        $this->administradorDAO = new AdministradorDAO();
        
    }
    
    public function controleAcao($acao,$param=null){
        
        switch ($acao) {
            //Permite adição de ações que não estão no ControleBase
            default:
                //Senão, utiliza os que estão no ControleBase
                return parent::controleAcao($acao,$param);
                break;
			case "listarUnicoPorUser";
				return $this->listarUnicoPorUser($param);
                break;
        }
    }
    private function preencheModelo(){
        // Passa dados do formulário para a classe Cliente
        $this->administrador->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
        $this->administrador->setCpf((isset($this->visao["cpf"]) && $this->visao["cpf"] != null) ? $this->visao["cpf"] : "");
        $this->administrador->setEmail((isset($this->visao["email"]) && $this->visao["email"] != null) ? $this->visao["email"] : "");
        $this->administrador->setArea((isset($this->visao["area"]) && $this->visao["area"] != null) ? $this->visao["area"] : "");
        $this->administrador->setSenha((isset($this->visao["senha"]) && $this->visao["senha"] != null) ? $this->visao["senha"] : "");
        $this->administrador->setTipo((isset($this->visao["tipo"]) && $this->visao["tipo"] != null) ? $this->visao["tipo"] : "");
        $this->administrador->setId_usuario((isset($this->visao["id_usuario"]) && $this->visao["id_usuario"] != null) ? $this->visao["id_usuario"] : "");
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe usuario
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados

        return $this->administradorDAO->inseriradm($this->administrador);
    }

    protected function alterar() {
        
    }

    protected function excluir() {
        
    }

    protected function listarTodos($param = null) {
        
        return $this->administradorDAO->ListarTodos($param);
        
    }

    protected function listarUnico($param) {
        
    }
	
	protected function listarUnicoPorUser($param) {
        return $this->administradorDAO->listarUnicoPorUser($param);
    }
	
	protected function logar(){
		
	}

}