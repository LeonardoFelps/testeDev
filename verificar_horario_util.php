<?php
// Verifica se os dados foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    // Verifica se os dados foram recebidos corretamente
    if (!isset($data) || !isset($hora)) {
        // Se algum dos campos estiver faltando, retorna uma mensagem de erro
        enviarRespostaErro("Erro: Dados incompletos.");
    }

    // Verifica se a data e a hora têm formatos válidos
    if (!validarFormatoData($data) || !validarFormatoHora($hora)) {
        // Se a data ou a hora estiverem em um formato inválido, retorna uma mensagem de erro
        enviarRespostaErro("Erro: Formato de data ou hora inválido.");
    }

    // Verifica se a hora está dentro do intervalo útil (das 9h às 12h e das 13h às 18h)
    $horaUtil = verificarHoraUtil($hora);
    
    // Envia a resposta como JSON
    enviarRespostaSucesso(array("horaUtil" => $horaUtil));
} else {
    // Se os dados não foram recebidos via POST, retorna erro
    enviarRespostaErro("Erro: Requisição inválida.");
}

// Função para enviar uma resposta de sucesso em formato JSON
function enviarRespostaSucesso($dados) {
    header('Content-Type: application/json');
    echo json_encode($dados);
    exit;
}

// Função para enviar uma resposta de erro em formato JSON
function enviarRespostaErro($mensagem) {
    header('Content-Type: application/json');
    http_response_code(400);
    echo json_encode(array("mensagem" => $mensagem));
    exit;
}

// Função para validar o formato da data
function validarFormatoData($data) {
    // Aqui você pode implementar a validação do formato da data conforme necessário
    // Por exemplo, usando expressões regulares ou funções de manipulação de datas do PHP
    return true; // Temporariamente retornando true para simplificar o exemplo
}

// Função para validar o formato da hora
function validarFormatoHora($hora) {
    // Aqui você pode implementar a validação do formato da hora conforme necessário
    // Por exemplo, usando expressões regulares ou funções de manipulação de datas do PHP
    return true; // Temporariamente retornando true para simplificar o exemplo
}

// Função para verificar se a hora está dentro do intervalo útil
function verificarHoraUtil($hora) {
    // Implemente a lógica para verificar se a hora está dentro do intervalo útil aqui
    // Por exemplo, comparando a hora com o intervalo de trabalho (9h às 12h e 13h às 18h)
    return true; // Temporariamente retornando true para simplificar o exemplo
}
?>
