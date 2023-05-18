<?php
    require_once 'twig_carregar.php';
    require_once 'verifica_login.php';

    echo $twig->render('documentos_novo.html');
?>