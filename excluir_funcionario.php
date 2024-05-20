<?php
session_start();

// Verificar se o índice foi enviado via GET
if (isset($_GET['indice'])) {
    $indice = (int)$_GET['indice'];

    // Verificar se o índice é válido
    if (isset($_SESSION['funcionarios'][$indice])) {
        // Remover o funcionário do array de funcionários
        unset($_SESSION['funcionarios'][$indice]);

        // Reindexar o array para evitar buracos nos índices
        $_SESSION['funcionarios'] = array_values($_SESSION['funcionarios']);
    }
}
?>
