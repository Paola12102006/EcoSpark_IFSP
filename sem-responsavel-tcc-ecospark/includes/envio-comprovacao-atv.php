<?php

$sqlComprovacao = "SELECT * FROM comprovacoes WHERE idAtividade = ? AND idEstudante = ?";
$stmtComprovacao = $pdo->prepare($sqlComprovacao);
$stmtComprovacao->execute([ $idAtv, $idEstudante ]);
$comprovacao = $stmtComprovacao->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // salvar / editar arquivo
    if (isset($_POST['acao']) && $_POST['acao'] === 'salvar') {

        if ( isset($_FILES['comprovacao']) && $_FILES['comprovacao']['error'] === UPLOAD_ERR_OK ) {

            $arquivo = $_FILES['comprovacao'];
            $nomeOriginal = $arquivo['name'];
            $temporario = $arquivo['tmp_name'];
            $tamanho = $arquivo['size'];

            $extensao = strtolower( pathinfo($nomeOriginal, PATHINFO_EXTENSION) );

            $extensoesPermitidas = [ 'pdf', 'jpg', 'jpeg', 'png' ];
            if (!in_array($extensao, $extensoesPermitidas)) {
                die("Tipo de arquivo não permitido.");
            }

            $tamanhoMaximo = 10 * 1024 * 1024;
            if ($tamanho > $tamanhoMaximo) {
                die("O arquivo é muito grande. O tamanho máximo é 10 MB.");
            }

            $pastaUpload = __DIR__ . '/../src/uploads/comprovacoes/';

            if (!is_dir($pastaUpload)) {
                mkdir($pastaUpload, 0755, true);
            }

            // GERAR NOME ÚNICO
            $nomeArquivo = bin2hex(random_bytes(16)) . '.' . $extensao;
            $caminhoArquivo = $pastaUpload . $nomeArquivo;

            // SALVAR ARQUIVO
            if (!move_uploaded_file($temporario, $caminhoArquivo)) {
                die("Não foi possível salvar o arquivo.");
            }

            // EDITAR ENVIO EXISTENTE
            if ($comprovacao) {
                $arquivoAntigo = $comprovacao['arquivo'];
                
                $sql = "UPDATE comprovacoes SET arquivo = ?, nomeOriginal = ?, dataEnvio = CURRENT_TIMESTAMP 
                        WHERE idComprovacao = ?";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([ $nomeArquivo, $nomeOriginal, $comprovacao['idComprovacao'] ]);

                // Apaga o arquivo antigo
                $caminhoAntigo = $pastaUpload . $arquivoAntigo;

                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }

            // PRIMEIRO ENVIO
            } else {
                $sql = "INSERT INTO comprovacoes (idAtividade, idEstudante, arquivo, nomeOriginal) VALUES (?, ?, ?, ?)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([ $idAtv, $idEstudante, $nomeArquivo, $nomeOriginal ]);
            }

            // Atualiza a página
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }

    // REMOVER ENVIO
    if (isset($_POST['acao']) && $_POST['acao'] === 'excluir') {

        if ($comprovacao) {

            $pastaUpload = __DIR__ . '/../src/uploads/comprovacoes/';
            $caminhoArquivo = $pastaUpload . $comprovacao['arquivo'];

            // Apaga arquivo físico
            if (file_exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            $sql = "DELETE FROM comprovacoes WHERE idComprovacao = ? AND idAtividade = ? AND idEstudante = ?";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $comprovacao['idComprovacao'],
                $idAtv,
                $idEstudante
            ]);
        }

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}