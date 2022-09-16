<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])){

    if(strlen($_POST['email']) == 0){
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0){
        echo "Preencha sua senha";
    } else{

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios Where email = '$email' and senha = '$senha' ";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do codigo SQL: " . $mysqli->error);

        $quantidade = $sql_query-> num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
            
        } else{
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }

}
?>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport"content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="style/style.css">

        <title>Login</title>

    </head>

    <body>

        <div id="login">

            <form class="card" action="" method="POST">

                <div class="card-header">

                    <h2>Acesse sua conta</h2>

                </div>

                <div class="card-content">

                    <div class="card-content-area">

                        <label>Email</label>

                        <input type="text" id="usuario" name="email">

                    </div>

                    <div class="card-content-area">

                        <label>Senha</label>

                        <input type="password" id="password" name="senha">

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="submit">Entrar</button>

                    <a href="#" class="recuperar_senha">Esqueceu a senha?</a>

                </div>

            </form>

        </div>

    </body>

</html>
