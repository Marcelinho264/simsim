<?php
    # verifica_login.php
    session_start();
    if (!isset($_SESSION['nome'])) {
        header('location:login.php?erro=2');
        die;
    }   