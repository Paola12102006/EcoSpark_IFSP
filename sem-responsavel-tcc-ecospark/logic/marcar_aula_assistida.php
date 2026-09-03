<?php
session_start();

require '../logic/conectar_bd.php';

$idAluno = $_SESSION['estudante_id'];
$idAula = $_POST['id_aula'];

$sql = "INSERT IGNORE INTO aulas_assistidas (id_aluno, id_aula) VALUES (?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$idAluno, $idAula]);

header('Location: ../pages/videoaulas.php');
exit();
?>