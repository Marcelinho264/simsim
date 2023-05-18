<?php
require_once 'verifica_login.php';
require('pdo.inc.php');
require('models/Model.php');
require('models/Arquivo.php');

$formatos_permitidos = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {
  echo 'Erro ao enviar o arquivo';
  exit;
}

$usuario = $_SESSION['nome'];

$arquivo = $_FILES['arquivo'];

if ($arquivo['size'] > 5 * 1024 * 1024) {
  echo 'O arquivo excede o tamanho máximo permitido de 5 MB';
  exit;
}

if (!in_array($arquivo['type'], $formatos_permitidos)) {
  echo 'Formato do arquivo não é permitido';
  exit;
}

$pasta_destino = 'uploads/';

$caminho_completo = $pasta_destino . $arquivo['name'];

if (!move_uploaded_file($arquivo['tmp_name'], $caminho_completo)) {
    echo 'Erro ao mover o arquivo';
    exit;
}

require_once 'pdo.inc.php';

$arq = new Arquivo();
$arq->create([
    'id_usuario' => $usuario,
    'arquivo' => $arquivo['name'],
    'caminho' => $caminho_completo,
    'tipo'=> $arquivo['type'],
]);

header('Location:documentos_filtrar');
?>