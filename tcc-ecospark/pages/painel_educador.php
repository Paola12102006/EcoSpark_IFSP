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

<p>Painel Educador</p>

<?php 

    echo $_SESSION['usuario_id'];
    echo $_SESSION['usuario_nome'];
    echo $_SESSION['usuario_email'];
    echo $_SESSION['usuario_avatar'];
    // $_SESSION['usuario_tipo_perfil'] = $usuario_completo['tipoUsuario']; 
    echo $_SESSION['usuario_perfil'];

    echo $_SESSION['educador_formacao'];
    echo $_SESSION['educador_instituicao'];

    echo "<br>";

    echo $_SESSION['educador_statusConta'];
?>

<img src="../src/imgs/avatares/<?=$_SESSION['usuario_avatar']?>" alt="">
    
</body>
</html>