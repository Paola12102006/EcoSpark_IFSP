<?php
$textoTempo = "";

if (!empty($atividade['prazo'])) {

    $agora = new DateTime();
    $prazo = new DateTime( $atividade['prazo'] );

    if ($comprovacao) { // JÁ EXISTE ENVIO
        
        $dataEnvio = new DateTime( $comprovacao['dataEnvio'] );
        
        if ($dataEnvio <= $prazo) { // adiantado

            $diferenca = $dataEnvio->diff($prazo);
            $textoTempo = "A tarefa foi enviada " . formatarDiferenca($diferenca) . " adiantada";

        } else { // atrasado
            $diferenca = $prazo->diff($dataEnvio);
            $textoTempo = "A tarefa foi enviada " . formatarDiferenca($diferenca) . " atrasada";
        }
    } else { // NÃO EXISTE ENVIO

        if ($agora < $prazo) { // ainda está dentro do prazo

            $diferenca = $agora->diff($prazo);
            $textoTempo = formatarDiferenca($diferenca) . " restando";

        } else { // prazo já passou
            $diferenca = $prazo->diff($agora);
            $textoTempo = "Prazo encerrado há " . formatarDiferenca($diferenca);
        }
    }
} else {
    $textoTempo = "Prazo não definido";
}

function formatarDiferenca(DateInterval $diferenca) {
    /*
        se tiver dias: 0 dias 0 horas
        se não tiver dias, mas tiver horas: 0 horas 0 minutos
        se tiver somente minutos: 0 minutos 0 segundos
    */

    if ($diferenca->days > 0) {

        $dias = $diferenca->days;
        $horas = $diferenca->h;
        return $dias . ($dias == 1 ? " dia " : " dias ") . $horas . ($horas == 1 ? " hora" : " horas");
    }

    if ($diferenca->h > 0) {

        $horas = $diferenca->h;
        $minutos = $diferenca->i;
        return $horas . ($horas == 1 ? " hora " : " horas ") . $minutos . ($minutos == 1 ? " minuto" : " minutos");
    }

    $minutos = $diferenca->i;
    $segundos = $diferenca->s;
    return $minutos . ($minutos == 1 ? " minuto " : " minutos ") . $segundos . ($segundos == 1 ? " segundo" : " segundos");
}