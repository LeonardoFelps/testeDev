<?php
function gerarHorariosUteis($dataInicio, $dias) {
    $horarios = [];
    $dataAtual = new DateTime($dataInicio);
    for ($i = 0; $i < $dias; $i++) {
        if ($dataAtual->format('N') < 6) { // 1 (segunda-feira) até 5 (sexta-feira)
            $horarioDia = [];
            for ($hora = 9; $hora < 18; $hora++) {
                $horarioDia[] = $hora . ":00 - " . ($hora + 1) . ":00";
            }
            $horarios[] = ['data' => $dataAtual->format('Y-m-d'), 'horarios' => $horarioDia];
        }
        $dataAtual->modify('+1 day');
    }
    return $horarios;
}

$horarios = gerarHorariosUteis(date('Y-m-d'), 30);
?>
<div class="work-schedule">
    <?php foreach ($horarios as $indice => $dia): ?>
        <div class="work-day" onclick="expandirHorarios(<?php echo $indice; ?>)">
            <span class="date"><?php echo $dia['data']; ?></span>
            <ul class="hours" style="display: none;">
                <?php foreach ($dia['horarios'] as $hora): ?>
                    <li class="hour"><?php echo $hora; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>
