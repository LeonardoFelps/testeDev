<?php

session_start();

// Inicialização das listas de funcionários e departamentos
if (!isset($_SESSION['funcionarios'])) {
    $_SESSION['funcionarios'] = [];
}



if (!isset($_SESSION['departamentos'])) {
    $_SESSION['departamentos'] = [];
}

// Processamento do formulário de cadastro de funcionário
if (isset($_POST['nome'])) {
    $_SESSION['funcionarios'][] = [
        'nome' => $_POST['nome'],
        // Adicione outros campos aqui
    ];
}

// Processamento do formulário de cadastro de departamento
if (isset($_POST['nomeDepartamento'])) {
    $_SESSION['departamentos'][] = [
        'nome' => $_POST['nomeDepartamento']
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/ab17567ab1.js" crossorigin="anonymous"></script>
    <title>Gerenciamento</title>
</head>
<body>
    <header>
        <button onclick="openModal('funcionariosModal')">Funcionários</button>
        <button onclick="openModal('departamentosModal')">Departamentos</button>
        <button onclick="openModal('jornadaModal')">Jornada de trabalho</button>
    </header>

<!-- Modal Funcionários -->
<div id="funcionariosModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('funcionariosModal')">&times;</span>
        <h2>Funcionários</h2>

        <!-- Formulário de Cadastro de Funcionários -->
        <form id="cadastroFuncionarioForm" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required><br>
            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" required><br>
            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento" required>
                <?php foreach ($_SESSION['departamentos'] as $departamento): ?>
                    <option value="<?php echo $departamento['nome']; ?>"><?php echo $departamento['nome']; ?></option>
                <?php endforeach; ?>
            </select><br>
            <button type="button" onclick="cadastrarFuncionario()">Cadastrar</button>
        </form>

        <!-- Lista de Funcionários -->
        <h3>Lista de Funcionários</h3>
        <ul class="employee-list">
            <?php foreach ($_SESSION['funcionarios'] as $index => $funcionario): ?>
                <li class="employee-item">
                    <span class="employee-name"><?php echo htmlspecialchars($funcionario['nome']); ?></span>
                    <div class="employee-actions">
                        <button onclick="viewFuncionario(<?php echo $index; ?>)" class="view-button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <button onclick="excluirFuncionario(<?php echo $index; ?>)" class="delete-button">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

        </div>
    </div>

    <!-- Modal Visualizar Funcionário -->
    <div id="viewFuncionarioModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('viewFuncionarioModal')">&times;</span>
            <h2>Detalhes do Funcionário</h2>
            <p id="funcionarioDetalhes"></p>
        </div>
    </div>

    <!-- Modal Departamentos -->
<div id="departamentosModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('departamentosModal')">&times;</span>
        <h2>Departamentos</h2>
        <!-- Formulário para adicionar novo departamento -->
        <form id="cadastroDepartamentoForm">
            <label for="nomeDepartamento">Nome do Departamento:</label>
            <input type="text" id="nomeDepartamento" name="nomeDepartamento" required>
            <button type="button" onclick="cadastrarDepartamento()">Adicionar Departamento</button>
        </form>
        <!-- Lista de Departamentos -->
        <h3>Lista de Departamentos</h3>
        <ul class="department-list">
            <?php foreach ($_SESSION['departamentos'] as $indice => $departamento): ?>
                <li class="department-item">
                    <span class="department-name"><?php echo $departamento['nome']; ?></span>
                    <button class="delete-button" onclick="excluirDepartamento(<?php echo $indice; ?>)">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </li>
            <?php endforeach; ?>                
        </ul>
    </div>
</div>


    <!-- Modal Jornada de Trabalho -->
    <div id="jornadaModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('jornadaModal')">&times;</span>
            <h2>Jornada de Trabalho</h2>
            <div id="listaHorariosTrabalho">
                <!-- Aqui será incluída a lista de horários gerada pelo PHP -->
                <?php include 'criar_lista_horarios.php'; ?>
            </div>
        </div>
    </div>


<script>
 // Função para abrir o modal
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

// Função para fechar o modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Fecha o modal se o usuário clicar fora dele
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}

function cadastrarFuncionario() {
    // Coletar dados do formulário
    var nome = document.getElementById("nome").value.trim();
    var email = document.getElementById("email").value.trim();
    var cpf = document.getElementById("cpf").value.trim();
    var idade = document.getElementById("idade").value.trim();
    var departamento = document.getElementById("departamento").value;

    // Verificar se todos os campos obrigatórios estão preenchidos
    if (nome === "" || email === "" || cpf === "" || idade === "" || departamento === "") {
        alert("Por favor, preencha todos os campos obrigatórios.");
        return;
    }

    var formData = new FormData(document.getElementById("cadastroFuncionarioForm"));

    // Enviar dados via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cadastro_funcionario.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Recarregar a página após o cadastro bem-sucedido
            window.location.reload();
        }
    };
    xhr.send(formData);
}


