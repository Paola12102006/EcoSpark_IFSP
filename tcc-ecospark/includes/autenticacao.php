<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function verificarAcesso(array $perfisPermitidos) {
    
    if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
        header('Location: ../index.php?erro=nao_logado');
        exit();
    }

    if (!in_array($_SESSION['usuario_perfil'], $perfisPermitidos)) {
        header('Location: ../index.php?erro=acesso_negado');
        exit();
    }
}
?>