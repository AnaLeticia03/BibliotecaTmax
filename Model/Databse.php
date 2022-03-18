<?php

include("Connection.php");

class Database extends Connection
{
    //USUÁRIO
    // insere um usuario no banco
    public function insereUsuario($nome, $email, $senha)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `usuarios` VALUES 
        (NULL, '{$date}','{$nome}','{$email}','{$senha}',0)";

        echo $sql;

        $this->conectionDB()->query($sql);
    }

    public function deleteUsuario($id)
    {
        $sql = "DELETE FROM `usuarios` WHERE id = {$id}";
        $this->conectionDB()->query($sql);
    }
    public function alteraUsuario($id, $nome, $email, $id_livro)
    {
        $sql = "UPDATE `usuarios` SET nome= '{$nome}', email = '{$email}', id_livro = {$id_livro}  WHERE id = {$id}";
        $this->conectionDB()->query($sql);
    }
    
    //procura usuario pelo email e senha e retorna usuario
    public function fetchUsuario($email, $senha)
    {

        $sql = "select * from usuarios where email = '{$email}' and  senha = '{$senha}'";
        return $this->conectionDB()->query($sql);
    }
    
    //procura todos os usuarios para tabela
    public function fetchUsuarios()
    {
        $sql = "select * from usuarios;";
        $fetchUsuarios = $this->conectionDB()->query($sql);

        $usuarios = [];
        $i = 0;
        while ($fetch = $fetchUsuarios->fetch_array()) {
            $usuarios[$i] =
                [
                    "id" => $fetch['id'],
                    "created_at" => $fetch['created_at'],
                    "nome" => $fetch['nome'],
                    "email" => $fetch['email'],
                    "senha" => $fetch['senha'],
                    "id_livro" => $fetch['id_livro']
                ];
            $i++;
        };

        return $usuarios;
    }

    //Procura usuário a partir do ID
    public function procuraUsuario($id)
    {
        $sql = "select * from usuarios WHERE id ={$id} ";
        $fetchUsuario = $this->conectionDB()->query($sql);

        return $fetchUsuario->fetch_assoc();
    }

       //Procura usuário a partir do ID
       public function procuraUsuarioSenhaEmail($senha, $email)
       {
           $sql = "select * from usuarios WHERE senha ={$senha} and email = '{$email}' ";
           $fetchUsuario = $this->conectionDB()->query($sql);
   
           return $fetchUsuario->fetch_assoc();
       }

//----------------------------------------------------------------------------------

    //LIVRO
    public function insereLivro($nome, $autor, $editora, $genero, $qtd)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `livros` VALUES
        (NULL, '{$date}', '{$nome}', '{$autor}','{$editora}','{$genero}',{$qtd})";

        echo $sql;

        $this->conectionDB()->query($sql);
    }
    public function fetchLivros()
    {
        $sql = "select * from livros;";
        $fetchLivros = $this->conectionDB()->query($sql);

        $livros = [];
        $i = 0;
        while ($fetch = $fetchLivros->fetch_array()) {
            $livros[$i] =
                [
                    "id" => $fetch['id'],
                    "created_at" => $fetch['created_at'],
                    "nome" => $fetch['nome'],
                    "autor" => $fetch['autor'],
                    "editora" => $fetch['editora'],
                    "genero" => $fetch['genero'],
                    "qtd" => $fetch['qtd']

                ];
            $i++;
        };

        return $livros;
    }
    public function procuraLivro($id_livro)
    {
        $sql = "select * from livros WHERE id ={$id_livro} ";
        $fetchLivros = $this->conectionDB()->query($sql);

        return $fetchLivros->fetch_assoc();
    }
    public function deleteLivro($id)
    {
        $sql = "DELETE FROM `livros` WHERE id = {$id}";
        $this->conectionDB()->query($sql);
    }
    public function alteraLivro($id, $nome, $autor, $editora, $genero, $qtd)
    {
        $sql = "UPDATE `livros` SET nome= '{$nome}', autor = '{$autor}', editora = '{$editora}', genero = '{$genero}', qtd = {$qtd}  WHERE id = {$id}";
        $this->conectionDB()->query($sql);
    }

    public function reserva($user_id, $livro_id, $qtd)
    {
        $sql1 = "UPDATE `usuarios` SET id_livro= {$livro_id} where id = {$user_id}";
        $sql2 = "UPDATE `livros` SET qtd= {$qtd} where id = {$livro_id}";

        $this->conectionDB()->query($sql1);
        $this->conectionDB()->query($sql2);

    }
    public function devolver($user_id, $livro_id, $qtd)
    {
        $sql1 = "UPDATE `usuarios` SET id_livro= 0 where id = {$user_id}";
        $sql2 = "UPDATE `livros` SET qtd= {$qtd} where id = {$livro_id}";

        $this->conectionDB()->query($sql1);
        $this->conectionDB()->query($sql2);

    }

