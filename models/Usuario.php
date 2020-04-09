<?php
class Usuario extends model {

	/* Retorna dados de todos os usuários */
	public function getAll() {
		$array = array();
		
		$sql = "SELECT * FROM tab_usuarios WHERE user_ativo='sim'";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0)
		{
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		
		
		return $array;
	}

	/* Retorna dados do Usuário informado no Id */
	public function getID($user_id) 
	{	
		$sql = "SELECT * FROM tab_usuarios WHERE user_id=:user_id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":user_id", $user_id);
		$sql->execute();

		if ($sql->rowCount() > 0)
		{
			return $sql->fetch();
		}

	}

	/* Retorna dados do Usuário informado usando O Telefone usado no Esqueci Senha */
	public function getDadosPorCelular($user_celular) 
	{	
		$sql = "SELECT * FROM tab_usuarios WHERE user_celular=:user_celular";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":user_celular", $user_celular);
		$sql->execute();

		if ($sql->rowCount() > 0)
		{
			return $sql->fetch();
		}

	}

	/* Veriica se já existe usuário cadastrado com o celular informado */
    public function existe_cadastro_celular($txtcelular){
    
        $sql = "SELECT * FROM tab_usuarios WHERE user_celular=:user_celular";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":user_celular", $txtcelular);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            return true; //Já existe usuario com o celular informado
        }
        else
        {
            return false; //Não existe usuario com o celular informado
        }
	}
	

    /* Verifica se já existe usuário cadastrado com email informado */
    public function existe_cadastro_email($txtemail){
    
        $sql = "SELECT * FROM tab_usuarios WHERE user_email=:user_email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":user_email", $txtemail);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            return true; //Já existe usuario com este email cadastrado
        }
        else
        {
            return false; //Não existe usuario com este email cadastrado
        }
    }


	public function salvar($txtnomecompleto, $txtcelular, $txtemail, $txtsenhaacesso, $txtestado, $txtcidade,$txtbairro, $txtcep)
	{
		$sql = " INSERT INTO tab_usuarios (
			user_nomecompleto,
			user_celular,
			user_email,
			user_senha,
			user_cidade,
			user_estado,
			user_bairro,
			user_cep,
			ip_lancamento)
		VALUES ( 
			:user_nomecompleto,
			:user_celular,
			:user_email,
			:user_senha,
			:user_cidade,
			:user_estado,
			:user_bairro,
			:user_cep,
			:ip_lancamento)";

			try
			{
				$sql = $this->db->prepare($sql);

				$sql->bindValue(":user_nomecompleto", $txtnomecompleto);
				$sql->bindValue(":user_celular", $txtcelular);
				$sql->bindValue(":user_email", $txtemail);
				$sql->bindValue(":user_senha", md5($txtsenhaacesso));
				$sql->bindValue(":user_cidade", $txtcidade);
				$sql->bindValue(":user_estado", $txtestado);
				$sql->bindValue(":user_bairro", $txtbairro);
				$sql->bindValue(':user_cep', $txtcep);
				$sql->bindValue(":ip_lancamento", $_SERVER['REMOTE_ADDR']);
				
				$sql->execute();
			}
			catch(PDOException $e)
			{
				echo "Erro salvar usuário .: ".$e->getMessage();
				exit;
			}
			

	}

	public function alterar($txtnomecompleto, $txtsenhaacesso, $txtestado, $txtcidade,$txtbairro, $txtcep)
	{
		if(!empty($txtsenhaacesso))
		{
			$sql = " UPDATE tab_usuarios SET user_nomecompleto=:user_nomecompleto,
						user_senha=:user_senha, user_cidade=:user_cidade, 
						user_estado=:user_estado, user_bairro=:user_bairro, user_cep=:user_cep, ip_lancamento=:ip_lancamento 
					WHERE user_id=:user_id";
		}
		else
		{
			$sql = " UPDATE tab_usuarios SET 
					user_nomecompleto=:user_nomecompleto, user_cidade=:user_cidade, 
					user_estado=:user_estado, user_bairro=:user_bairro, user_cep=:user_cep,	ip_lancamento=:ip_lancamento 
				WHERE user_id=:user_id";
		}

			try
			{
				$sql = $this->db->prepare($sql);				
				$sql->bindValue(":user_nomecompleto", $txtnomecompleto);

				if(!empty($txtsenhaacesso)){
					$sql->bindValue(":user_senha", md5($txtsenhaacesso));
				}				
				
				$sql->bindValue(":user_cidade", $txtcidade);
				$sql->bindValue(":user_estado", $txtestado);
				$sql->bindValue(":user_bairro", $txtbairro);
				$sql->bindValue(':user_cep', $txtcep);
				$sql->bindValue(":ip_lancamento", $_SERVER['REMOTE_ADDR']);
				$sql->bindValue(":user_id", $_SESSION['user_id']);
				
				$sql->execute();
			}
			catch(PDOException $e)
			{
				echo "Erro salvar usuário .: ".$e->getMessage();
				exit;
			}
			

	}

	/* Função utilizada para alterar a senha de acesso ao sistema quando usuario clicar em esquecer senha 
	esta senha será enviada para usuario via email e o mesmo poderá alterar via acesso administrativo */
	public function alterarSenha($user_id, $senha_temporaria)
	{
		
			$sql = " UPDATE tab_usuarios SET user_senha=:user_senha, ip_lancamento=:ip_lancamento WHERE user_id=:user_id";
		

			try
			{
				$sql = $this->db->prepare($sql);				
				$sql->bindValue(":user_senha", md5($senha_temporaria));
				$sql->bindValue(":ip_lancamento", $_SERVER['REMOTE_ADDR']);
				$sql->bindValue(":user_id", $user_id);
				$sql->execute();
			}
			catch(PDOException $e)
			{
				echo "Erro editar usuario para update senha, informe suporte tecnico .: ".$e->getMessage();
				exit;
			}
			

	}

	/*Login do sistema será via celular, caso queira mudar para email basta fazer os ajustes necessários*/
	public function logar($txtcelular, $senha_acesso)
	{
        $dados = array();

		$sql = "SELECT * FROM tab_usuarios WHERE user_celular=:user_celular AND user_senha=:user_senha AND user_ativo='sim'";
		try
		{
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":user_celular", $txtcelular);
			$sql->bindValue(":user_senha", md5($senha_acesso));
			$sql->execute();

			if ($sql->rowCount() > 0){
				$dados = $sql->fetch();
				$_SESSION['user_nomecompleto'] = $dados['user_nomecompleto'];
				$_SESSION['user_id'] = $dados['user_id'];
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			echo "Erro ao logar usuário .: ".$e->getMessage();
			exit;
		}
    }

	/*Se existe uma sessão criada então está logado, controlle do LoginController construtor*/
	public function estaLogado() 
	{
		if(!empty($_SESSION['user_id'])) {
			return true;
		}

		return false;
	}


}