<?php
    # usuario_apagar.php
    require('twig_carregar.php');
    require('pdo.inc.php'); // Conexão com o banco

    // Rotina de POST - Apagar o usuário
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Modifica o usuário para ativo = 0
        $id = $_POST['id'] ?? false;
        if ($id) {
            $sql = $pdo->prepare('DELETE FROM arquivos WHERE id = ?');
            $sql->execute([$id]);
        }
        header('location:documentos_filtrar.php');
        die;
    }

    // Rotina de GET - Mostrar informações na tela

    // Busca o usuário no banco para mostrar o nome dele na tela
    $id = $_GET['id'] ?? false;
    $sql = $pdo->prepare('SELECT * FROM arquivos WHERE id = ?');
    $sql->execute([$id]);
    $arquivo = $sql->fetch(PDO::FETCH_ASSOC);

    echo $twig->render('documentos_apagar.html',[
        'arquivo' => $arquivo,
    ]);