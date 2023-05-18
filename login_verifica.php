<?php
    # login_verifica.php
    require('pdo.inc.php');

    $nome = $_POST['nome'];
    $pass = $_POST['pass'];

    // Cria a consulta e aguarda os dados
    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE nome = :usr');

    // Adiciona os dados na consulta
    $sql->bindParam(':usr', $nome);

    // Roda a consulta
    $sql->execute();

    $user = $sql->rowCount();
    

    // Se encontrou o usuário
    if ($user > 0) {
        // Login feito com sucesso
        $nome = $sql->fetch(PDO::FETCH_OBJ);
        // Verificar se a senha está correta
        if (!password_verify($pass, $nome->senha)) {
            // Falha no login
            header('location:login.php?erro=1');
            die;
        }

        // Cria uma sessão para armazenar o usuário
        session_start();
        $_SESSION['nome'] = $nome->id;
        
        // Redireciona o usuário
        header('location:usuarios.php');
        die;
    } else {
        // Falha no login
        header('location:login.php?erro=1');
        die;
    }