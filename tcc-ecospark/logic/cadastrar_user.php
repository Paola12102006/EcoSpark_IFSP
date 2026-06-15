<?php

// NÃO TERMINEIIIIIIIIIIIIIIIIIIII

require './conectar_bd.php';

    $nome = $_POST['nomeCompleto'];
    $email = $_POST['email-cadastro'];
    $senha = $_POST['senha-cadastro'];
    $dataNasc = $_POST['dataNasc'];
    $telefone = $_POST['telefone'];
    $avatar = $_POST['avatar'];
    $tipoUsuario = $_POST['opc-acesso'];
    

    $atributosGerais = "INSERT INTO usuarios (nomeCompleto, email, senha, dataNascimento, telefone, avatar, tipoUsuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

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
        $nomeResponsavelAssociado = $_POST['nomeResponsavel'];

        $sql = "INSERT INTO estudante (idUsuario, serie, escola, nomeResponsavelAssociado) VALUES (?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $idUsuario,
            $serie,
            $escola,
            $nomeResponsavelAssociado
        ]);

        header("Location: login.php?cadastro=sucesso");
        exit();
    }

    if ($tipoUsuario == "educador") {

        $formacao = $_POST['formacao'];
        $instituicao = $_POST['instituicao'];

        $sql = "INSERT INTO educador (idUsuario, formacao, instituicaoEnsino) VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $idUsuario,
            $formacao,
            $instituicao
        ]);

        header("Location: login.php?cadastro=sucessoEducador");
        exit();
    }

    if ($tipoUsuario == "responsavel") {

        $nomeAlunoAssociado = $_POST['nomeAluno'];

        $sql = "INSERT INTO responsavel (idUsuario, nomeAlunoAssociado) VALUES (?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $idUsuario,
            $nomeAlunoAssociado
        ]);
    }


?>