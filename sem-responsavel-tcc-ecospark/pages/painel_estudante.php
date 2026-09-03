<?php

session_start();

require_once '../includes/autenticacao.php';
require '../logic/conectar_bd.php';

verificarAcesso(['estudante', 'administrador']);

$sqlEstudante = "SELECT id_estudante FROM estudante WHERE idUsuario = ?";
$stmtEstudante = $pdo->prepare($sqlEstudante);
$stmtEstudante->execute([$_SESSION['usuario_id']]);

$idEstudante = $stmtEstudante->fetchColumn();

$sql = "SELECT a.*,
        CASE 
            WHEN c.idComprovacao IS NOT NULL THEN 'Realizado'
            ELSE 'Pendente'
        END AS status_estudante
    FROM atividades a
    LEFT JOIN comprovacoes c 
        ON c.idAtividade = a.id_atividades
        AND c.idEstudante = ? ";

$stmt = $pdo->prepare($sql);
$stmt->execute([$idEstudante]);

$atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../src/imgs/raio.png" type="image/x-icon">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../src/css/reset.css">
    <link rel="stylesheet" href="../src/css/style-comum.css">
    <link rel="stylesheet" href="../src/css/header-animado.css">
    <link rel="stylesheet" href="../src/css/painel_estudante.css">

    <script defer src="../src/js/menu.js"></script>
    <script defer src="../src/js/painel_estudante.js"></script>
    <script defer src="../src/js/abrirSecao.js"></script>

    <title>Página Estudante | EcoSpark</title>
