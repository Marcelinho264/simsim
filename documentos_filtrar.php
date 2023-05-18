<?php
require_once 'pdo.inc.php';
require_once 'twig_carregar.php';
require_once 'verifica_login.php'; // Inclua o arquivo de verificação de sessão

$pasta_documentos = 'uploads/';

// Obtém o ID do usuário logado
$id_usuario = $_SESSION['nome'];

// Obtém os valores dos filtros
$filtro_tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$filtro_data = isset($_POST['upload']) ? $_POST['upload'] : '';

// Consulta SQL para obter os documentos do usuário logado com filtros
$sql = 'SELECT * FROM arquivos WHERE id_usuario = ?';
$params = [$id_usuario];

if (!empty($filtro_tipo)) {
    $sql .= ' AND tipo = ?';
    $params[] = $filtro_tipo;
}

if (!empty($filtro_data)) {
    $sql .= ' AND data = ?';
    $params[] = $filtro_data;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$arquivos_na_pasta = glob($pasta_documentos . '*');

$arquivos = array();
foreach ($stmt as $arq) {

    $caminho_do_arquivo = $pasta_documentos . $arq['arquivo'];
    if (!in_array($caminho_do_arquivo, $arquivos_na_pasta)) {
        continue;
    }

    $arquivos[] = array(
        'id' => $arq['id'],
        'id_usuario' => $arq['id_usuario'],
        'arquivo' => $arq['arquivo'],
        'tipo' => $arq['tipo'],
        'upload' => $arq['upload'],
        'caminho' => $caminho_do_arquivo,
    );
}

echo $twig->render('documentos_filtrar.html', array('arquivos' => $arquivos));
?>