<?php
// Verificar se a variável $_POST['data'] está definida
if (isset($_POST['data'])) {
    $data = $_POST['data'];

    // Aqui você pode usar a data para gerar a lista de horários de trabalho para os próximos 30 dias
    // Por exemplo, você pode usar um loop para gerar os horários de trabalho para cada dia
    echo '<div class="work-schedule">';
    for ($i = 0; $i < 30; $i++) {
        echo "<div class='work-day'>";
        echo "<span class='date'>" . date("Y-m-d", strtotime("$data +$i days")) . "</span>";
        echo "<ul class='hours'>";
        // Adiciona apenas as horas úteis de trabalho
        for ($hora = 9; $hora < 18; $hora++) {
            // Exclui a hora do almoço (12h às 13h)
            if ($hora != 12) {
                echo "<li class='hour'>" . date("H:i", strtotime("$data +$i days $hora:00")) . "</li>";
            }
        }
        echo "</ul>";
        echo "</div>";
    }
    echo '</div>';
} else {
    // Se $_POST['data'] não estiver definida, exiba uma mensagem de erro ou faça outra coisa
    echo "<p>Por favor, selecione uma data.</p>";
}
?>
