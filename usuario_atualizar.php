<?php
    # usuario_atualizar.php
    require('models/Model.php');
    require('models/Usuario.php');

    $id = $_POST['id'] ?? false;
    $nome = $_POST['nome'] ?? false;
    $email = $_POST['email'] ?? false;

    if (!$id || !$nome || !$email) {
        // Não mostra erro na tela
        // O usuário que aprenda a preencher os campos
        die;
    }

    $usr = new Usuario();
    $usr->update([
        'nome' => $nome,
        'email' => $email,
    ], $id);
    header('location:usuarios.php');
    die;