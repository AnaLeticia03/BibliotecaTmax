
<?php
include("../Model/Databse.php");
$db = new Database();
$adms = $db->fetchAdms();


if (isset($_GET['id_del'])) {
    $db->deleteAdm($_GET['id_del']);
    header("location: http://localhost/LivrariaTrabalho/View/admFuncionario.php");
}

if (isset($_GET['id_alt']) && isset($_GET['nome-update']) && isset($_GET['cpf-update']) ) {
    $db->alteraAdm($_GET['id_alt'], $_GET['nome-update'], $_GET['cpf-update']);
    header("location: http://localhost/LivrariaTrabalho/View/admFuncionario.php");
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
                    <label for="cpf">CPF (Esse será o codigo de acesso)</label> <br>
                    <input type="number" name="cpf" maxlength="11" required><br>
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
            <form action="./admFuncionario.php" method="GET">

                <?php
                if (isset($_GET['id_alt'])) {
                    $adm = $db->procuraAdm($_GET['id_alt']);
                    echo
                    "   
                        <input type='number'name='id_alt' value='{$adm['id']}' hidden>
                        <div class='input_group'>
                            <label for='nome-update'>Nome</label> <br>
                            <input type='text' name='nome-update' value='{$adm['nome']}' required><br>
                        </div>
                        <div class='input_group'>
                            <label for='cpf-update'>CPF</label> <br>
                            <input type='cpf' name='cpf-update' maxlength='11' value='{$adm['cpf']}' required><br>
                        </div>
                    
                    ";
                }

                ?>

                <button type="submit" class="btn">Alterar</button>
            </form>

        </div>

    </div>
    <div class="main">
        <h1 class="h1">Funcionários</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CREATED_AT</th>
                    <th>NOME</th>
                    <th>CPF (Código)</th>
                    <th>AÇÃO</th>
                    

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($adms as $adm) {
                    echo "  <tr class='table-line'>
                            <td>
                             {$adm['id']}
                            </td>
                            <td>
                            {$adm['created_at']}
                           </td>
                           <td>
                           {$adm['nome']}
                          </td>
                          <td>
                          {$adm['cpf']}
                         </td>
                        
                         <td>
                         <a href='admFuncionario.php?id_del={$adm['id']}'> <button class='del'>Deletar</button> </a>
                         <a href='admFuncionario.php?id_alt={$adm['id']}' ><button class='alt'>Alterar</button></a>
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
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            content.classList.toggle("active_content");
        });
    }
</script>
<script src="./js/script.js"></script>