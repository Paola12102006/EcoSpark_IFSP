<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

require_once '../includes/autenticacao.php';
require '../logic/conectar_bd.php';

verificarAcesso(['estudante', 'administrador']);

$idAtv = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$sqlAtv = "SELECT * FROM atividades WHERE id_atividades = ?";
$stmtAtv = $pdo->prepare($sqlAtv);
$stmtAtv->execute([$idAtv]);

$atividade = $stmtAtv->fetch(PDO::FETCH_ASSOC);

$listaMateriais = explode(";", $atividade['materiais']);
$listaPassos = explode(";", $atividade['instrucoes']);

$sqlQuizzes = "SELECT * FROM quizzes WHERE idAtv_correspondente = ?";
$stmtQuizzes = $pdo->prepare($sqlQuizzes);
$stmtQuizzes->execute([$idAtv]);

$quizzes = $stmtQuizzes->fetchAll(PDO::FETCH_ASSOC);

$sqlEstudante = "SELECT id_estudante FROM estudante WHERE idUsuario = ?";
$stmtEstudante = $pdo->prepare($sqlEstudante);
$stmtEstudante->execute([$_SESSION['usuario_id']]);

$idEstudante = $stmtEstudante->fetchColumn();

require '../includes/envio-comprovacao-atv.php';

$perfilUser = $_SESSION['usuario_perfil'];
$linkVoltar = "../index.php?erro=acesso_negado";

if ($perfilUser == "estudante") {
    $linkVoltar = "./painel_estudante.php";
} else if ($perfilUser == "administrador") {
    $linkVoltar = "../admin/painel_admin.php";
}

