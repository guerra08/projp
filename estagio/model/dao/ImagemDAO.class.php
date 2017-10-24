<?php
    
    class ImagemDAO {
        private $conn;
        private $stmt;
        private $vo;

    public function __construct() {
            $this->conn = Database::conectar();
        }
        
        public function __destruct() {
            Database::desconectar();
        }
        
        public function Inserir($obj){
            
            try {

                echo 'Entered function';
				
				var_dump($obj);
              
                //comando sql de INSERT
                $query="INSERT INTO imagem (nome,descricao,autoria,data_imagem,categoria,imagem,status) VALUES(:nome,:descricao,:autoria,:data_imagem,:categoria,:imagem,:status) ";
                
                $this->stmt= $this->conn->prepare($query);
                    $this->stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
                    $this->stmt->bindValue(':descricao', $obj->getDescricao(), PDO::PARAM_STR);
                    $this->stmt->bindValue(':autoria', $obj->getAutoria(), PDO::PARAM_STR);
                    $this->stmt->bindValue(':data_imagem', $obj->getData_imagem(), PDO::PARAM_STR);
                    $this->stmt->bindValue(':categoria', $obj->getCategoria(), PDO::PARAM_INT);
                    $this->stmt->bindValue(':imagem', 'placeholder', PDO::PARAM_STR);
                    $this->stmt->bindValue(':status', $obj->getStatus(), PDO::PARAM_STR);
                   
                if(($this->stmt->execute()) ){
                    $obj->setId_imagem($this->conn->lastInsertId());
                    $arquivo = $obj->getImagem();
                    $ext = strrchr($arquivo['name'], '.');
                    move_uploaded_file($arquivo['tmp_name'], '../fotos/'.$obj->getId_Imagem().$ext);
                    $obj->setImagem('../fotos/'.$obj->getid_imagem().$ext);
                    if($this->Modificar($obj)){
                        return true;
                    }
                
                }
            } catch (PDOException $e) {
                //arquivo onde serão salvo os erros
                //$loggger = new Logger ($e->getMessage());
                //return false;
                //header('location:/view/painel_adm.php');
                echo $e;
            }
        }
        
        public function Modificar($obj){
          
            try {
             //comando sql de UPDATE
                $query= "UPDATE Imagem SET imagem = :imagem WHERE id_imagem=:id_imagem";
                  $this->stmt= $this->conn->prepare($query);
                        $this->stmt->bindValue(':imagem',$obj->getImagem() ,PDO::PARAM_STR);
                        $this->stmt->bindValue(':id_imagem', $obj->getId_imagem(), PDO::PARAM_INT);
                        if($this->stmt->execute()){
                            return true;
                          
                           } 
            } catch (PDOException $e) {
                 $logger = new Logger($e->getMessage());
            return false;
              
            }
        }

        public function Alterar($obj){
          
            try {
                //comando sql de UPDATE
                $query= "UPDATE Imagem SET nome = :nome, descricao = :descricao, autoria = :autoria, data_imagem = :data_imagem, categoria=:categoria WHERE id_imagem=:id_imagem";
                $this->stmt= $this->conn->prepare($query);
                $this->stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
                $this->stmt->bindValue(':descricao', $obj->getDescricao(), PDO::PARAM_STR);
                $this->stmt->bindValue(':autoria', $obj->getAutoria(), PDO::PARAM_STR);
                $this->stmt->bindValue(':data_imagem', $obj->getData_imagem(), PDO::PARAM_STR);
                $this->stmt->bindValue(':categoria', $obj->getCategoria(), PDO::PARAM_STR);
                $this->stmt->bindValue(':id_imagem', $obj->getId_imagem(), PDO::PARAM_INT);
                if($this->stmt->execute()){
                    return true;
                } 
            } catch (PDOException $e) {
                 print_r($e);
            return false;
              
            }
            
        }
           public function Excluir($obj){
        try{
            //Comando SQL para deletar
            $query="DELETE FROM Imagem WHERE id_imagem=:id_imagem ";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id_imagem', $obj->getId_imagem(), PDO::PARAM_INT);
            if($this->stmt->execute()){
               return true;
            }        
        } catch(PDOException $e) {
            $logger = new Logger($e->getMessage());
            return false;
        }
    }
       public function ListarTodos($param){
            try {

                $imagens= array();
                //contagem de registros da tabela
                       if(!is_null($param) && $param == 'unconfirmed'){
                            $query = "SELECT * FROM Imagem WHERE status = 0";
                        } 
						elseif($param->pesquisa) {
                            $query = "SELECT * FROM Imagem WHERE status = 1 AND categoria = :categoria" ;
							$this->stmt= $this->conn->prepare($query);
							$this->stmt->bindValue(':categoria', $param->pesquisa, PDO::PARAM_INT);
							if($this->stmt->execute()){
							   // Associa o registro a um array associativo
							$imagens = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

							}
							return $imagens;    
							print_r($imagens);
						}                        
						else {
                            $query = "SELECT * FROM Imagem" ;
                        }
						
					
                         $this->stmt= $this->conn->prepare($query);

                        if($this->stmt->execute()){
                            // Associa cada registro a um array associativo
                            $imagens = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                        }

                        $retorno = new stdClass(); //Classe padrão do PHP
                        $retorno->imagens = $imagens;
						return($retorno);
                       
			}catch (Exception $e) {
                $logger = new Logger($e->getMessage());
                return null;
				}
            }
			public function listarUnico($id_imagem){

					try{
						$query="SELECT id_imagem,nome,descricao,data_insercao,autoria,data_imagem,categoria,imagem FROM Imagem WHERE id_imagem=:id_imagem";
						$this->stmt= $this->conn->prepare($query);
						$this->stmt->bindValue(':id_imagem', $id_imagem, PDO::PARAM_INT);

						if($this->stmt->execute()){
							// Associa o registro a um array associativo
							$imagem = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

						}

                                                return $imagem[0];            
						} catch(PDOException $e) {
							$logger = new Logger($e->getMessage());
							return null;
						}

					 }
            public function confirmarImagem($id){
                try{
                    $query="UPDATE imagem SET status = 1 WHERE id_imagem=:id_imagem";
                        $this->stmt= $this->conn->prepare($query);
                        $this->stmt->bindValue(':id_imagem', $id, PDO::PARAM_INT);

                        if($this->stmt->execute()){
                            return true; 

                        }

                    echo "entrou na função";

                }catch (PDOException $e){
                    echo $e;
                }

            }         
                               
        
    }
