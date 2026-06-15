<?php
session_start();

require_once './conectar_bd.php';

$email_form = $_POST['email-login'];
$senha_form = $_POST['senha-login'];

$sql = "SELECT * FROM usuarios WHERE email = ?";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email_form]); 
    $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    header('Location: ../login-cadastro.php?erro=bd_query');
    exit(); 
}
 
$usuario_autenticado = null;

if ($usuario_db && password_verify($senha_form, $usuario_db['senha'])) {
    $usuario_autenticado = $usuario_db;
}

if ($usuario_autenticado) {

    $tipo_perfil = $usuario_autenticado['tipoUsuario'];
    $id_usuario = $usuario_autenticado['id_usuario'];

    switch ($tipo_perfil) {
        case 'administrador':
            $perfil_nome = "administrador";
            
            break;
        
        case 'estudante':
            
            $perfil_nome = "estudante";
            $sql = "SELECT serie, escola, nomeResponsavelAssociado FROM estudante WHERE idUsuario = ?";
        
            break;

        case 'educador':
            
            $perfil_nome = "educador";
            $sql = "SELECT formacao, instituicaoEnsino, statusConta FROM educador WHERE idUsuario = ?";

            break;
        
        case 'responsavel':
            
            $perfil_nome = "responsavel";
            $sql = "SELECT nomeAlunoAssociado FROM responsavel WHERE idUsuario = ?";

            break;
        default:
            $perfil_nome = "nenhum";
            break;
    }

    if (isset($sql)) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
    
        $dados_especificos = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $usuario_completo = array_merge(
        $usuario_autenticado,
        $dados_especificos
    );

    $_SESSION['usuario_logado'] = true;
    $_SESSION['usuario_id'] = $usuario_completo['id_usuario'];
    $_SESSION['usuario_nome'] = $usuario_completo['nomeCompleto'];
    $_SESSION['usuario_email'] = $usuario_completo['email'];
    $_SESSION['usuario_avatar'] = $usuario_completo['avatar'];
    // $_SESSION['usuario_tipo_perfil'] = $usuario_completo['tipoUsuario']; 
    $_SESSION['usuario_perfil'] = $perfil_nome; 


    if ($tipo_perfil === "administrador") {

        header('Location: ../admin/painel_admin.php');
        exit();

    } else if ($tipo_perfil === "estudante") {

        $_SESSION['estudante_serie'] = $usuario_completo['serie'];
        $_SESSION['estudante_escola'] = $usuario_completo['escola'];
        $_SESSION['estudante_responsavelAssociado'] = $usuario_completo['nomeResponsavelAssociado'];

        header('Location: ../pages/painel_estudante.php');
        exit();

    } else if ($tipo_perfil === "educador") {
        
        $_SESSION['educador_formacao'] = $usuario_completo['formacao'];
        $_SESSION['educador_instituicao'] = $usuario_completo['instituicaoEnsino'];
        $_SESSION['educador_statusConta'] = $usuario_completo['statusConta'];

        if ($usuario_completo['statusConta'] == "Pendente") {
            header('Location: ../login-cadastro.php?erro=contaPendente');
            exit();
        } else if ($usuario_completo['statusConta'] == "Rejeitado") {
            header('Location: ../login-cadastro.php?erro=contaRejeitado');
            exit();
        } else if ($usuario_completo['statusConta'] == "Aprovado") {
            header('Location: ../pages/painel_educador.php');
            exit();
        }
        
    } else if ($tipo_perfil === "responsavel") {
    
        $_SESSION['responsavel_alunoAssociado'] = $usuario_completo['nomeAlunoAssociado'];

        header('Location: ../pages/painel_responsavel.php');
        exit();

    }

} else {
    header('Location: ../login-cadastro.php?erro=login');
    exit();
}
?>