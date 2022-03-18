<?php
    include("../Model/Databse.php");
    $db = new Database();
    $livros = $db->fetchLivros();

    $user_id = $_GET['user_id'];
    $user = $db->procuraUsuario($user_id);


    if (isset($_GET['id_reserva'])) {
        
        $livro = $db->procuraLivro($_GET['id_reserva']);


        if($livro['qtd'] == "0"){
            echo  "<script>alert('Não é possível reservar esse livro');</script>";
        }


        $newQtd = $livro['qtd'] -1;
        $db->reserva($user_id, $livro['id'], $newQtd);

        header("location: http://localhost/LivrariaTrabalho/View/livros.php"."?user_id={$user_id}");

    }

    if (isset($_GET['id_devolve'])) {
        
        $livro = $db->procuraLivro($_GET['id_devolve']);
        $newQtd = $livro['qtd'] + 1;
        $db->devolver($user_id, $livro['id'], $newQtd);

        header("location: http://localhost/LivrariaTrabalho/View/livros.php"."?user_id={$user_id}");

    }


?>
<?php
ini_set('display_errors', 0 );
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Geral.css">
    <link rel="stylesheet" href="../Styles/tabelas.css">
    
    <title>Bem vindo</title>
    <hr>
</head>

<body>
    <header class="cabecalho">

        <img src="../Assets/logopng.png" alt="Logo da página">
        <ul>

            <li>
                <a href="../Index.php"> <button class="btn">Sair</button></a>
            </li>
        </ul>

    </header>
    <button type="button" class="collapsible">Informações <span>&#8595;</span> </button>
    <div class="content">
        <div class="info">
            <?php 
                $book = $db->procuraLivro($user['id_livro']);
                echo "<h3>Bem vindo {$user['nome']} </h3>";
                echo " <p> Livro reservado: ";
                if($book['id'] == NULL){
                    echo "nenhum livro reservado </p>";
                }
                else{
                    echo $book['nome'];
                }
                    
                    
               
            ?>
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
                    <th>RESERVA</th>

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
                                <a href='livros.php?user_id={$user_id} & id_devolve={$livro['id']}'> <button class='del'>Devolver</button> </a>
                                <a href='livros.php?user_id={$user_id} & id_reserva={$livro['id']}' ><button class='alt'>Reservar</button></a>
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