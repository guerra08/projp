<?php


abstract class ControllerBase {

    
    public function controleAcao($acao,$param=null) {
        switch ($acao) {
            case "inserir":
                return $this->inserir();
                break;
            case "alterar":
                return $this->alterar();
                break;
            case "excluir":
                return $this->excluir();
                break;            
             case "listarTodos":
                return $this->listarTodos($param);
                break; 
            case "listarUnico":  
                return $this->listarUnico($param);
                break; 
            default:
                return "Ação indefinida";
        }
    }

    abstract protected function inserir();

    abstract protected function alterar();

    abstract protected function excluir();

    abstract protected function listarTodos($param);
    
    abstract protected function listarUnico($param);
	
    }

?>