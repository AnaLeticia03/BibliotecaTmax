<?php
include('../Model/Databse.php');

$db = new Database();

//pegando dados do formulário de login
if (isset($_POST['email-login']) && isset($_POST['senha-login'])) {

    echo "login";
    $email = $_POST['email-login'];
    $senha = $_POST['senha-login'];

    $verifica = $db->fetchUsuario($email, $senha);
    $user = $db->procuraUsuarioSenhaEmail($senha, $email);
    if (mysqli_num_rows($verifica)) {
      
        header("location: http://localhost/LivrariaTrabalho/View/livros.php" . "?user_id={$user['id']}");
    }else{
        header("location: http://localhost/LivrariaTrabalho/Index.php ");
    }
}

//pegando dados do formulário de cadastro

if (isset($_POST['email']) && isset($_POST['nome']) && isset($_POST['senha'])) {

    echo "cadastro";
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $db->insereUsuario($nome, $email, $senha);
    header("location: http://localhost/LivrariaTrabalho/View/livros.php");
}

//pegando dados do form de cadastro do admin
if (isset($_POST['email']) && isset($_POST['nome-admin']) && isset($_POST['senha'])) {

    echo "cadastro";
    $nome = $_POST['nome-admin'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    echo $db->insereUsuario($nome, $email, $senha);

    header("location: http://localhost/LivrariaTrabalho/View/admUsuario.php");
}

//Pegando dados do form de cadastro da pagida do adm para cadastrar um novo adm
if (isset($_POST['cpf']) && isset($_POST['nome-admin']) && isset($_POST['senha'])) {

    $nome = $_POST['nome-admin'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    echo $db->insereAdm($nome, $cpf, $senha);

    header("location: http://localhost/LivrariaTrabalho/View/admFuncionario.php");
}

//pegando dados do formulário de login do administrador
if (isset($_POST['codigo']) && isset($_POST['senha'])) {

    echo "conectado";
    $codigo = $_POST['codigo'];
    $senha = $_POST['senha'];

    $verifica = $db->fetchAdm($codigo, $senha);

    if (mysqli_num_rows($verifica)) {
        echo "usuário valido";
        header("location: http://localhost/LivrariaTrabalho/View/admLivros.php");
    }else{
        header("location: http://localhost/LivrariaTrabalho/Index.php ");
    }
}
