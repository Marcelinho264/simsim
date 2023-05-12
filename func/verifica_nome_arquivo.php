<?php
# func/verifica_nome_arquivo.php
function verifica_nome_arquivo($caminho, $arquivo) {
    // Não existe. Pode confiar!
    if (!file_exists($caminho . $arquivo)) {
        return $arquivo;
    }

    // Vish... O arquivo existe!
    $separado = explode('.', $arquivo);
    $ext = array_pop($separado);
    $arquivo = implode('.', $separado);

    // Vai aumentando $i até não existir
    $i = 1;
    while (file_exists("{$caminho}{$arquivo}{$i}.{$ext}")) {
        $i++;
    }

    return "{$arquivo}{$i}.{$ext}";
}