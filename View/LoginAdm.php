<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Geral.css">
    <link rel="stylesheet" href="../Styles/LoginAdm.css">
    <title>Biblioteca TMAX</title>
</head>

<body>
    <header class="cabecalho">

        <img src="../Assets/logopng.png" alt="Logo da página">
        <ul>
            <li>
                <a href="../index.php"> <button class="btn">Acessar como Usuário</button></a>
            </li>
        </ul>
        <hr>
    </header>
    <section class="section">
        <div class="bloco-login-administrador">

            <h2 class="h2">Login</h2>
            <form action="../Controller/CadastroController.php" method="POST">
                <div class="input-group">
                    <label for="codigo">Código do Funcionário</label> <br>
                    <input type="text" name="codigo" required> <br>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label> <br>
                    <input type="password" name="senha" required> <br>
                </div>
                <button type="submit" class="btn">Enviar</button>
            </form>

        </div>
    </section>
</body>