<?php
session_start();

// Mensagem inicial vazia
$mensagem = '';

// Verificar se os dados foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nomeDepartamento'])) {
    // Processar os dados recebidos e adicionar à sessão
    // Exemplo para cadastro de departamento:
    $nome = $_POST['nomeDepartamento'];
    
    // Adicionar o novo departamento ao array de departamentos na sessão
    $_SESSION['departamentos'][] = ['nome' => $nome];

    // Verificar se o departamento foi adicionado com sucesso
    $departamentos = array_column($_SESSION['departamentos'], 'nome');
    if (in_array($nome, $departamentos)) {
        $mensagem = 'Departamento cadastrado com sucesso!';
    } else {
        $mensagem = 'Erro ao cadastrar departamento. Por favor, tente novamente.';
    }
}

echo $mensagem;
?>
