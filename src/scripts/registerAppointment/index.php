<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $email = $sexo = $especialidadeMedica =  $codigoMedico = $dataAgenda = $horario = "";

if (isset($_POST["nomePaciente"])) $nome = $_POST["nomePaciente"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
if (isset($_POST["medicName"])) $codigoMedico = intval($_POST["medicName"]);
if (isset($_POST["dataAgenda"])) $dataAgenda = $_POST["dataAgenda"];
if (isset($_POST["horario"])) $horario = $_POST["horario"];

$sql1 = <<<SQL
  INSERT INTO AGENDA_TF (nome, email, sexo, codigoMedico, dataAgenda, horario)
  VALUES (?, ?, ?, ?, ?, ?)
  SQL;

$success = true;
try {
  $stmt1 = $pdo->prepare($sql1);
  $stmt1->execute([$nome, $email, $sexo, $codigoMedico, $dataAgenda, $horario]);
} 
catch (Exception $e) {
  $success = false;
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}

echo json_encode($success);