</head>
<body>

    <header class="header d-flex" id="inicio">

        <div class="container_menu d-flex">
            <div class="icone-menu d-flex" onclick="abrirMenu('conteudos', event)">

                <i class="bx bx-menu-notification" title="Ícone de menu"></i>
            </div>

            <nav class="menu d-flex conteudos">
                <a href="#div-atvs" class="linkMenu">Atividades</a>
                <a href="./videoaulas.php" target="_blank" class="linkMenu">Vídeo-Aulas</a>

            </nav>
        </div>

        <span class="title">ECOSPARK</span>

        <div class="container_menu d-flex">
            <img src="../src/imgs/avatares/<?= $_SESSION['usuario_avatar'] ?>.png"
                alt="Avatar: <?= $_SESSION['usuario_avatar'] ?>" class="avatar" onclick="abrirMenu('perfil', event)">

            <nav class="menu d-flex perfil">
                <a href="./perfil_usuario.php" class="linkMenu">Perfil</a>
                <a href="../logic/logout.php" class="linkMenu">Logout</a>
            </nav>
        </div>
    </header>

    <main class="main d-flex">
        <section class="secao sec-conteudos d-flex">

            <div class="box-saudacao">
                <h3 class="saudacao">Olá, <?= explode(' ', $_SESSION['usuario_nome'])[0] ?>! 👋</h3>
                <p style="opacity: .8;"><?= $_SESSION['usuario_email'] ?></p>
            </div>

            <div class="box-conteudo atividades" id="div-atvs">

                <div class="subtitle d-flex" onclick="abrirSecaoConteudo('atividades')">
                    <h2>Atividades</h2>
                    <i class="bxf bx-caret-big-up seta-secao seta-atividades"></i>
                </div>

                <div class="container-conteudo box-atividades d-flex">

                    <?php foreach ($atividades as $atividade):
                        if ($atividade['status_estudante'] == "Realizado") {
                            $statusClasse = "realizado";
                        } else {
                            $statusClasse = "pendente";
                        }
                    ?>

                    <a href="./atividades.php?id=<?= $atividade['id_atividades'] ?>" class="card-conteudo d-flex <?= $statusClasse ?>">
                        <figure class="fig-img-cont">
                            <img src="../src/imgs/img-atividades/<?= $atividade['imagem'] ?>" alt="<?= $atividade['titulo'] ?>" class="img-cont">
                            <figcaption>Ir para atividade</figcaption>
                        </figure>

                        <p class="title-atv d-flex">
                            <?= $atividade['titulo'] ?>
                        </p>

                        <div class="status-conteudo d-flex">
                            <p class="status d-flex atv realizado">Concluída</p>
                                
                            <p class="status d-flex atv pendente">Pendente</p>
                        </div>
                    </a>

                    <?php endforeach; ?>

                </div>

                <p class="txt-abrir txt-atividades" onclick="abrirSecaoConteudo('atividades')">Mostrar mais</p>
            </div>

        </section>

        <section class="secao sec-conquistas d-flex">

            <div class="cabecalho-conquistas">
                <h2 class="title_conquistas">Conquistas</h2>
                <h3>Conquiste os outros emblemas!</h3>
            </div>

            <ul class="lista_conquistas">

                <li class="conquista-quiz">

                    <div class="titulo-atv" onclick="abrirQuizConquista('id1', this)">
                        <h2>Construção de um Forno Solar</h2>

                        <i class="bxf bx-caret-big-up seta-conquista id1"></i>
                    </div>

                    <div class="niveis-quiz id1">

                        <div class="nivel-conquista d-flex">

                            <h3 class="titulo-quiz">Nível 1 - Forno Solar para Iniciantes</h3>

                            <div class="box-emblemas d-flex">

                                <img src="../src/imgs/medalhas/medalha-ouro.png" alt="Medalha de ouro" class="emblema ativa">

                                <img src="../src/imgs/medalhas/medalha-prata.png" alt="Medalha de prata" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-bronze.png" alt="Medalha de bronze" class="emblema opaca">
                        
                            </div>

                        </div>

                        <div class="nivel-conquista d-flex">

                            <h3 class="titulo-quiz">Nível 2 - Desafio do Forno Solar</h3>

                            <div class="box-emblemas d-flex">

                                <img src="../src/imgs/medalhas/medalha-ouro.png" alt="Medalha de ouro" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-prata.png" alt="Medalha de prata" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-bronze.png" alt="Medalha de bronze" class="emblema ativa">
                        
                            </div>

                        </div>

                        <div class="nivel-conquista d-flex" style="padding-bottom: 15px;">

                            <h3 class="titulo-quiz">Nível 3 - Especialista em Forno Solar</h3>

                            <div class="box-emblemas d-flex">

                                <img src="../src/imgs/medalhas/medalha-ouro.png" alt="Medalha de ouro" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-prata.png" alt="Medalha de prata" class="emblema ativa">

                                <img src="../src/imgs/medalhas/medalha-bronze.png" alt="Medalha de bronze" class="emblema opaca">
                        
                            </div>

                        </div>

                    </div>

                </li>

                <li class="conquista-quiz">

                    <div class="titulo-atv" onclick="abrirQuizConquista('id2', this)">
                        <h2>Cata-vento de Papel</h2>

                        <i class="bxf bx-caret-big-up seta-conquista id2"></i>
                    </div>

                    <div class="niveis-quiz id2">

                        <div class="nivel-conquista d-flex">

                            <h3 class="titulo-quiz">Nível 1 - Conhecendo as Energias Renováveis</h3>

                            <div class="box-emblemas d-flex">

                                <img src="../src/imgs/medalhas/medalha-ouro.png" alt="Medalha de ouro" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-prata.png" alt="Medalha de prata" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-bronze.png" alt="Medalha de bronze" class="emblema opaca">
                        
                            </div>

                        </div>

                        <div class="nivel-conquista d-flex">

                            <h3 class="titulo-quiz">Nível 2 - Desafio das Fontes Renováveis</h3>

                            <div class="box-emblemas d-flex">

                                <img src="../src/imgs/medalhas/medalha-ouro.png" alt="Medalha de ouro" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-prata.png" alt="Medalha de prata" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-bronze.png" alt="Medalha de bronze" class="emblema opaca">
                        
                            </div>

                        </div>

                        <div class="nivel-conquista d-flex" style="padding-bottom: 15px;">

                            <h3 class="titulo-quiz">Nível 3 - Mestre das Energias Renováveis</h3>

                            <div class="box-emblemas d-flex">

                                <img src="../src/imgs/medalhas/medalha-ouro.png" alt="Medalha de ouro" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-prata.png" alt="Medalha de prata" class="emblema opaca">

                                <img src="../src/imgs/medalhas/medalha-bronze.png" alt="Medalha de bronze" class="emblema opaca">
                        
                            </div>

                        </div>

                    </div>

                </li>


            </ul>

        </section>
    </main>

    <?php include('../includes/footer.php'); ?>
    <?php include('../includes/vlibras.html'); ?>

</body>
</html>