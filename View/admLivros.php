<?php
include("../Model/Databse.php");
$db = new Database();
$livros = $db->fetchLivros();


if (isset($_GET['id_del'])) {
    $db->deleteLivro($_GET['id_del']);
    header("location: http://localhost/LivrariaTrabalho/View/admLivros.php");
}

if (isset($_GET['id_alt']) && isset($_GET['nome-update']) && isset($_GET['autor-update']) && isset($_GET['editora-update']) && isset($_GET['genero-update']) && isset($_GET['qtd-update'])) {
    $db->alteraLivro($_GET['id_alt'], $_GET['nome-update'], $_GET['autor-update'], $_GET['editora-update'] , $_GET['genero-update'], $_GET['qtd-update']);
    header("location: http://localhost/LivrariaTrabalho/View/admLivros.php");
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Geral.css">
    <link rel="stylesheet" href="../Styles/tabelas.css">
    <link rel="stylesheet" href="../Styles/formulario.css">
    <title>Bem vindo</title>
    <hr>
</head>

<body>
    <header class="cabecalho">

        <img src="../Assets/logopng.png" alt="Logo da página">
        <ul>

            <li>
                <a href="./admUsuario.php"><button class="btn">Adm Usuários</button></a>
            </li>
            <li>
                <a href="./admLivros.php"><button class="btn">Adm Livros</button></a>
            </li>
            <li>
                <a href="./admFuncionario.php"><button class="btn">Cadastro Adm</button></a>
            </li>

        </ul>
        <a href="../Index.php"> <button class="btn">Sair</button></a>


    </header>

    <button type="button" class="collapsible">Cadastro e Update <span>&#8595;</span> </button>
    <div class="content">

        <div class="cadastro-form">
            <h2 class="h2-form">Cadastro de Livros</h2>
            <form action="../Controller/LivrosController.php" method="POST">
                <div class="input_group">
                    <label for="nome">Nome</label> <br>
                    <input type="text" name="nome" required><br>
                </div>
                <div class="input_group">
                    <label for="autor">Autor</label> <br>
                    <input type="text" name="autor" required><br>
                </div>
                <div class="input_group">
                    <label for="genero">Gênero</label> <br>
                    <input type="text" name="genero" required><br>
                </div>
                <div class="input_group">
                    <label for="editora">Editora</label> <br>
                    <input type="text" name="editora" required><br>
                </div>
                <div class="input_group">
                    <label for="qtd">Quantidade</label> <br>
                    <input type="number" name="qtd" required><br>
                </div>

                <button type="submit" class="btn">Cadastrar</button>
            </form>
        </div>

        <div class="update-form">
            <h2 class="h2-form">Update</h2>
            <form action="./admLivros.php" method="GET">

                <?php
                if (isset($_GET['id_alt'])) {
                    $livro = $db->procuraLivro($_GET['id_alt']);
                    echo
                    "   
                        <input type='number'name='id_alt' value='{$livro['id']}' hidden>

                        <div class='input_group'>
                            <label for='nome-update'>Nome</label> <br>
                            <input type='text' name='nome-update' value='{$livro['nome']}' required><br>
                        </div>
                        <div class='input_group'>
                            <label for='autor-update'>Autor</label> <br>
                            <input type='text' name='autor-update' value='{$livro['autor']}' required><br>
                        </div>
                        <div class='input_group'>
                            <label for='editora-update'>Editora</label> <br>
                            <input type='text' name='editora-update' value='{$livro['editora']}' required><br>
                        </div>
                        <div class='input_group'>
                            <label for='genero-update'>Gênero</label> <br>
                            <input type='text' name='genero-update' value='{$livro['genero']}' required><br>
                        </div>
                        <div class='input_group'>
                            <label for='qtd-update'>Quantidade</label> <br>
                            <input type='number' name='qtd-update' value='{$livro['qtd']}' required><br>
                        </div>
                    
                    ";
                }

                ?>

                <button type="submit" class="btn">Alterar</button>
            </form>

        </div>

    </div>

    <div class="main">
        <h1 class="h1">Livros</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CREATED_AT</th>
                    <th>NOME</th>
                    <th>AUTOR</th>
                    <th>EDITORA</th>
                    <th>GENERO</th>
                    <th>QUANTIDADE</th>
                    <th>AÇÃO</th>

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($livros as $livro) {
                    echo "  <tr class='table-line'>
                            <td>
                               {$livro['id']}
                            </td>
                            <td>
                               {$livro['created_at']}
                            </td>
                            <td>
                                {$livro['nome']}
                            </td>
                            <td>
                               {$livro['autor']}
                            </td>
                            <td>
                                {$livro['editora']}
                            </td>
                            <td>
                                {$livro['genero']}
                            </td>
                            <td>
                                {$livro['qtd']}
                            </td>
                            <td>
                                <a href='admLivros.php?id_del={$livro['id']}'> <button class='del'>Deletar</button> </a>
                                <a href='admLivros.php?id_alt={$livro['id']}' ><button class='alt'>Alterar</button></a>
                            </td>
                        </tr>
                        ";
                }


                ?>

                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

<script src="../Js/geral.js"></script>