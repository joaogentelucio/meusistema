<?php

    session_start();
    include_once('../../config.php');

    //print_r($_SESSION);


    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {

        unset($_SESSION['email']);          
        unset($_SESSION['senha']);
        header('Location: login.html');
    }

    $logado = $_SESSION['email'];

    if(!empty($_GET['search'])){

        $data = $_GET['search'];
        $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' OR nome LIKE '%$data%' OR email LIKE '%$data%' ORDER BY id DESC";
    }  
    else{

        $sql = "SELECT * FROM usuarios ORDER BY id DESC";

    } 
    
    $result = $conexao->query($sql);

    //print_r($result);
    

    //header('Location: sistema.html');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/2ea8344aaa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../styles/sistema.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <h1>Dashboard</h1>

    <?php 
        echo "Bem Vindo $logado";
    ?>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </div>

    <a href="sair.php">Sair</a>

    <div class="tabela-container">
        <table class="tabela">
            <thead>
                <tr>
                    <th scope="coluna">ID</th>
                    <th scope="coluna"NOME></th>
                    <th scope="coluna">EMAIL</th>
                    <th scope="coluna">SENHA</th>
                    <th scope="coluna">TELEFONE</th>
                    <th scope="coluna">SEXO</th>
                    <th scope="coluna">DATA DE NASCIMENTO</th>
                    <th scope="coluna">CIDADE</th>
                    <th scope="coluna">ESTADO</th>
                    <th scope="coluna">ENDEREÇO</th>
                    <th scope="coluna">EDITAR</th>
                </tr>
                <tbody>
                    <?php
                        while($user_data = mysqli_fetch_assoc($result))
                        {
                            echo"<tr>";
                            echo"<td>".$user_data['id']."</td>";
                            echo"<td>".$user_data['nome']."</td>";
                            echo"<td>".$user_data['email']."</td>";
                            echo"<td>".$user_data['senha']."</td>";
                            echo"<td>".$user_data['telefone']."</td>";
                            echo"<td>".$user_data['sexo']."</td>";
                            echo"<td>".$user_data['data_nasc']."</td>";
                            echo"<td>".$user_data['cidade']."</td>";
                            echo"<td>".$user_data['estado']."</td>";
                            echo"<td>".$user_data['endereco']."</td>";
                            echo"<td>
                                <a href='edit.php?id=$user_data[id]'>
                                    <button>
                                        <i class='fa-solid fa-pen'></i>
                                    </button>
                                </a>
                                <a href='delete.php?id=$user_data[id]'>
                                    <button>
                                        <span class='material-symbols-outlined'>
                                        delete
                                        </span>
                                    </button>
                                </a>
                            </td>";
                            echo"</tr>";
                        }
                    ?>
                </tbody>
            </thead>
        </table>
    </div>

    <script src="search.js"></script>
</body>
</html>