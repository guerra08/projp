<?php
    
    class CategoriaDAO{
        private $conn;
        private $stmt;
       // public $limite;
        public function __construct() {
            $this->conn = Database::conectar();
        }
        
        public function __destruct() {
            Database::desconectar();
        }
        
        public function Inserir($obj){
            try {
                 //comando sql de INSERT
                $query="INSERT INTO Categoria (nome, descricao) VALUES(:nome, :descricao) ";
                     $this->stmt= $this->conn->prepare($query);
                     $this->stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
                      $this->stmt->bindValue(':descricao', $obj->getDescricao(), PDO::PARAM_STR);
                     if($this->stmt->execute()){
                         return true;
                         }
            } catch (PDOException $e) {
                   //arquivo onde serão salvo os erros
                $loggger = new Logger ($e->getMessage());
                return false;
            }
            }
            public function Alterar($obj){
                try {
                    //comando de UPDATE
                    $query="UPDATE Categoria SET (:nome, :descricao) WHERE id_categoria=:id_categoria";
                     $this->stmt= $this->conn->prepare($query);
                        $this->stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
                          $this->stmt->bindValue(':descricao', $obj->getDescricao(), PDO::PARAM_STR);
                         $this->stmt->bindValue(':id_categoria', $obj->getId_categoria(), PDO::PARAM_INT);
                         if($this->stmt->execute()){
                            return header('location:/view/painel_adm.php');
                           } 
                    
                } catch (PDOException $e) {
                           $logger = new Logger($e->getMessage());
                             return false;
                    
                }
            }
            public function Excluir($obj){
                    try{
                        //Comando SQL para deletar
                        $query="DELETE FROM Categoria WHERE id_categoria=:id_categoria ";
                        $this->stmt= $this->conn->prepare($query);
                        $this->stmt->bindValue(':id_categoria', $obj->getId_categoria(), PDO::PARAM_INT);
                        if($this->stmt->execute()){
                           return true;
                        }        
                    } catch(PDOException $e) {
                        $logger = new Logger($e->getMessage());
                        return false;
                    }
            }
             public function ListarTodos($params=null){
            try {
                $categorias= array();
                //contagem de registros da tabela
                 
              if(!is_null($params) && !is_null($params->pesquisa)){ 

                    //metodo pelo qual vai ser pesquisado tal coisa 
                    $sqlContador="SELECT COUNT(*) AS total_registros FROM Categoria WHERE nome LIKE :nome " ; 
                }else{
                    //pesquisa geral da tabela 
                    $sqlContador= "SELECT COUNT(*) AS total_registros FROM Categoria " ;
                }
                  $this->stmt= $this->conn->prepare($sqlContador);
                  if(!is_null($params) && !is_null($params->pesquisa)){
                   $this->stmt->bindValue(':nome', '%'.$params->pesquisa.'%', PDO::PARAM_STR);
                    }
                    $this->stmt->execute();   
                    $total = $this->stmt->fetch(PDO::FETCH_OBJ);   
                       if(!is_null($params) && !is_null($params->pesquisa)){ 

                            $query="SELECT id_categoria,nome,descricao  FROM Categoria WHERE nome LIKE :nome LIMIT :linha_inicial, :qtd_registros_pagina" ;
                        } else {
                            $query="SELECT id_categoria,nome,descricao FROM categoria" ;
                            
                        }
                         $this->stmt= $this->conn->prepare($query);
                         if(!is_null($params) && !is_null($params->pesquisa)) 
                          $this->stmt->bindValue(':nome', '%'.$params->pesquisa.'%', PDO::PARAM_STR);
                        if(!is_null($params)&& !is_null($params->linha_inicial))$this->stmt->bindValue(':linha_inicial', $params->linha_inicial, PDO::PARAM_INT);
                        if(!is_null($params)&& !is_null($params->qtd_registros_pagina))$this->stmt->bindValue(':qtd_registros_pagina', $params->qtd_registros_pagina, PDO::PARAM_INT);

                        if($this->stmt->execute()){
                            // Associa cada registro a um array associativo
                            $categorias = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                        }

                        $retorno = new stdClass(); //Classe padrão do PHP
                        $retorno->total = $total->total_registros;
                        $retorno->categorias = $categorias;
                      return($retorno);
                       
                        } catch (Exception $e) {
                                $logger = new Logger($e->getMessage());
                                    return null;
                        }
             }
                         public function listarUnico($id_categoria){

                                try{
                                    $query="SELECT c.*, i.imagem FROM categoria c LEFT JOIN imagem i ON(i.categoria=c.id_categoria)";
                                    $this->stmt= $this->conn->prepare($query);
                                    $this->stmt->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);

                                    if($this->stmt->execute()){
                                        // Associa o registro a um array associativo
                                        $categoria = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                                    }

                                        return $categoria[0];            
                                    } catch(PDOException $e) {
                                        $logger = new Logger($e->getMessage());
                                        return null;
                         }}
                         public function Uniao(){
                             try{
                                    $query="SELECT imagem FROM Imagem WHERE id_categoria=:id_categoria";
                                    $this->stmt= $this->conn->prepare($query);
                                    $this->stmt->bindValue(':imagem', $iamgem, PDO::PARAM_INT);

                                    if($this->stmt->execute()){
                                        // Associa o registro a um array associativo
                                        $imagemcategoria = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                                    }

                                        return $imagemcategoria[0];            
                                    } catch(PDOException $e) {
                                        $logger = new Logger($e->getMessage());
                                        return null;
                         }
                                 
    }
       
                    
        
        
    }

