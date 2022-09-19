<?php

    session_start();

    if(!isset($_SESSION['id_cientista']))
    {
        header("location: index.php");
        exit;
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<link rel="stylesheet" type="text/css" href="./syle2.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
    <form method="POST">
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Criar Publicação</h2>

				<input type="text" class="field" placeholder="Título" name="tit_projeto">
                <label for="">Data de Início</label>
				<input type="date" class="field" placeholder="Data de Início"name="dti_projeto">
                <label for="">Data Final</label>
				<input type="date" class="field" placeholder="Data de Termino" name="dtt_projeto">

				<textarea style="resize: none" placeholder="Mensagem" class="field" name="res_projeto"></textarea>
				<button class="btn">Publicar</button>
			</div>
		</div>
	</div>
    </form>
</body>
</html>