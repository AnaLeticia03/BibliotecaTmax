<?php

include("../Model/Databse.php");

$db= new Database();
echo "livros controler";

if (isset($_POST['nome']) && isset($_POST['autor']) && isset($_POST['editora']) && isset($_POST['genero']) && isset($_POST['qtd']) ) {

    echo "cadastro";
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $genero = $_POST['genero'];
    $qtd = $_POST['qtd'];

    $db->insereLivro($nome, $autor, $editora, $genero,$qtd );
    header("location: http://localhost/LivrariaTrabalho/View/admlivros.php");
}





?>