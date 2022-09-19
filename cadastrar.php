<?php
    require_once 'classes/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JBS Passagem</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<div class="form-group">
    <h1>Cadastrar Usuário</h1>
    <!-- <form method="POST" actions="processa.php"> -->
    <form method="POST">
        <label for="nomeUsuario">Nome Completo</label>
        <input type="text" class="form-control" name="nom_cientista" maxlength="50">
        
        <label for="telefone">CPF</label>
        <input type="number" class="form-control" name="cpf_cientista" maxlength="30">

        <label for="seu email">Data de Nascimento</label>
        <input type="date" class="form-control" name="dtn_cientista" aria-describedby="emailHelp" maxlength="30">

        <label for="seu email">Email</label>
        <input type="email" class="form-control" name="email_cientista" aria-describedby="emailHelp" maxlength="50">

        <label for="seu email">Email2</label>
        <input type="email" class="form-control" name="email_alternativo_cientista" aria-describedby="emailHelp" maxlength="50">

        <label for="seu email">Lattes</label>
        <input type="text" class="form-control" name="lattes_cientista" aria-describedby="emailHelp" maxlength="30">

        <label for="Senha">Senha</label>
        <input type="password" class="form-control" name="snh_cientista" maxlength="15">

        <label for="Senha">Confirmar Senha</label>
        <input type="password" class="form-control" name="confirmarSenha" maxlength="15"><br>

        <button type="submit" class="btn btn-primary">CADASTRAR</button>

        <a href="index.php"> Login</a>
    </form>
</div>

<?php

//isset = verifica a existencia de variavel, array
if (isset($_POST['nom_cientista']))
{
    //addslashes para evitar sql injection
    $nom_cientista = addslashes($_POST['nom_cientista']);
    $cpf_cientista = addslashes($_POST['cpf_cientista']);
    $dtn_cientista = addslashes($_POST['dtn_cientista']);
    $email_cientista = addslashes($_POST['email_cientista']);
    $email_alternativo_cientista = addslashes($_POST['email_alternativo_cientista']);
    $lattes_cientista = addslashes($_POST['lattes_cientista']);
    $snh_cientista = addslashes($_POST['snh_cientista']);
    $confirmarSenha = addslashes($_POST['confirmarSenha']);


    //verificar se esta preenchido (Validação form)
    if(!empty($nom_cientista) && !empty($cpf_cientista) && !empty($dtn_cientista)
        && !empty($email_cientista) && !empty($email_alternativo_cientista)
        && !empty($lattes_cientista) && !empty($snh_cientista) && !empty($confirmarSenha))
    {
    
        $u->conectar("projeto_scilink", "localhost", "root", "");
        if($u->msgErro == "")//se não teve erro, OK
        {
            //confirmar o verificar senha
            if($snh_cientista == $confirmarSenha)
            {
                if($u->cadastrar($nom_cientista, $cpf_cientista, $dtn_cientista, $email_cientista,
                $email_alternativo_cientista, $lattes_cientista, $snh_cientista))
                {
                    ?>
                        <div class="msg-sucesso">
                            Cadastrado com sucesso! Acesse para entrar!
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class="msg-erro">
                            Email já cadastrado!
                        </div>
                    <?php
                }
            }
            else
            {   
                ?>
                   
                    <div class="msg-erro">
                        Senha e confirmar senha não correspondem
                    </div>
                <?php
            }             
        }
        else
        {
            ?>
                <div class="msg-erro">
                    <?php echo "Erro: ".$u->msgErro;?>
                </div>
            <?php
        }
    }
    else
    {
        ?>
            <div class="msg-erro">
                Preencha todos os campos!
            </div>
        <?php
    }
}

?>

</body>
</html>