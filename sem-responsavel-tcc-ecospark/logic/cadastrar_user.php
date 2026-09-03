<?php
require './conectar_bd.php';

    $nome = $_POST['nomeCompleto'];
    $email = $_POST['email-cadastro'];
    $senha = $_POST['senha-cadastro'];
    $dataNasc = $_POST['dataNasc'];
    $telefone = $_POST['telefone'];
    $avatar = $_POST['avatar'];
    $tipoUsuario = $_POST['opc-acesso'];
    
    $sql = "SELECT id_usuario FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        header("Location: ../login-cadastro.php?erro=email");
        exit();
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $atributosGerais = "INSERT INTO usuarios (nomeCompleto, email, senha, dataNascimento, telefone, avatar, tipoUsuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($atributosGerais);

    $stmt->execute([
        $nome,
        $email,
        $senha_hash,
        $dataNasc,
        $telefone,
        $avatar,
        $tipoUsuario
    ]);

    $idUsuario = $pdo->lastInsertId();

    if ($tipoUsuario == "estudante") {

        $serie = $_POST['serieEscolar'];
        $escola = $_POST['escola'];

        $sql = "INSERT INTO estudante (idUsuario, serie, escola) VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $idUsuario,
            $serie,
            $escola
        ]);

        header("Location: ../login-cadastro.php?cadastro=sucesso");
        exit();
    }

    if ($tipoUsuario == "educador") {

        $formacao = $_POST['formacao'];
        $instituicao = $_POST['instituicaoEnsino'];

        $sql = "INSERT INTO educador (idUsuario, formacao, instituicaoEnsino, statusConta) VALUES (?, ?, ?, 'Pendente')";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $idUsuario,
            $formacao,
            $instituicao
        ]);

        header("Location: ../login-cadastro.php?cadastro=sucessoEducador");
        exit();
    }

?>