<?php

require('twig_carregar.php');
require('pdo.inc.php');

session_start();

$localhost = "localhost";
$dbname = "projetoj";
$dbusername = "root";
$dbpassword = "";

// Conectar ao banco de dados
$pdo = new PDO("mysql:host=$localhost;dbname=$dbname", $dbusername, $dbpassword);

// Verificar a conexão
if (!$pdo) {
  echo "Falha ao conectar ao MySQL";
  exit();
}

// Consultar o banco de dados para obter a lista de usuários
$sql = $pdo->prepare('SELECT id, nome FROM usuarios');
$sql->execute();
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

// Consultar o banco de dados para obter a lista de documentos
$sql = $pdo->prepare('SELECT id, arquivo, caminho, tipo, upload FROM arquivos');
$sql->execute();
$documentos = $sql->fetchAll(PDO::FETCH_ASSOC);

// Obter o ID do usuário logado
$idUsuario = $_SESSION['nome'];

// Verificar se o formulário foi enviado
if (isset($_POST['nome']) && isset($_POST['id_arquivo'])) {
  // Obter o usuário selecionado
  $idUsuarioDestino = $_POST['nome'];

  // Obter o documento selecionado
  $idDocumento = $_POST['id_arquivo'];

  // Verificar se o documento existe
  $documentoExists = false;
  foreach ($documentos as $documento) {
    if ($documento['id'] == $idDocumento) {
      $documentoExists = true;
      break;
    }
  }

  if ($documentoExists) {
    // Inserir o documento na tabela de compartilhamentos
    $sql = $pdo->prepare('INSERT INTO compartilhar (id_usuario, id_arquivo) VALUES (?, ?)');
    $sql->execute([$idUsuarioDestino, $idDocumento]);

    // Redirecionar para a página de compartilhamentos
    header('Location: documentos_compartilhar.php');
    exit();
  } else {
    echo "Documento inválido. Por favor, selecione um documento válido.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Desenvolvimento</title>
</head>
<body>
  <ul class="nav justify-content-center p-1  bg-primary text-white">
    <li class="nav-item">
      <a class="nav-link active text-light" href="documentos_compartilhar.php">Compartilhar</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active text-light" href="documentos_filtrar.php">Documentos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light" href="documentos.php">Enviar Documentos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light" href="usuarios.php">Usuários</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light" href="logout.php">Sair</a>
    </li>

  </ul>
<?php

// Exibir o formulário
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<label>Selecione um documento:</label>";
echo "<select name='id_arquivo'>";
foreach ($documentos as $documento) {
  echo "<option value='" . $documento['id'] . "'>" . $documento['arquivo'] . "</option>";
}
echo "</select>";
echo "<br><br>";
echo "<label>Selecione um usuário:</label>";
echo "<select name='nome' >";
foreach ($usuarios as $usuario) {
  if ($usuario['id'] != $idUsuario) {
    echo "<option value='" . $usuario['id'] . "'>" . $usuario['nome'] . "</option>";
  }
}
echo "</select>";
echo "<br><br>";
echo "<input type='submit' value='Compartilhar'>";
echo "</form>";

// Fechar a conexão
$pdo = null;
?>
