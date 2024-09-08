<?php

    session_start();

    //print_r($_REQUEST);

    include_once('../../config.php');


    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){
        // Acessa
        //include_once('../../config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //print_r('Email: ' . $email);
        //print_r('<br>');
        //print_r('Senha: ' . $senha);

        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        
        $result = $conexao->query($sql);

        //print_r($result);

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['email']);          
            unset($_SESSION['senha']);          
            header('Location: login.html');
        }
        else{
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;

            // Redireciona para o sistema
            header('Location: ../home/sistema.php');
          
        }

    }
    else{
        // Não Acessa
        header('Location: ../signin/login.html');
    }
?>