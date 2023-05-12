<?php
    # login.php
    require('twig_carregar.php');

    $erro = $_GET['erro'] ?? false;

    echo $twig->render('login.html', [
        'erro' => $erro,
    ]);