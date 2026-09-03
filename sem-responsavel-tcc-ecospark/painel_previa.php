<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./src/imgs/raio.png" type="image/x-icon">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/style-comum.css">
    <link rel="stylesheet" href="./src/css/responsive.css">
    <link rel="stylesheet" href="./src/css/painel_previa.css">

    <script defer src="./src/js/quiz_previa.js"></script>

    <title>Teste seu Conhecimento! | EcoSpark</title>
</head>
<body>

    <header class="header d-flex" id="inicio">

        <img src="./src/imgs/logo.png" alt="Logo do EcoSpark" class="logo">

        <nav class="navigation">
            <a href="./index.php" class="link-nav"><i class="bx bx-reply-big"></i>&nbsp;&nbsp;Voltar a página inicial!</a>
        </nav>

        <a href="./login-cadastro.php" class="btn-login">LOGIN</a>
    </header>

    <main class="main d-flex">
        <p class="slogan">Aqui é só um gostinho!<br>Experimente uma amostra do nosso conteúdo e veja como aprender pode ser bem mais divertido.</p>

        <div class="card-previa d-flex">

            <div class="head-previa d-flex">
                <div class="box-icone d-flex"></div>

                <p class="txt">
                    <strong>Um quiz rápido pra você testar seus conhecimentos ao mesmo tempo que aprende!</strong>
                </p>

                <div class="box-icone d-flex"></div>
            </div>

            <button class="btn-iniciar" onclick="abrirQuiz()"><strong>Iniciar Quiz</strong></button>
        </div>

        <section class="secao-quiz d-flex fechado">
            <div class="divisao"></div>

            <div class="quiz-box d-flex">

                <h2 class="title-quiz d-flex">

                    <div class="box-icone d-flex">
                        <img src="./src/imgs/icone-renovar.png" alt="Ícone de energia renovável" class="img-renovar" width="100%">
                    </div>

                    <!-- <span>Quiz EcoSpark</span> -->
                     <strong>Teste seu conhecimento sobre Energia Limpa e Acessível!</strong>

                    <div class="box-icone d-flex">
                        <img src="./src/imgs/icone-renovar.png" alt="Ícone de energia renovável" class="img-renovar" width="100%">
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
                
                    <input type="button" value="Verificar resposta" onclick="verificarResposta()" class="btn-quiz btn-verificar">
                    
                    <input type="button" value="Próxima" onclick="proximaPergunta()" class="btn-quiz btn-proxima-pergunta" disabled>

                    <!-- <button onclick="proximaPergunta()" class="btn-quiz btn-proxima-pergunta" disabled>Próxima</button> -->

                </div>
            </div>

        </section>        
    </main>

    <?php include('./includes/footer.php'); ?>

    <?php include('./includes/vlibras.html'); ?>
    
</body>
</html>