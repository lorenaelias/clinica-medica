<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $email = $sexo = $especialidadeMedica =  $codigoMedico = $dataAgenda = $horario = "";

if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
if (isset($_POST["especialidadeMedica"])) $especialidadeMedica = $_POST["especialidadeMedica"];
if (isset($_POST["medicName"])) $codigoMedico = $_POST["medicName"];
if (isset($_POST["dataAgenda"])) $dataAgenda = $_POST["dataAgenda"];
if (isset($_POST["horario"])) $horario = $_POST["horario"];

$sql1 = <<<SQL
  INSERT INTO AGENDA_TF (nome, email, sexo, codigoMedico, dataAgenda, horario)
  VALUES (?, ?, ?, ?, ?, ?)
  SQL;

try {
  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([ $nome, $email, $sexo, $codigoMedico, $dataAgenda, $horario])) 
  throw new Exception('Falha na primeira inserção');

  exit();
} 
catch (Exception $e) {
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
