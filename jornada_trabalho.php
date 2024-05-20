<?php
class JornadaTrabalho {
    private $horasUteis = array();

    public function gerarHorariosTrabalho() {
        // Obtém a data atual
        $dataAtual = new DateTime();

        // Gera a lista de horários de trabalho para os próximos 30 dias
        for ($i = 0; $i < 30; $i++) {
            // Define a data para o próximo dia
            $data = $dataAtual->add(new DateInterval('P1D'))->format('Y-m-d');

            // Adiciona as horas úteis de trabalho para o dia atual
            $this->adicionarHorasUteis($data);
        }
    }

    public function verificarHoraUtil($hora) {
        // Verifica se a hora está na lista de horas úteis de trabalho
        return in_array($hora, $this->horasUteis);
    }
}