if ($comprovacao) {
    $statusClasse = "realizado";
} else {
    $statusClasse = "pendente";
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
    <link rel="stylesheet" href="../src/css/pag-conteudo.css">

    <script defer src="../src/js/pag_conteudo.js"></script>

    <title><?= $atividade['titulo'] ?> | EcoSpark</title>
</head>
<body class="d-flex">

    <header class="head d-flex" id="inicio">
        <img src="../src/imgs/logo.png" alt="Logo do EcoSpark" class="logo">

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
    </header>

    <h1 class="title"><?= $atividade['titulo'] ?></h1>

    <main class="d-flex">
        <div class="box-main d-flex">

            <section class="secao1 d-flex">
                <img src="../src/imgs/img-atividades/<?= $atividade['imagem'] ?>" alt="Imagem representando a atividade"
                    class="img-conteudo">

                <div class="box-dados d-flex">
                    <div class="info d-flex">
                        <span><strong>Status:</strong></span>
                        <div class="box-status d-flex <?= $statusClasse ?>">
                            <div class="bolinha <?= $statusClasse ?>"></div>
                            <span class="txt <?= $statusClasse ?>" style="text-transform: capitalize;">&nbsp;&nbsp;<?= $statusClasse ?></span>
                        </div>
                    </div>

                    <h2 class="subtitle">Descrição</h2>
                    <div class="descricao">
                        <?= $atividade['descricao'] ?>
                    </div>
                </div>
            </section>

            <section class="secao2 d-flex">

                <div class="wrapper d-flex">
                    <h2 class="subtitle">Materiais</h2>

                    <ul class="lista d-flex">
                        <?php foreach ($listaMateriais as $material): ?>

                            <li class="item d-flex">
                                <i class="bxl bx-bun"></i>
                                <?= $material ?> <?= !str_ends_with($material, '.') ? ';' : '' ?>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="wrapper d-flex">
                    <h2 class="subtitle">Instruções</h2>

                    <ul class="lista d-flex">

                        <?php foreach ($listaPassos as $passo): ?>

                            <li class="item d-flex">
                                <i class="bxl bx-bun"></i>
                                <?= $passo ?> <?= !str_ends_with($passo, '.') ? ';' : '' ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>
                </div>

            </section>

            <section class="secao3 d-flex">
                <h2 class="subtitle">Envio de Comprovação</h2>

                <div class="btns-envio d-flex">
                    <?php if ($comprovacao): ?>
                        <div class="btn-envio editar btn-acao" onclick="boxEnvio('form-add')">Editar envio</div>
                        <div class="btn-envio remover btn-acao" onclick="boxEnvio('form-excluir')">Remover envio</div>
                    <?php else: ?>
                        <div class="btn-envio azul" onclick="boxEnvio('form-add')">Adicionar envio</div>
                    <?php endif; ?>
                </div>

                <div class="box-envio d-flex"> <!-- tabela, formulário ou popup de exclusão -->

                    <table class="tabela-envio div-envio">
                        <tr class="td-impar">
                            <td><strong>Status de Envio</strong></td>
                            <td> <?= $comprovacao ? "Enviado para avaliação" : "Nenhum arquivo foi enviado ainda" ?> </td>
                        </tr>

                        <!-- <tr class="td-par">
                            <td><strong>Status da Avaliação</strong></td>
                            <td> <?= $comprovacao ? htmlspecialchars($comprovacao['status']) : "-" ?> </td>
                        </tr> -->

                        <!-- <tr class="td-impar">
                            <td><strong>Tempo restante</strong></td>
                            <td> <?= htmlspecialchars($textoTempo) ?> </td>
                        </tr> -->

                        <tr class="td-par">
                            <td><strong>Arquivos enviados</strong></td>
                            <td>
                                <?php if ($comprovacao): ?>

                                    <a href="../src/uploads/comprovacoes/<?= rawurlencode($comprovacao['arquivo']) ?>" target="_blank" rel="noopener noreferrer">
                                        📄 <?= htmlspecialchars($comprovacao['nomeOriginal'] ?: $comprovacao['arquivo']) ?>
                                    </a>
                                <?php else: echo "Nenhum arquivo enviado"; endif; ?>
                            </td>
                        </tr>
                    </table>

                    <form method="POST" enctype="multipart/form-data" class="div-envio form-add d-flex esconder">
                        <input type="hidden" name="acao" value="salvar">

                        <div class="container-add">
                            <div class="form-header">
                                <span><strong>📁 Arquivos</strong></span>
                            </div>

                            <label for="comprovacao" class="area-upload">
                                <div class="icone-upload">↓</div>
                                <p>Você pode arrastar e soltar arquivos aqui para adicioná-los.</p>
                                <span>ou clique para selecionar um arquivo</span>
                            </label>

                            <input type="file" name="comprovacao" id="comprovacao" accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <div class="btns-envio d-flex">
                            <input type="submit" value="Salvar" class="btn-envio azul">
                            <div class="btn-envio" onclick="boxEnvio('tabela-envio')">Cancelar</div>
                        </div>
                    </form>

                    <form method="POST" class="div-envio form-excluir d-flex esconder">
                        <input type="hidden" name="acao" value="excluir">

                        <div class="form-header">
                            <span><strong>🗑️ Confirmar</strong></span>
                        </div>

                        <p>Tem certeza de que deseja excluir esse envio, permanentemente?</p>

                        <div class="btns-envio d-flex excluir">
                            <div class="btn-envio" onclick="boxEnvio('tabela-envio')">Cancelar</div>
                            <input type="submit" value="Continuar" class="btn-envio azul">
                        </div>
                    </form>

                </div>

            </section>
        </div>

        <!-- QUIZZESSSSSSSSSSSSSS -->

        <div class="box-main d-flex">
            <h1 class="title">Quizzes</h1>

            <div class="container-quizzes d-flex">

                <!-- <a href="./quizzes.php">Página Quizzes</a> -->

                <?php foreach ($quizzes as $quiz): ?>

                    <div class="cont-quiz d-flex">

                        <div class="nivel-quiz <?= $quiz['dificuldade'] ?>">
                            <?php
                                if ($quiz['dificuldade'] == "facil") {
                                    echo "Fácil";
                                } else if ($quiz['dificuldade'] == "medio") {
                                    echo "Médio";
                                } else if ($quiz['dificuldade'] == "dificil") {
                                    echo "Difícil";
                                }
                            ?>
                        </div>

                        <a href="./quizzes.php?id=<?= $quiz['id_quiz'] ?>" class="quiz d-flex <?= $quiz['dificuldade'] ?>">

                            <h2 class="titulo-quiz">
                                <?= htmlspecialchars($quiz['titulo']) ?>
                            </h2>

                            <table class="table-tentativas">
                                <thead>
                                    <tr>
                                        <th>Tentativa</th>
                                        <th>Pontuação</th>
                                    </tr>
                                </thead>

                                <?php for ($i = 1; $i <= $quiz['max_tentativas']; $i++): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>0 - 10</td>
                                    </tr>
                                <?php endfor; ?>

                            </table>

                            <div class="descricao-quiz d-flex">
                                <h3>Descrição</h3>

                                <div class="descricao">
                                    <?= htmlspecialchars($quiz['descricao']) ?>
                                </div>
                            </div>
                        </a>

                    </div>

                <?php endforeach; ?>
            </div>
        </div>


    </main>

    <?php include('../includes/footer.php'); ?>
    <?php include('../includes/vlibras.html'); ?>
</body>
</html>