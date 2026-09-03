<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./src/imgs/raio.png" type="image/x-icon">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/responsive.css">
    <link rel="stylesheet" href="./src/css/login-cadastro.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="./src/js/login_cadastro.js"></script>

    <title>Login e Cadastro | EcoSpark</title>
</head>
<body>

    <?php 
    
        if (isset($_GET['erro'])) { 
            $mensagem = '';
            $icone = 'error';

            if ($_GET['erro'] == 'login') {
                $mensagem = 'Usuário ou senha inválidos. Tente novamente.';
            } else if ($_GET['erro'] == 'acesso_negado') {
                $mensagem = 'Você não tem permissão para acessar essa página.';
                $icone = 'warning';
            } else if ($_GET['erro'] == 'contaPendente') {
                $mensagem = 'Sua conta de educador ainda está aguardando aprovação.';
                $icone = 'warning';
            } else if ($_GET['erro'] == 'contaRejeitado') {
                $mensagem = 'Sua solicitação de educador foi rejeitada.<br><br>Motivo: Informações insuficientes para comprovar vínculo educacional.';
                $icone = 'warning';
            }
            else if ($_GET['erro'] == 'email') {
                $mensagem = 'Esse email já está cadastrado! Faça login ou utilize outro endereço de e-mail.';
                $icone = 'warning';
            }
            
            else {
                $mensagem = 'É necessário fazer login para acessar o sistema.';
            }
            
            echo "<script>";
            echo "Swal.fire({icon: '{$icone}', title: 'Erro!', html: " . json_encode($mensagem) . ", confirmButtonText: 'OK', customClass: {confirmButton: 'btn-erro'}});";
            echo "</script>";
        }

        if (isset($_GET['cadastro'])) {
            $mensagem_sucesso = '';

            if ($_GET['cadastro'] == 'sucesso') {
                $mensagem_sucesso = "Você se cadastrou com sucesso!";
            } else if ($_GET['cadastro'] == 'sucessoEducador') {
                $mensagem_sucesso = "Conta cadastrada com sucesso!<br><br>Seu cadastro de educador está aguardando aprovação de um administrador. Você receberá acesso às funcionalidades de educador após a análise.";
            }

            echo "<script>";
            echo "Swal.fire({icon: 'success', title: 'Sucesso!', html: " . json_encode($mensagem_sucesso) . ", customClass: {confirmButton: 'btn-sucesso'} });";
            echo "</script>";
        }
    ?>

    <section class="secao-img-link d-flex">
        <a href="./index.php" title="Voltar pra Página Inicial" class="link-home d-flex">
            <img src="./src/imgs/energia.png" alt="Ícone de energia limpa." class="img-link" width="100%">
        </a>

        <div class="container-img-link d-flex">
            <img src="./src/imgs/ray-acenando.png" alt="Imagem da mascote Ray acenando." class="img-ray">
            <p>Conecte-se com o futuro.<br>Aprenda. Reflita. Faça a diferença.</p>
        </div>
    </section>

    <section class="secao-forms d-flex">

        <div class="wrapper d-flex">

            <div class="form-box login d-flex">

                <img src="./src/imgs/logo.png" alt="Logo do EcoSpark" class="logo">

                <div class="head-form d-flex">
                    <h1>Bem Vindo de Volta!</h1>
                    <p>Vamos continuar nossa aventura pela energia limpa!</p>
                </div>

                <form action="./logic/verificar_login.php" method="POST" class="form form-login d-flex">

                    <label for="email-login">
                        <span>Email</span>

                        <div class="box-input d-flex">
                            <i class="bx bx-user d-flex"></i>

                            <input type="email" id="email-login" name="email-login" required>
                        </div>
                    </label>

                    <label for="senha-login">
                        <div class="box-senha d-flex">
                            <span>Senha</span>
                            <span class="link">Esqueceu a senha?</span>
                        </div>

                        <div class="box-input d-flex">

                            <button type="button" id="btn-senha" title="Mostrar senha" aria-label="Mostrar senha" onclick="mostrarSenha('login')">
                                <i class="bx bx-eye icon-senha login"></i>
                            </button>

                            <input type="password" id="senha-login" name="senha-login" required>
                        </div>
                    </label>

                    <input type="submit" value="Entrar" class="btn btn-login">
                </form>

                <p class="txt">Ainda não tem uma conta? <span class="link cadastrar-link"><strong>Cadastre-se Aqui!</strong></span></p>
            </div>

            <div class="form-box cadastrar d-flex">

                <header class="cont-title d-flex">
                    <img src="./src/imgs/logo.png" alt="Logo do EcoSpark" class="logo">

                    <div class="head-form d-flex">
                        <h1>Crie uma Conta!</h1>
                        <p>Venha se aventurar pela energia limpa!</p>
                    </div>
                </header>

                <form action="./logic/cadastrar_user.php" method="post" class="form form-cadastrar d-flex">
                    <label for="nomeCompleto" class="lbl">
                        <span>Nome Completo</span>
                        <div class="box-input d-flex">
                            <i class="bx bx-user icone d-flex"></i>

                            <input type="text" id="nomeCompleto" name="nomeCompleto" class="input-txt" required>
                        </div>
                    </label>

                    <label for="email-cadastro" class="lbl">
                        <span>E-mail</span>
                        <div class="box-input d-flex">
                            <i class="bx bx-envelope icone d-flex"></i>
                            <input type="email" id="email-cadastro" name="email-cadastro" class="input-txt" required>
                        </div>
                    </label>

                    <div class="lbls-cadastro d-flex">

                        <label for="dataNasc">
                            <span>Data de nascimento</span>
                            <div class="box-input d-flex">
                                <i class="bx bx-calendar-alt icone d-flex"></i>
                                <input type="date" id="dataNasc" name="dataNasc" placeholder="Ex: dd/mm/aaaa" class="inp-200" required>
                            </div>
                        </label>

                        <label for="telefone">
                            <span>Telefone</span>
                            <div class="box-input d-flex">
                                <i class="bx bx-phone icone d-flex"></i>
                                <input type="tel" id="telefone" name="telefone" placeholder="Ex: (19) 9999-9999" class="inp-200">
                            </div>
                        </label>

                    </div>

                    <div class="lbls-cadastro d-flex">
                        <label for="senha-cadastro">
                            <span>Senha <span class="txt-apoio">(min 6 caracteres)</span></span>
                            <div class="box-input d-flex">
                                <!-- <i class="bx bx-low-vision icone d-flex"></i> -->
                                <button type="button" id="btn-senha" title="Mostrar senha" aria-label="Mostrar senha" onclick="mostrarSenha('cadastro')">
                                    <i class="bx bx-eye icon-senha cadastro"></i>
                                </button>

                                <input type="password" id="senha-cadastro" name="senha-cadastro" class="inp-200" required>
                            </div>
                        </label>

                        <label for="acesso" class="lbl-selecao d-flex">
                            <span>O que você é?</span>

                            <select name="opc-acesso" id="opc-acesso" required>
                                <option value="" disabled selected>Acesso de:</option>
                                <option value="estudante">Estudante</option>
                                <option value="educador">Educador</option>
                            </select>
                        </label>
                    </div>

                    <div class="box-atributos-adicionais d-flex">

                        <div class="atributos estudante">
                            
                            <label for="serieEscolar" class="lbl">
                                <span>Série <span class="txt-apoio">(Ex: 1º ano, Ensino Médio)</span></span>
                                <input type="text" id="serieEscolar" class="input-txt" name="serieEscolar">
                            </label>

                            <label for="escola" class="lbl">
                                <span>Escola</span>
                                <input type="text" id="escola" class="input-txt" name="escola">
                            </label>

                        </div>

                        <div class="atributos educador">

                            <label for="formacao" class="lbl">
                                <span>Formação</span>
                                <input type="text" id="formacao" name="formacao" class="input-txt">
                            </label>

                            <label for="instituicaoEnsino" class="lbl">
                                <span>Instituição de Ensino</span>
                                <input type="text" id="instituicaoEnsino" name="instituicaoEnsino" class="input-txt">
                            </label>

                        </div>

                    </div>

                    <div id="title-avatares" class="d-flex">
                        <span>Escolha um Avatar</span>

                        <i class="bx bx-caret-big-up seta d-flex"></i>
                    </div>

                    <div class="box-avatares d-flex">

                        <div class="sec-avatares d-flex">
                            <input type="radio" name="avatar" id="avatar-abelha" value="abelha" hidden required>
                            <label for="avatar-abelha">
                                <img src="./src/imgs/avatares/abelha.png" alt="Avatar: Abelha" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-arraia" value="arraia" hidden required>
                            <label for="avatar-arraia">
                                <img src="./src/imgs/avatares/arraia.png" alt="Avatar: Arraia" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-beija-flor" value="beija-flor" hidden required>
                            <label for="avatar-beija-flor">
                                <img src="./src/imgs/avatares/beija-flor.png" alt="Avatar: Beija-Flor" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-castor" value="castor" hidden required>
                            <label for="avatar-castor">
                                <img src="./src/imgs/avatares/castor.png" alt="Avatar: Castor" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-golfinho" value="golfinho" hidden required>
                            <label for="avatar-golfinho">
                                <img src="./src/imgs/avatares/golfinho.png" alt="Avatar: Golfinho" class="img-avatar">
                            </label>
                        </div>

                        <div class="sec-avatares d-flex">
                            <input type="radio" name="avatar" id="avatar-lobo-guara" value="lobo-guara" hidden required>
                            <label for="avatar-lobo-guara">
                                <img src="./src/imgs/avatares/lobo-guara.png" alt="Avatar: Lobo-guará" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-lontra" value="lontra" hidden required>
                            <label for="avatar-lontra">
                                <img src="./src/imgs/avatares/lontra.png" alt="Avatar: Lontra" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-peixe-boi" value="peixe-boi" hidden required>
                            <label for="avatar-peixe-boi">
                                <img src="./src/imgs/avatares/peixe-boi.png" alt="Avatar: Peixe-Boi" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-pinguim" value="pinguim" hidden required>
                            <label for="avatar-pinguim">
                                <img src="./src/imgs/avatares/pinguim.png" alt="Avatar: Pinguim" class="img-avatar">
                            </label>

                            <input type="radio" name="avatar" id="avatar-tartaruga-marinha" value="tartaruga-marinha"
                                hidden required>
                            <label for="avatar-tartaruga-marinha">
                                <img src="./src/imgs/avatares/tartaruga-marinha.png" alt="Avatar: Tartaruga-Marinha"
                                    class="img-avatar">
                            </label>
                        </div>

                    </div>

                    <input type="submit" value="Cadastrar" class="btn btn-cadastro">
                </form>

                <p class="txt">Já tem uma conta? <span class="link login-link"><strong>Faça Login!</strong></span></p>

            </div>
        </div>

    </section>


    <?php include('./includes/vlibras.html'); ?>
</body>
</html>