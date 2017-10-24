<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class UsuarioDAO {
		 private $stmt;
				public function __construct() {
						$this->conn = Database::conectar();
				}
				
				public function __destruct() {
						Database::desconectar();
				}
	 	public  function criptografar ($senha){
				

				// Gera um hash baseado em bcrypt
				$hash = crypt($senha, '');
						return $hash;
		}
		
		public function Inserir($obj){
						try {
								$hash = $this->criptografar($obj->getSenha());
								//comando sql de INSERT
								$query="INSERT INTO Usuario (nome,email,tipo,cpf,senha,status) VALUES(:nome,:email,:tipo,:cpf,:senha,:status)";
									$this->stmt= $this->conn->prepare($query);
										 $this->stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
										 $this->stmt->bindValue(':email', $obj->getEmail(), PDO::PARAM_STR);
										 $this->stmt->bindValue(':tipo', $obj->getTipo(), PDO::PARAM_STR);
										 $this->stmt->bindValue(':cpf', $obj->getCpf(), PDO::PARAM_STR);
										 $this->stmt->bindValue(':senha', $hash, PDO::PARAM_STR);
					 					$this->stmt->bindValue(':status', 0, PDO::PARAM_INT);
										 
										 
												 if($this->stmt->execute()){
												 return true;
												 }
						} catch (PDOException $e) {
								//arquivo onde serão salvo os erros
								//$loggger = new Logger ($e->getMessage());
								//return false;
				echo $e;
						}
				}
				 public function Alterar($obj,$hash){
								try {
										//comando de UPDATE
										$query="UPDATE Usuario SET (:nome,:email,:cpf,:senha WHERE id_usuario=:id_usuario";
										 $this->stmt= $this->conn->prepare($query);
												$this->stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
												$this->stmt->bindValue(':email', $obj->getEmail(), PDO::PARAM_STR);
												$this->stmt->bindValue(':cpf', $obj->getCpf(), PDO::PARAM_STR);
												$this->stmt->bindValue(':senha', $obj->$hash(), PDO::PARAM_STR);
												$this->stmt->bindValue(':id_usuario', $obj->getId_usuario(), PDO::PARAM_INT);
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
												$query="DELETE FROM Usuario WHERE id_usuario=:id_usuario ";
												$this->stmt= $this->conn->prepare($query);
												$this->stmt->bindValue(':id_usuario', $obj->getId_usuario(), PDO::PARAM_INT);
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
								$usuarios= array();
								//contagem de registros da tabela
								 
							if(!is_null($params) && !is_null($params->pesquisa)){ 

										//metodo pelo qual vai ser pesquisado tal coisa 
										$sqlContador="SELECT COUNT(*) AS total_registros FROM usuarios WHERE nome LIKE :nome " ; 
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

														$query="SELECT id_usuario,nome FROM Categoria WHERE nome LIKE :nome LIMIT :linha_inicial, :qtd_registros_pagina" ;
												} else {
														$query="SELECT id_usuario,nome,email,cpf,status FROM Usuario" ;
														
												}
												 $this->stmt= $this->conn->prepare($query);
												 if(!is_null($params) && !is_null($params->pesquisa)) 
													$this->stmt->bindValue(':nome', '%'.$params->pesquisa.'%', PDO::PARAM_STR);
												 
												if(!is_null($params)&& !is_null($params->linha_inicial))$this->stmt->bindValue(':linha_inicial', $params->linha_inicial, PDO::PARAM_INT);
												if(!is_null($params)&& !is_null($params->qtd_registros_pagina))$this->stmt->bindValue(':qtd_registros_pagina', $params->qtd_registros_pagina, PDO::PARAM_INT);

												if($this->stmt->execute()){
														// Associa cada registro a um array associativo
														$usuarios = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

												}

												$retorno = new stdClass(); //Classe padrão do PHP
												$retorno->total = $total->total_registros;
												$retorno->usuarios = $usuarios;
											return($retorno);
											 
												} catch (Exception $e) {
																$logger = new Logger($e->getMessage());
																		return null;
												}
						 }
								 public function listarUnico($id_usuario){

																try{
																		$query="SELECT * FROM Usuario WHERE id_usuario=:id_usuario";
																		$this->stmt= $this->conn->prepare($query);
																		$this->stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);

																		if($this->stmt->execute()){
																				// Associa o registro a um array associativo
																				$categoria = $this->stmt->fetchAll(PDO::FETCH_ASSOC);  

																		}

																				return $categoria[0];            
																		} catch(PDOException $e) {
																				$logger = new Logger($e->getMessage());
																				return null;
																		}

																 }
		
		public function logar($param){

				$sql = "SELECT id_usuario FROM usuario WHERE email = :email and status = '1'";
				$this->stmt= $this->conn->prepare($sql);
				$this->stmt->bindValue(':email', $param->getEmail(), PDO::PARAM_STR);
				$this->stmt->execute();
				$idUsuario = $this->stmt->fetchColumn();

		if($idUsuario != false ){
			$sql = "SELECT senha FROM usuario WHERE id_usuario = ".$idUsuario."";
			$this->stmt= $this->conn->prepare($sql);
			if($this->stmt->execute()){
				$bdPw = $this->stmt->fetchColumn();
				$inputPw = filter_var($param->getSenha(), FILTER_SANITIZE_STRING);
				if(crypt($inputPw, $bdPw) == $bdPw){
					return $idUsuario;
				}
				else{
					return false;
				}
			}
		}
		else{
			return false;
		}
		}
	
	public function listarSolicitacoes($param = null){
				$sql = "SELECT id_usuario, nome, email, cpf FROM usuario WHERE status = 0";
				$this->stmt= $this->conn->prepare($sql);
		if($this->stmt->execute()){
			$usuarios = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
			return ($usuarios);
		}
		}
		
		public function countSolicitacoes($param = null)
		{
        $sql = "SELECT COUNT(id_usuario) FROM usuario WHERE status = 0";
        $this->stmt= $this->conn->prepare($sql);
        if ($this->stmt->execute()) {
            $usuarios = $this->stmt->fetch(PDO::FETCH_COLUMN);
            return ($usuarios);
        }
		}

		public function confirmarCadastro($param){
			
				$sql = "UPDATE usuario SET status = 1 WHERE id_usuario = :id_usuario";
				$this->stmt= $this->conn->prepare($sql);
				$this->stmt->bindValue(':id_usuario', $param->getId_usuario(), PDO::PARAM_INT);
				if($this->stmt->execute()){
					$sql = "SELECT nome,email FROM usuario WHERE id_usuario = :id_usuario";
					$this->stmt= $this->conn->prepare($sql);
					$this->stmt->bindValue(':id_usuario', $param->getId_usuario(), PDO::PARAM_INT);
					if($this->stmt->execute()){
						$dados = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
						try{
						$mail = new PHPMailer(true);
						$mail->SMTPDebug = 0;                                 // Enable verbose debug output
						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'repositoriobg@gmail.com';                 // SMTP username
						$mail->Password = 'repo2317';                           // SMTP password
						$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 587;                                    // TCP port to connect to
			
						$mail->smtpConnect(
							array(
								"ssl" => array(
									"verify_peer" => false,
									"verify_peer_name" => false,
									"allow_self_signed" => true
								)
							)
						);
						//Recipients
						$mail->setFrom('repositoriobg@gmail.com', 'Repositorio fotografico IFRS BG');
						$mail->addAddress($dados[0]['email']);     // Add a recipient
					
					
						//Content
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Sua solicitacao foi aceita';
						$mail->Body    = 'Olá <b>'.$dados[0]['nome'].'</b>, a sua solicitacao foi aceita! Voce ja pode acessar o site!';
						$mail->AltBody = 'Null';
					
						$mail->send();

						return true;
	
						}catch(phpmailerException $e){
							return false;
						}
					}
				}
		}

}