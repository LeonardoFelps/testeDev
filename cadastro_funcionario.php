<?php
session_start();

// Mensagem inicial vazia
$mensagem = '';

// Verificar se os dados foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Processar os dados recebidos e adicionar à sessão
    // Exemplo para cadastro de funcionário:
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $idade =  $_POST['idade'];
    $departamento = $_POST['departamento'];
    
    // Adicionar à lista de funcionários na sessão
    $_SESSION['funcionarios'][] = [
        'nome' => $nome,
        'email' => $email,
        'cpf' => $cpf,
        'idade' => $idade,
        'departamento' => $departamento
    ];

    // Verificar se o funcionário foi adicionado com sucesso
    if (isset($_SESSION['funcionarios']) && count($_SESSION['funcionarios']) > 0) {
        $mensagem = 'Funcionário cadastrado com sucesso!';
    } else {
        $mensagem = 'Erro ao cadastrar funcionário. Por favor, tente novamente.';
    }
}
echo $mensagem;
?>
