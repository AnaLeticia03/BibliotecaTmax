<?php
include('./Model/Databse.php');
$db = new Database();

//Cria as tabelas automaticamente 
$db->init();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/Geral.css">
    <link rel="stylesheet" href="./View/LoginAdm.php">
    <title>Biblioteca TMAX</title>
</head>

<body>
    <header class="cabecalho">

        <img src="./Assets/logopng.png" alt="Logo da página">
        <ul>
            <li>
                <a href="./View/LoginAdm.php"> <button class="btn">Acessar como Administrador</button></a>
            </li>
        </ul>
        <hr>

    </header>
    <section class="section">
        <div class="esquerda">
            <div class="bloco-cadastro">
                <h2 class="h2">Cadastro</h2>
                <form action="./Controller/CadastroController.php" method="POST">
                    <div class="input-group">
                        <label for="nome">Nome</label> <br>
                        <input type="text" name="nome" required><br>
                    </div>
                    <div class="input-group">
                        <label for="e-mail">E-mail</label> <br>
                        <input type="mail" name="email" required><br>
                    </div>
                    <div class="input-group">
                        <label for="senha">Senha</label> <br>
                        <input type="password" name="senha" required><br>
                    </div>
                    <button type="submit" class="btn">Enviar</button>
                </form>
            </div>

        </div>
        <div class="direita">
            <div class="bloco-login">
                <h2 class="h2">Login</h2> <br>
                <form action="./Controller/CadastroController.php" method="POST">
                    <div class="input-group">
                        <label for="email-login">E-mail</label> <br>
                        <input type="mail" name="email-login" required> <br>
                    </div>
                    <div class="input-group">
                        <label for="senha-login">Senha</label> <br>
                        <input type="password" name="senha-login" required> <br>
                    </div>
                    <a href=""><button class="btn" type="submit">Enviar</button></a>
                </form>

            </div>
    </section>

</body>

</html>