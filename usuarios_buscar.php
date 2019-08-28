<?php
Class Usuario_Busca{
	
	private $pdo;
	//public $msgErro = "";
	
	
	public function __construct($dbname, $host, $usuario, $senha)
  	{
  		
        
  		try
  		{
  			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$usuario,$senha);
  		} catch (PDOException $e) {
  			echo "Erro com DB: ".$e->getMessage();
  		}catch(Exception $e)
		{
			echo "Erro: ".$e->getMessage();
			}
		
  	}
	



public function cadastrar($nome, $email, $senha){
	
        $cmd = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email=:e");
		$cmd->bindValue(":e", $email);
		$cmd->execute();
		if($cmd->rowCount() > 0)
			{ return false;
				}else{
					$cmd = $pdo->prepare("INSER INTO usuarios (nome,email, senha) values(:n, :e :s)");
					$cmd->bindValue(":n",$nome);
					$cmd->bindValue(":e",$email);
					$cmd->bindValue(":s",md5($senha));
					$cmd->execute();
					return true;
					}
		
		
		
}

//logar

public function entrar($email, $senha){
	
        $cmd = $this->pdo->prepare("SELECT * from usuarios WHERE email = :e");
		$cmd->bindValue(":e", $email);
		$cmd->execute();
		if($cmd->rowCount() > 0)
			{ return false;
				}else{
					$cmd = $pdo->prepare("INSER INTO usuarios WHERE email = :e AND senha = :s");
					$cmd->bindValue(":e",$email);
					$cmd->bindValue(":s",md5($senha));
					$cmd->execute();
				if($cmd->rowCount() > 0) //se foi encontrada a pessoa
					{
				     $dados = $cmd->fetch();
					 session_start();
					 if ($dados['id_usuario'] ==  1)
					 {
						 $_SESSION['id_master'] = 1;
						 }else{
							 $_SESSION['id_usuario'] = $dados['id_usuario'];
							 }
							 return true;
					}else{
						return false;
		}
		
		
}

}

//busca e printa dados do usuario

public function buscarDadosUserPrint($id_usuario) {
	    global $pdo;
	    
		$cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");  
		$cmd->bindValue(":id_usuario", $id_usuario);
		$cmd->execute();
		$dados = $cmd->fetch();
		return $dados;
		
}


//busca e printa saldo do usuario
public function mostrarSaldo($id_usuario) {
	    global $pdo;
	    
		$cmd = $this->pdo->prepare("SELECT * FROM user_saldo WHERE id_usuario = :id_usuario");  
		$cmd->bindValue(":id_usuario", $id_usuario);
		$cmd->execute();
		$dados = $cmd->fetch();
		return $dados;
		
}






}

 ?>