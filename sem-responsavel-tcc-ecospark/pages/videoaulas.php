<?php
session_start();

require_once '../includes/autenticacao.php';
require '../logic/conectar_bd.php';

verificarAcesso(['estudante', 'educador', 'administrador']);

if ($_SESSION['usuario_perfil'] == 'estudante') {

    // Busca todas as videoaulas e verifica quais o aluno já assistiu
    $sql = "SELECT v.*,
        CASE 
            WHEN aa.id_aula IS NOT NULL THEN 1
            ELSE 0
        END AS assistida
    FROM videoaulas v
    LEFT JOIN aulas_assistidas aa ON v.id_va = aa.id_aula AND aa.id_aluno = ? ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['estudante_id']]);
    $videoaulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $vaAssistidas = [];
    $vaNaoAssistidas = [];

    foreach ($videoaulas as $aula) {
        if ($aula['assistida'] == 1) {
            $vaAssistidas[] = $aula;
        } else {
            $vaNaoAssistidas[] = $aula;
        }
    }
} else {
    $sql = " SELECT * FROM videoaulas; ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $videoaulas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

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
    <link rel="stylesheet" href="../src/css/videoaulas.css">

    <script defer src="../src/js/menu.js"></script>
    <script defer src="../src/js/abrirSecao.js"></script>

    <title>Videos Educativos | EcoSpark</title>
</head>

<body>

    <header class="header d-flex" id="inicio">
        <?php if ($_SESSION['usuario_perfil'] == 'estudante') { ?>

            <div class="container_menu d-flex">
                <div class="icone-menu d-flex" onclick="abrirMenu('conteudos', event)">
                    <i class="bx bx-menu-notification" title="Ícone de menu"></i>
                </div>

                <nav class="menu d-flex conteudos">
                    <a href="#sim" class="linkMenu">Assistidas</a>
                    <a href="#nao" class="linkMenu">Não assistidas</a>
                </nav>
            </div>
        <?php } ?>
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

    <main class="main">

        <a href="./painel_<?= $_SESSION['usuario_perfil'] ?>.php" class="link-voltar d-flex">
            <i class="bxf bx-reply-big icone" title="Voltar a página do estudante"></i>
            <span><strong>Voltar</strong></span>
        </a>

        <p class="slogan">Explore conteúdos educativos selecionados de diferentes plataformas e aprofunde seus conhecimentos sobre sustentabilidade.</p>

        <?php if ($_SESSION['usuario_perfil'] == 'estudante') { ?>

            <section class="sec assistidas" id="sim">

                <div class="subtitle d-flex" onclick="abrirSecaoConteudo('assistidas')">
                    <h2>Assistidas</h2>
                    <i class="bxf bx-caret-big-up seta-secao seta-assistidas"></i>
                </div>

                <div class="container-conteudo box-assistidas d-flex">

                    <?php foreach ($vaAssistidas as $videoaula):
                        $statusClasse = "realizado";
                    ?>

                        <a href="<?= $videoaula['link'] ?>" target="_blank" class="card-conteudo d-flex <?= $statusClasse ?>">

                            <figure class="fig-img-cont">
                                <img src="<?= $videoaula['thumb'] ?>" alt="<?= $videoaula['titulo'] ?>" class="img-cont video">
                                <figcaption>Ir para videoaula</figcaption>

                            </figure>

                            <div class="infos-va d-flex">
                                <p class="title-va d-flex"> <?= $videoaula['titulo'] ?> </p>

                                <table class="table-info">
                                    <tr>
                                        <td><strong>Vinculado por:</strong></td>
                                        <td><?= $videoaula['canal_de_vinculacao'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Faixa etária:</strong></td>
                                        <td>Maiores de <?= $videoaula['idade_recomendada'] ?></td>
                                    </tr>
                                </table>

                                <p class="title-descricao"><strong>Descrição</strong></p>
                                <div class="descricao"><?= $videoaula['descricao'] ?></div>
                            </div>
                        </a>

                    <?php endforeach; ?>

                </div>

                <p class="txt-abrir txt-assistidas" onclick="abrirSecaoConteudo('assistidas')">Mostrar mais</p>
            </section>

            <section class="sec nao-assistidas" id="nao">
                <div class="subtitle d-flex" onclick="abrirSecaoConteudo('nao-assistidas')">
                    <h2>Não Assistidas</h2>
                    <i class="bxf bx-caret-big-up seta-secao seta-nao-assistidas"></i>
                </div>

                <div class="container-conteudo box-nao-assistidas d-flex">

                    <?php foreach ($vaNaoAssistidas as $videoaula): $statusClasse = "pendente"; ?>

                        <div class="card-conteudo d-flex <?= $statusClasse ?>">
                            <form action="../logic/marcar_aula_assistida.php" method="POST" class="form-marcar d-flex">
                                <input type="hidden" name="id_aula" value="<?= $videoaula['id_va'] ?>">

                                <button type="submit"> Marcar como assistida </button>
                            </form>

                            <figure class="fig-img-cont">
                                <a href="<?= $videoaula['link'] ?>" target="_blank">
                                    <img src="<?= $videoaula['thumb'] ?>" alt="<?= $videoaula['titulo'] ?>" class="img-cont video">
                                    <figcaption>Ir para o vídeo</figcaption>
                                </a>
                            </figure>

                            <div class="infos-va d-flex">
                                <p class="title-va d-flex"> <?= $videoaula['titulo'] ?> </p>

                                <table class="table-info">
                                    <tr>
                                        <td><strong>Vinculado por:</strong></td>
                                        <td><?= $videoaula['canal_de_vinculacao'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Faixa etária:</strong></td>
                                        <td>Maiores de <?= $videoaula['idade_recomendada'] ?></td>
                                    </tr>
                                </table>

                                <p class="title-descricao"><strong>Descrição</strong></p>
                                <div class="descricao"><?= $videoaula['descricao'] ?></div>

                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>

                <p class="txt-abrir txt-nao-assistidas" onclick="abrirSecaoConteudo('nao-assistidas')">Mostrar mais</p>
            </section>

        <?php } else if ($_SESSION['usuario_perfil'] == 'educador') { ?>

        <section class="sec ">

                <ul>
                <?php foreach ($videoaulas as $va): ?>
                    <li><?= $va['titulo'] ?></li>
                <?php endforeach; ?>
            </ul>            
        </section>

            

        <?php } ?>

    </main>

    <?php include('../includes/footer.php'); ?>
    <?php include('../includes/vlibras.html'); ?>

</body>

</html>