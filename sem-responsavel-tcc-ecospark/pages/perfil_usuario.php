<?php
session_start();

require '../logic/conectar_bd.php';

require_once '../includes/autenticacao.php';
verificarAcesso(['administrador', 'estudante', 'educador']);

$linkVoltar = "../index.php?erro=acesso_negado";
$dado1 = "";
$dado2 = "";

if ($_SESSION['usuario_perfil'] == "estudante") {
    $linkVoltar = "./painel_estudante.php";

    $dado1 = "<strong>Série:</strong> {$_SESSION['estudante_serie']}";
    $dado2 = "<strong>Escola:</strong> {$_SESSION['estudante_escola']}";

} else if ($_SESSION['usuario_perfil'] == "educador") {
    $linkVoltar = "./painel_educador.php";

    $dado1 = "<strong>Formação:</strong> {$_SESSION['educador_formacao']}";
    $dado2 = "<strong>Instituição de Ensino:</strong> {$_SESSION['educador_instituicao']}";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../src/imgs/raio.png" type="image/x-icon">

    <link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/brands/boxicons-brands.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../src/css/reset.css">
    <link rel="stylesheet" href="../src/css/style-comum.css">
    <link rel="stylesheet" href="../src/css/perfil.css">

    <title>Perfil - <?= $_SESSION['usuario_nome'] ?> | EcoSpark</title>
</head>

<body class="d-flex">

    <header class="head d-flex" id="inicio">

        <div class="box-icones d-flex">
            <a href="<?= $linkVoltar ?>">
                <div class="container d-flex">
                    <i class="bxf bx-reply-big icone" title="Voltar a página do estudante"></i>
                    <span>Voltar</span>
                </div>
            </a>

            <a href="../logic/logout.php">
                <div class="container d-flex">
                    <i class="bxf bx-door-open-alt icone" title="Sair do EcoSpark"></i>
                    <span>Logout</span>
                </div>
            </a>
        </div>

        <div>
            <h1>Bem Vindo ao seu Perfil!</h1>
            <p class="txt">Aqui você pode conferir e alterar os seus dados cadastrados.</p>
        </div>

    </header>

    <main class="main d-flex">

        <div class="box-head d-flex">
            <img src="../src/imgs/avatares/<?= $_SESSION['usuario_avatar'] ?>.png" alt="Avatar: <?= $_SESSION['usuario_avatar'] ?>" class="avatar icon">

            <p class="nome"><?= $_SESSION['usuario_nome'] ?></p>

            <a href="" title="Editar dados pessoais">
                <div class="icon-editar">
                    <i class="bxf bx-edit icon"></i>
                    <p>Editar dados</p>
                </div>
            </a>
        </div>

        <h2 class="subtitle">Dados Pessoais</h2>

        <div class="wrapper d-flex">

            <div class="box-dados d-flex">
                <p class="dado direito"><i class="bxl bx-bun"></i> <strong>Email:</strong> <?= $_SESSION['usuario_email'] ?></p>
                <p class="dado esquerdo"><i class="bxl bx-bun"></i> <strong>Senha:</strong> ••••••••</p>
            </div>

            <div class="box-dados d-flex">
                <p class="dado direito"><i class="bxl bx-bun"></i> <strong>Telefone:</strong> <?= $_SESSION['usuario_tel'] ?></p>
                <p class="dado esquerdo"><i class="bxl bx-bun"></i> <strong>Data de Nascimento:</strong> <?= (new DateTime($_SESSION['usuario_nascimento']))->format('d/m/Y') ?></p>
            </div>

            <div class="box-dados d-flex">
                <p class='dado direito'><i class="bxl bx-bun"></i> <?= $dado1 ?></p>
                <p class='dado esquerdo'><i class="bxl bx-bun"></i> <?= $dado2 ?></p>
            </div>

        </div>

    </main>

    <?php include('../includes/footer.php'); ?>
    
    <?php include('../includes/vlibras.html'); ?>

</body>
</html>