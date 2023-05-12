<?php
    # /boasvindas.php
    require('verifica_login.php');
    require('twig_carregar.php');

    echo $twig->render('boasvindas.html', [
        'nome' => $_SESSION['nome'],
    ]);