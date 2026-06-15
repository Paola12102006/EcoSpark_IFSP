<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./src/imgs/raio.png" type="image/x-icon">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/style-comum.css">
    <link rel="stylesheet" href="./src/css/index.css">

    <title>ECOSPARK | Aprenda sobre Energia Limpa e Acessível!</title>
</head>
<body>

    <header class="header d-flex">
        <img src="./src/imgs/logo.png" alt="Logo do EcoSpark" class="logo">

        <nav class="navigation">
            <a href="./painel_previa.php" class="link-nav">Faça um Teste!</a>
        </nav>

        <button class="btn-login">
            <a href="./login-cadastro.php">LOGIN</a>
        </button>
    </header>

    <main class="main">
        <p class="slogan"><strong>Conecte-se com o futuro. Aprenda. Reflita. Faça a diferença.</strong></p>

        <div class="wrapper d-flex">
            <section class="secao d-flex amarelo">

                <img src="./src/imgs/ray-acenando.png" alt="Ícone da mascote Ray acenando." class="img-secao">

                <div class="box-txt d-flex">
                    <p class="saudacao">Bem Vindo ao EcoSpark!</p>

                    <p>Uma plataforma criada para despertar a consciência sobre a importância da energia limpa e sustentável no nosso dia a dia.</p>

                    <p>Inspirado pela ODS 7 — Energia Acessível e Limpa, nosso objetivo é transformar informação em ação, ajudando estudantes e visitantes a entenderem como pequenas escolhas podem gerar um grande impacto no futuro do planeta.</p>
                </div>

            </section>

            <section class="secao d-flex verde">

                <div class="box-txt d-flex">
                    <p>Aqui, você encontra conteúdos pensados para aprender de forma leve e interativa:</p>
                
                    <div class="container-conteudos d-flex">
                        
                        <div class="box-conteudo">
                            <img src="./src/imgs/icone-aulas.png" alt="Imagem de um pinguim com livros." class="icone-conteudo">
                            <p>Aulas simples para entender os conceitos essenciais.</p>
                        </div>

                        <div class="box-conteudo">
                            <img src="./src/imgs/icone-atvs.png" alt="Imagem de uma atividade escolar em família." class="icone-conteudo">
                            <p>Atividades para realizar em Família.</p>
                        </div>

                        <div class="box-conteudo">
                            <img src="./src/imgs/icone-quiz.png" alt="Imagem de uma menina e um ratinho em dúvida." class="icone-conteudo">
                            <p>Quizzes para testar seus conhecimentos.</p>
                        </div>

                    </div>

                </div>

                <!-- <img src="./src/imgs/icone-energia-limpa.png" alt="Imagem ilustrando uma aula sobre a ODS 7." class="img-secao"> -->
            </section>

            <section class="secao d-flex azul">
                <!-- <img src="./src/imgs/icone-livro.png" alt="Imagem ilustrativa de um livro sobre Energia Limpa." class="img-secao"> -->

                <img src="./src/imgs/icone-conhecimento.png" alt="Imagem ilustrativa de pessoas com elementos sobre Energia Limpa." class="img-secao">

                <div class="box-txt d-flex">
                    <p>Acreditamos que o conhecimento é o primeiro passo para a mudança.</p>

                    <p>Por isso, o <strong>EcoSpark</strong> foi criado para ser um espaço acessível, dinâmico e inspirador — onde aprender sobre sustentabilidade não é complicado, e sim motivador.</p>
                </div>

            </section>
        </div>

    </main>

    <?php include('./includes/footer.php'); ?>
</body>
</html>