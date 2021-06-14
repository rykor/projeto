<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/estilo.css">
    <title>Cadastro</title>
</head>
<body>
<div id="corpo">
    <h1>Cadastrar</h1>
    <form method ="POST">
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
        <input type="email" name="email" placeholder="Email" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="20">
        <input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="20">>
        <input type="submit" value="Cadastrar">
        <a href="index.php"><strong> Já possui cadastro? Clique aqui! </strong></a>
    </form>
</div>
<?php


?>
</body>
</html>