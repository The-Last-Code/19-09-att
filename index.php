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
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<div class="form-group">
    <h1>LOGIN</h1>
    <!-- <form method="POST" -->
    <form method="POST">
      <label>CPF:</label>
      <input type="number" class="form-control" name="cpf_cientista">

      <label for="Senha">Senha</label>
      <input type="password" class="form-control" name="snh_cientista"><br>

      <button type="submit" class="btn btn-primary">ACESSAR</button>

      <a href="cadastrar.php"> Ainda não é inscrito?<strong>Cadastre-se</strong></a>
    </div>
</form>
<?php
//isset = verifica a existencia de variavel, array
if (isset($_POST["cpf_cientista"]))
{

    //addslashes para evitar sql injection
    $cpf_cientista = addslashes($_POST["cpf_cientista"]);
    $snh_cientista = addslashes($_POST["snh_cientista"]);


    //verificar se esta preenchido (Validação form)
    if(!empty($cpf_cientista) && !empty($snh_cientista))
    {

      $u->conectar("projeto_scilink", "localhost", "root", "");
      if($u->msgErro == "")//se não teve erro, OK2
      {

        if ($u->logar($cpf_cientista, $snh_cientista))
        {
          header("location: dashboard.php");
        }
        else
        { 
          ?>
            <div class="msg-erro">
              CPF ou Senha incorreta
            </div>
          <?php
        }
      }
      else
      {
        ?>
          <div class="msg-erro">
            <?php echo "Erro: ".$u->msgErro; ?>
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


