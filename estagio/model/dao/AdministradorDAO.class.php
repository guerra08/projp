<?php
    
    class AdministradorDAO extends UsuarioDAO {
        private $conn;
        private $stmt;
        

    public function __construct() {
            $this->conn = Database::conectar();
        }
        
        public function __destruct() {
            Database::desconectar();
        }
         public  function criptografar ($senha){
        
        $custo = '03';
        $salt = 'Cf1f11gPArmpbJomM0F6aJ';

        // Gera um hash baseado em bcrypt
        $hash = crypt($senha, $salt);
        
        return $hash;
    }

public function Inseriradm($obj){
            try {
                
                $usuarioDAO = new UsuarioDAO;
                
                $usuarioDAO->inserir($obj);
                
                //comando sql de INSERT
                $query="INSERT INTO Administrador (id_usuario, area) VALUES (:id_usuario,:area)";
            
                $this->stmt= $this->conn->prepare($query);
                $this->stmt->bindValue(':id_usuario', $this->conn->lastInsertId(), PDO::PARAM_INT);
                $this->stmt->bindValue(':area', $obj->getArea(), PDO::PARAM_STR);
                if($this->stmt->execute()){
                   return true;
                }
            } catch (PDOException $e) {
                //arquivo onde serão salvo os erros
                $loggger = new Logger ($e->getMessage());
                return false;
            }
        }
        
             public function ListarTodos($params=null){
                try {
                    $administradores= array();
                    //contagem de registros da tabela

                    if(!is_null($params) && !is_null($params->pesquisa)){ 

                        //metodo pelo qual vai ser pesquisado tal coisa 
                        $sqlContador="SELECT COUNT(*) AS total_registros FROM administrador WHERE nome LIKE :area " ; 
                    }else{
                        //pesquisa geral da tabela 
                        $sqlContador= "SELECT COUNT(*) AS total_registros FROM administrador " ;
                    }

                    $this->stmt= $this->conn->prepare($sqlContador);
                    if(!is_null($params) && !is_null($params->pesquisa)){
                      $this->stmt->bindValue(':area', '%'.$params->pesquisa.'%', PDO::PARAM_STR);
                    }
                    $this->stmt->execute();   
                    $total = $this->stmt->fetch(PDO::FETCH_OBJ);  

                    if(!is_null($params) && !is_null($params->pesquisa)){ 

                        $query="SELECT * FROM administrador WHERE area LIKE :area" ;

                    } else {
                         //$query="SELECT id_administrador, area FROM administrador WHERE id_administrador IN (SELECT id_usuario, nome, cpf, e-mail FROM usuario)" ;
                        $query="
SELECT u.id_usuario, u.nome, u.email, u.tipo, u.cpf, a.id_adm, a.area FROM usuario u, administrador a WHERE u.id_usuario = a.id_usuario";
                    }
                    
                    $this->stmt= $this->conn->prepare($query);
                    if(!is_null($params) && !is_null($params->pesquisa)) {
                        $this->stmt->bindValue(':area', '%'.$params->pesquisa.'%', PDO::PARAM_STR);
                    }
                    
                    if($this->stmt->execute()){
                        // Associa cada registro a um array associativo
                        $administradores = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                    }

                    $retorno = new stdClass(); //Classe padrão do PHP
                    $retorno->total = $total->total_registros;
                    $retorno->administradores = $administradores;
                    return($retorno);

                } catch (Exception $e) {
                    $logger = new Logger($e->getMessage());
                    return null;
                }
             }
             public function listarUnico($id_administrador){

                                try{
                                    $query="SELECT id_administrador,nome FROM administrador WHERE id_administrador=:id_administrador";
                                    $this->stmt= $this->conn->prepare($query);
                                    $this->stmt->bindValue(':id_administrador', $id_administrador, PDO::PARAM_INT);

                                    if($this->stmt->execute()){
                                        // Associa o registro a um array associativo
                                        $administrador = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                                    }

                                        return $administrador[0];            
                                    } catch(PDOException $e) {
                                        $logger = new Logger($e->getMessage());
                                        return null;
                         }}
						 
		             public function listarUnicoPorUser($param){

                                try{
                                    $query="SELECT id_adm,area FROM administrador WHERE id_usuario=:id";
                                    $this->stmt= $this->conn->prepare($query);
                                    $this->stmt->bindValue(':id', $param, PDO::PARAM_INT);

                                    if($this->stmt->execute()){
                                        // Associa o registro a um array associativo
                                        $administrador = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

                                    }

                                        return $administrador[0];            
                                    } catch(PDOException $e) {
                                        $logger = new Logger($e->getMessage());
                                        return null;
                         }}				 

       
                                 
    }
    
       