// Função para cadastrar departamento via AJAX
function cadastrarDepartamento() {
    // Coletar dados do formulário
    var form = document.getElementById("cadastroDepartamentoForm");
    var nomeDepartamento = form.nomeDepartamento.value.trim();

    // Verificar se o campo está vazio
    if (nomeDepartamento === "") {
        alert("Por favor, preencha o nome do departamento.");
        return; // Impedir o envio do formulário
    }

    // Se o campo não estiver vazio, continuar com o envio via AJAX
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cadastro_departamento.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Recarregar a página após o cadastro bem-sucedido
            window.location.reload();
        }
    };
    xhr.send(formData);
}

// Função para visualizar os detalhes do funcionário
function viewFuncionario(index) {
    var funcionarios = <?php echo json_encode($_SESSION['funcionarios']); ?>;
    var funcionario = funcionarios[index];
    var detalhes = 'Nome: ' + funcionario.nome + '<br>' +
                   'Email: ' + funcionario.email + '<br>' +
                   'CPF: ' + funcionario.cpf + '<br>' +
                   'Idade: ' + funcionario.idade + '<br>' +
                   'Departamento: ' + funcionario.departamento;
    document.getElementById('funcionarioDetalhes').innerHTML = detalhes;
    openModal('viewFuncionarioModal');
}

// Função para excluir funcionário
function excluirFuncionario(indice) {
    if (confirm("Tem certeza que deseja excluir este funcionário?")) {
        // Enviar solicitação de exclusão via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "excluir_funcionario.php?indice=" + indice, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Recarregar a página após a exclusão bem-sucedida
                window.location.reload();
            }
        };
        xhr.send();
    }
}

// Função para adicionar novo departamento no DOM (se necessário)
function adicionarDepartamento() {
    let nomeDepartamento = document.getElementById('nomeDepartamento').value;
    if (nomeDepartamento.trim() !== '') {
        departamentos.push(nomeDepartamento);
        atualizarListaDepartamentos();
        document.getElementById('nomeDepartamento').value = ''; // Limpa o campo após adicionar
    }
}

// Função para atualizar a lista de departamentos no DOM (se necessário)
function atualizarListaDepartamentos() {
    let listaDepartamentos = document.getElementById('listaDepartamentos');
    listaDepartamentos.innerHTML = ''; // Limpa a lista antes de atualizar
    departamentos.forEach(function(departamento) {
        let li = document.createElement('li');
        li.textContent = departamento;
        listaDepartamentos.appendChild(li);
    });
}

// Função para preencher o dropdown de departamentos (se necessário)
function preencherDropdownDepartamentos() {
    let selectDepartamento = document.getElementById('departamento');
    selectDepartamento.innerHTML = ''; // Limpa o dropdown antes de preencher
    departamentos.forEach(function(departamento) {
        let option = document.createElement('option');
        option.value = departamento;
        option.textContent = departamento;
        selectDepartamento.appendChild(option);
    });
}

// Função para excluir departamento via AJAX
function excluirDepartamento(indice) {
    if (confirm("Tem certeza que deseja excluir este departamento?")) {
        // Enviar solicitação de exclusão via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "excluir_departamento.php?indice=" + indice, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Recarregar a página após a exclusão bem-sucedida
                window.location.reload();
            }
        };
        xhr.send();
    }
}

function verificarHorarioUtil() {
    // Obter o valor do campo de data
    var data = document.getElementById("data").value;

    // Criar um objeto FormData com a data
    var formData = new FormData();
    formData.append("data", data);

    // Enviar dados via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "criar_lista_horarios.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Exibir a resposta do servidor
            document.getElementById("resultadoVerificacao").innerHTML = xhr.responseText;
        }
    };
    xhr.send(formData);
}

    function expandirHorarios(indice) {
        var ul = document.querySelectorAll('.work-day .hours')[indice];
        if (ul.style.display === 'none') {
            ul.style.display = 'block';
        } else {
            ul.style.display = 'none';
        }
    }
    </script>
</body>
</html>
