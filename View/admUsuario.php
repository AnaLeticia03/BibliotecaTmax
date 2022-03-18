<?php
include("../Model/Databse.php");
$db = new Database();
$usuarios = $db->fetchUsuarios();


if (isset($_GET['id_del'])) {
    $db->deleteUsuario($_GET['id_del']);
    header("location: http://localhost/LivrariaTrabalho/View/admUsuario.php");
}

if (isset($_GET['id_alt']) && isset($_GET['nome-update']) && isset($_GET['email-update']) && isset($_GET['id_livro-update'])) {
    $db->alteraUsuario($_GET['id_alt'], $_GET['nome-update'], $_GET['email-update'], $_GET['id_livro-update']);
    header("location: http://localhost/LivrariaTrabalho/View/admUsuario.php");
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
            <h2 class="h2-form">Cadastro</h2>
            <form action="../Controller/CadastroController.php" method="POST">
                <div class="input_group">
                    <label for="nome">Nome</label> <br>
                    <input type="text" name="nome-admin" required><br>
                </div>
                <div class="input_group">
                    <label for="e-mail">E-mail</label> <br>
                    <input type="mail" name="email" required><br>
                </div>
                <div class="input_group">
                    <label for="senha">Senha</label> <br>
                    <input type="password" name="senha" required><br>
                </div>

                <button type="submit" class="btn">Cadastrar</button>
            </form>
        </div>

        <div class="update-form">
            <h2 class="h2-form">Update</h2>
            <form action="./admUsuario.php" method="GET">
                
                <?php
                if(isset($_GET['id_alt'])){
                    $usuario = $db->procuraUsuario($_GET['id_alt']);
                    echo 
                    "   
                        <input type='number'name='id_alt' value='{$usuario['id']}' hidden>
                        <div class='input_group'>
                            <label for='nome-update'>Nome</label> <br>
                            <input type='text' name='nome-update' value='{$usuario['nome']}' required><br>
                        </div>
                        <div class='input_group'>
                            <label for='e-mail-update'>E-mail</label> <br>
                            <input type='email' name='email-update' value='{$usuario['email']}' required><br>
                        </div>
                        <div class='input_group'>
                            <label for='id_livro-update'>Id do Livro</label> <br>
                            <input type='number' name='id_livro-update' value='{$usuario['id_livro']}' required><br>
                        </div>
                    
                    ";
                }
                    
                ?>

                <button type="submit" class="btn">Alterar</button>
            </form>

        </div>
    </div>

    <div class="main">
        <h1 class="h1">Usuários</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CREATED_AT</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>ID_LIVRO</th>
                    <th>AÇÃO</th>

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($usuarios as $usuario) {
                    echo "  <tr class='table-line'>
                            <td>
                             {$usuario['id']}
                            </td>
                            <td>
                            {$usuario['created_at']}
                           </td>
                           <td>
                           {$usuario['nome']}
                          </td>
                          <td>
                          {$usuario['email']}
                         </td>
                         <td>
                         {$usuario['id_livro']}
                         </td>
                         <td>
                         <a href='admUsuario.php?id_del={$usuario['id']}'> <button class='del'>Deletar</button> </a>
                         <a href='admUsuario.php?id_alt={$usuario['id']}' ><button class='alt'>Alterar</button></a>
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