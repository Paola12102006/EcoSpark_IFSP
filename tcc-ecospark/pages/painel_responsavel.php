<?php

session_start();

// require_once './includes/autenticacao.php';
require '../logic/conectar_bd.php';

// verificarAcesso(['user', 'admin']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<p>Painel Responsavel</p>


<?php 

    echo $_SESSION['usuario_id'];
    echo $_SESSION['usuario_nome'];
    echo $_SESSION['usuario_email'];
    echo $_SESSION['usuario_avatar'];
    echo "<br>";

    // $_SESSION['usuario_tipo_perfil'] = $usuario_completo['tipoUsuario']; 
    echo $_SESSION['usuario_perfil'];

    echo "<br>";

    echo $_SESSION['responsavel_alunoAssociado'];
?>

<img src="../src/imgs/avatares/<?=$_SESSION['usuario_avatar']?>" alt="">
    
    
</body>
</html>