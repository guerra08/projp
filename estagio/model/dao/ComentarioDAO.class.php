<?php
    
    class ComentarioDAO{
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
                $query="INSERT INTO comentario (id_imagem, comentario, autor, status) VALUES(:id_imagem, :comentario, :autor, :status) ";
                     $this->stmt= $this->conn->prepare($query);
                     $this->stmt->bindValue(':id_imagem', $obj->getId_imagem(), PDO::PARAM_INT);
                      $this->stmt->bindValue(':comentario', $obj->getComentario(), PDO::PARAM_STR);
                      $this->stmt->bindValue(':autor', $obj->getAutor(), PDO::PARAM_INT);
                      $this->stmt->bindValue(':status', $obj->getStatus(), PDO::PARAM_INT);
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
                    $query="UPDATE comentario SET (id_imagem = :id_imagem, comentario = :comentario, autor = :autor, status = :status) WHERE id_comentario=:id_comentario";
                     $this->stmt= $this->conn->prepare($query);
                     $this->stmt->bindValue(':id_imagem', $obj->getId_imagem(), PDO::PARAM_INT);
                      $this->stmt->bindValue(':comentario', $obj->getComentario(), PDO::PARAM_STR);
                      $this->stmt->bindValue(':autor', $obj->getAutor(), PDO::PARAM_INT);
                      $this->stmt->bindValue(':status', $obj->getStatus(), PDO::PARAM_INT);
                        $this->stmt->bindValue(':id_comentario', $obj->getId_comentario(), PDO::PARAM_INT);
                        print_r($this->stmt);
                         if($this->stmt->execute()){
                            return true;                           
                        } 
                    
                } catch (PDOException $e) {
                           $logger = new Logger($e->getMessage());
                             return false;
                    
                }
            }

            public function confirmar($obj){

                try {
                    //comando de UPDATE
                    $query="UPDATE comentario SET status = :status WHERE id_comentario=:id_comentario";
                     $this->stmt= $this->conn->prepare($query);
                      $this->stmt->bindValue(':status', $obj->getStatus(), PDO::PARAM_INT);
                        $this->stmt->bindValue(':id_comentario', $obj->getId_comentario(), PDO::PARAM_INT);
                         if($this->stmt->execute()){
                            return true;                           
                        } 
                    
                } catch (PDOException $e) {
                           $logger = new Logger($e->getMessage());
                             return false;
                    
                }

            }

            public function Excluir($obj){
                    try{
                        //Comando SQL para deletar
                        $query="DELETE FROM comentario WHERE id_comentario=:id_comentario ";
                        $this->stmt= $this->conn->prepare($query);
                        $this->stmt->bindValue(':id_comentario', $obj->getId_comentario(), PDO::PARAM_INT);
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
                $comentarios= array();
                //contagem de registros da tabela
                 
                       if(!is_null($params) && !is_null($params->id_imagem)){ 

                            $query="SELECT * FROM comentario WHERE id_imagem = :id_imagem" ;
                        } else {
                            $query="SELECT * FROM comentario" ;
                            
                        }
                         $this->stmt= $this->conn->prepare($query);
                        if(!is_null($params) && !is_null($params->id_imagem)) 
                            $this->stmt->bindValue(':id_imagem', $params->id_imagem, PDO::PARAM_STR);
                   
                        if($this->stmt->execute()){
                            // Associa cada registro a um array associativo
                            $comentarios = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                        }

                        $retorno = new stdClass(); //Classe padrão do PHP
                        $retorno->comentarios = $comentarios;
                      return($retorno);
                       
                        } catch (Exception $e) {
                                $logger = new Logger($e->getMessage());
                                    return null;
                        }
             }     
             public function listarUnico(){
                 
             }
    }

