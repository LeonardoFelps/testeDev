<?php
session_start();

// Verifica se o índice do departamento a ser excluído foi recebido via GET
if(isset($_GET['indice'])) {
    $indice = $_GET['indice'];

    // Verifica se o índice é válido e se o departamento existe na lista
    if(isset($_SESSION['departamentos'][$indice])) {
        // Remove o departamento da lista com base no índice fornecido
        unset($_SESSION['departamentos'][$indice]);
        // Redireciona de volta para a página principal após a exclusão
        header("Location: index.php");
        exit();
    }
}

// Se o índice não for válido ou se houver algum erro, redireciona de volta para a página principal
header("Location: index.php");
exit();
?>
