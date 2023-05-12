<?php
    # /novo_usuario.php
    require('verifica_login.php');
    require('twig_carregar.php');

    echo $twig->render('novo_usuario.html');