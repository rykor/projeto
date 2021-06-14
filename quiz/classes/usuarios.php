<?php

class Usuario
{   
    private $pdo; /*criando variavel para usar nas funçoes*/
    public $msgErro = ""; /*pega a mensagem de erro do php e joga na variavel msegErro e mostra pro usuario.*/
    
    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=.".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
           $msgErro = $e->getMessage();
        }
        
    }

    public function cadastrar($nome, $email, $senha)
    {
        global $pdo;
        global $msgErro;
        //verificar se já existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");//pega o id do usuario buscando pelo emial preenchido no cadastro
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount()>0) //verificando houve resposta na consulta
        {
            return false; //já se cadastrou
        }
        else
        {
            //caso não, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES(:n, :s, :e)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", $senha);
            $sql->execute();
            return true;
            
        }
       
    }

    public function logar($email, $senha)
    {
        global $pdo;
        global $msgErro;
        /*verificar se o email e senha estao cadastrados, se sim*/
  		$sql= $pdo->prepare("SELECT id FROM usuarios WHERE email=:e AND senha=:s");
  		$sql->bindValue(":e", $email);
  		$sql->bindValue(":s", md5($senha));
  		$sql->execute();
  		if($sql->rowCount()>0) //verificando houve resposta na consulta
  		{
  			//entrar no sistema criando uma (sessao)
  			$dado = $sql->fetch(); //transforma o retorno da query em array com os nomes das colunas
  			session_start();  //iniciando a sessao
  			$_SESSION['id'] = $dado['id']; //armazena o id do usuario na sessao.
  			return true;  //logado com sucesso
  		}
  		else
  		{
  			return false; //erro ao logar.
  		}

    }

}
?>