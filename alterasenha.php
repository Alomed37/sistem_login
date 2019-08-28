<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/estilo.css">
	<!--	<title>Alterar Senha</title>   -->
</head>

<body>
	<div id="corpo-form-cad">
		<h1></h1>
		<form method="POST">

			<input type="password" name="novasenha" placeholder="Senha" maxlength="20">
			<input type="password" name="confSenha" placeholder="Confirmar senha">
			<input type="submit" value="Cadastrar" class="entrar">

		</form>
	</div>
</body>

</html>




<?php

require_once 'usuarios.php';
$u = new Usuario; 

if (isset($_POST['novasenha'])) {



	$novasenhaup = htmlentities(addslashes($_POST['novasenha']));
	$confirmarSenha = htmlentities(addslashes($_POST['confSenha']));


	//verificando se todos os campos nao estao vazios
	if (!empty($novasenhaup) && !empty($confirmarSenha)) {
		$u->conectar("sistem_login", "localhost", "root", "");
		if ($u->msgErro == "") //conectado normalmente;
			{
				if ($novasenhaup == $confirmarSenha) {
					if ($u->trocarSenha($novasenhaup, $id_usuario)) {
						echo '<br>';
						echo "Cadastro realizado com sucesso!";
					} else {
						echo '<br>';
						echo "Senha não conferem.";
					}
				}
			}
	}
}
?>
</div>
</body>

</html>
