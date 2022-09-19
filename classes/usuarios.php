<?php

class Usuario 
{
     //usando PDO
    private $pdo;
    public $msgErro = "";   
    
    public function conectar($nome, $host, $usuario, $senha) 
    {
        global $pdo;
        global $msgErro;
        try 
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) 
        {
            $msgErro = $e->getMessage();
        }
        
    }

    public function cadastrar($nom_cientista, $cpf_cientista, $dtn_cientista, $email_cientista,
    $email_alternativo_cientista, $lattes_cientista, $snh_cientista)
    {
        global $pdo;
        //verificar se já esta cadastrado
        $sql = $pdo->prepare("SELECT *FROM cientista
            WHERE cpf_cientista = :b");
            $sql->bindValue(":b", $cpf_cientista);
            $sql->execute();

            //veficar se já esta cadastrado, contando as linhas
            if($sql->rowCount() > 0)
            {
                return false; //já esta cadastrado
            }
            else
            {
                //caso não, cadastrar   
                $sql = $pdo->prepare("INSERT INTO cientista (nom_cientista, cpf_cientista, dtn_cientista, 
                email_cientista, email_alternativo_cientista, lattes_cientista, snh_cientista) 
                VALUES (:a, :b, :c, :d, :e, :f, :g)");

                $sql->bindValue(":a", $nom_cientista);
                $sql->bindValue(":b", $cpf_cientista);
                $sql->bindValue(":c", $dtn_cientista);
                $sql->bindValue(":d", $email_cientista);
                $sql->bindValue(":e", $email_alternativo_cientista);
                $sql->bindValue(":f", $lattes_cientista);
                $sql->bindValue(":g", $snh_cientista);
                $sql->execute();
                return true;
            }
    }

    public function logar($cpf_cientista, $snh_cientista)
    {
        global $pdo;

        /* verifica se o email e senha ja estao encontrados */
        $sql = $pdo->prepare("SELECT *FROM cientista WHERE
        cpf_cientista = :b AND snh_cientista = :g");
        $sql->bindValue(":b", $cpf_cientista);
        $sql->bindValue(":g", $snh_cientista);

        $sql->execute();

        if($sql->rowCount() > 0)
        { 
            /* entrar no sistema */
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_cientista'] = $dado['id_cientista'];
            return true; /* cadastrado c/ sucesso */
        }
        else
        {
            return false; /* n conseguiu logar */
        }

    }
}



?>