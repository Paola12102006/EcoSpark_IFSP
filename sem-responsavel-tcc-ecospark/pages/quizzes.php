<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.boxicons.com/3.0.8/fonts/filled/boxicons-filled.min.css" rel="stylesheet">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/brands/boxicons-brands.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/header-animado.css">
    <link rel="stylesheet" href="../src/css/reset.css">
    <link rel="stylesheet" href="../src/css/style-comum.css">
    <link rel="stylesheet" href="../src/css/quizzes.css">

    <title>Quizzes</title>
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
        <section class="secRay d-flex">

            <div class="imgRay">
                <img src="../src/imgs/ray-acenando.png" alt="imagem Ray acenando">

            </div>
        </section>

        <section class="section-quiz d-flex">
            <div class="quiz-box d-flex">

                <h2 class="title-quiz d-flex">

                    <div class="box-icone d-flex">
                        <img src="../src/imgs/icone-renovar.png" alt="Ícone de energia renovável" class="img-renovar"
                            width="100%">
                    </div>

                    <!-- <span>Quiz EcoSpark</span> -->
                    <strong>Teste seu conhecimento sobre Energia Limpa e Acessível!</strong>

                    <div class="box-icone d-flex">
                        <img src="../src/imgs/icone-renovar.png" alt="Ícone de energia renovável" class="img-renovar"
                            width="100%">
                    </div>

                    <!-- <img src="../src/imgs/raio.png" alt="Ícone de raio"> -->
                </h2>

                <p id="pergunta"></p>

                <!-- <button id="meuBotaoCorreto">Tocar Som</button>
                <button id="meuBotaoErrado">Tocar Som</button> -->

                <!-- A tag de áudio escondida, com o caminho para o seu arquivo -->
                <audio id="somDoBotaoCorreto" src="./src/audios/som-resposta-correta.mp3"></audio>
                <audio id="somDoBotaoErrado" src="./src/audios/som-resposta-errada.mp3"></audio>

                <div id="respostas" class="box-respostas d-flex"></div>

                <div class="box-btns-quiz d-flex">

                    <input type="button" value="Verificar resposta" onclick="verificarResposta()"
                        class="btn-quiz btn-verificar">

                    <input type="button" value="Próxima" onclick="proximaPergunta()"
                        class="btn-quiz btn-proxima-pergunta" disabled>

                    <!-- <button onclick="proximaPergunta()" class="btn-quiz btn-proxima-pergunta" disabled>Próxima</button> -->

                </div>
            </div>
        </section>
    </main>



</body>

</html>