//----------------------------------------------------------------------------------

    //ADM
    //insere um administrador no banco
    public function insereAdm($nome, $cpf, $senha)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `adm` VALUES
      (NULL, '{$date}', '{$nome}', '{$cpf}' ,'{$senha}')";

        echo $sql;

        $this->conectionDB()->query($sql);
    }

    //Retorna um boleano se foi encontrado o adm a partir das suas credênciais
    public function fetchAdm($codigo, $senha)
    {

        $sql = "SELECT * from adm where cpf = '{$codigo}' and senha= '{$senha}'";
        return $this->conectionDB()->query($sql);
    }
    //procura todos os adms para tabela
    public function fetchAdms()
    {
        $sql = "select * from adm;";
        $fetchAdms = $this->conectionDB()->query($sql);

        $adms = [];
        $i = 0;
        while ($fetch = $fetchAdms->fetch_array()) {
            $adms[$i] =
                [
                    "id" => $fetch['id'],
                    "created_at" => $fetch['created_at'],
                    "nome" => $fetch['nome'],
                    "cpf" => $fetch['cpf'],
                ];
            $i++;
        };

        return $adms;
    }

    //Procura adm a partir do ID
    public function procuraAdm($id)
    {
        $sql = "select * from adm WHERE id ={$id} ";
        $fetchAdm = $this->conectionDB()->query($sql);

        return $fetchAdm->fetch_assoc();
    }
    //Deleta adm a partir do ID
    public function deleteAdm($id)
    {
        $sql = "DELETE FROM `adm` WHERE id = {$id}";
        $this->conectionDB()->query($sql);
    }

    //Altera um adm já existente
    public function alteraAdm($id, $nome, $cpf)
    {
        $sql = "UPDATE `adm` SET nome= '{$nome}', cpf = '{$cpf}' WHERE id = {$id}";
        $this->conectionDB()->query($sql);
    }

    public function procuraAdmSenhaCpf($senha, $cpf)
    {
        $sql = "select * from adm WHERE senha ={$senha} and cpf = '{$cpf}' ";
        $fetchAdm = $this->conectionDB()->query($sql);

        return $fetchAdm;
    }

    // =====================================================================================
    // INIT
    public function init()
    {
       $table_admin = "CREATE TABLE if not exists `adm` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `nome` varchar(255) COLLATE utf8mb4_bin NOT NULL,
        `cpf` char(11) COLLATE utf8mb4_bin NOT NULL,
        `senha` varchar(10) COLLATE utf8mb4_bin NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE = MyISAM AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;";

       $table_user = "CREATE TABLE if not exists  `usuarios` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `nome` char(50) COLLATE utf8mb4_bin NOT NULL,
        `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
        `senha` varchar(100) COLLATE utf8mb4_bin NOT NULL,
        `id_livro` int NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
      ) ENGINE = MyISAM AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;";

       $table_livros = "CREATE TABLE if not exists `livros` (
        `id` int NOT NULL AUTO_INCREMENT,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `nome` varchar(100) COLLATE utf8mb4_bin NOT NULL,
        `autor` varchar(100) COLLATE utf8mb4_bin NOT NULL,
        `editora` varchar(100) COLLATE utf8mb4_bin NOT NULL,
        `genero` varchar(50) COLLATE utf8mb4_bin NOT NULL,
        `qtd` int NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE = MyISAM AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_bin;";

      $date = date('Y-m-d H:i:s');
      $insertAdm="INSERT INTO `adm` VALUES  
      (NULL, '{$date}', 'Admin', '00000000000' ,'admin')";

      $this->conectionDB()->query($table_admin);
      $this->conectionDB()->query($table_user);
      $this->conectionDB()->query($table_livros);
      if($this->procuraAdmSenhaCpf('admin', '00000000000') == FALSE){
        $this->conectionDB()->query($insertAdm);
      }
      

    }
}
