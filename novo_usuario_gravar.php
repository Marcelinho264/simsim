<?php
    # novo_usuario_gravar.php
    require('models/Model.php');
    require('models/Usuario.php');

    $nome = $_POST['nome'] ?? false;
    $email = $_POST['email'] ?? false;
    $pass = $_POST['pass'] ?? false;

    if (!$nome || !$pass) {
        header('location:novo_usuario.php');
        die;
    }

    $pass = password_hash($pass, PASSWORD_BCRYPT);

    $usr = new Usuario();
    $usr->create([
        'nome' => $nome,
        'email' => $email,
        'senha' => $pass,
    ]);

    header('location:usuarios.php');



