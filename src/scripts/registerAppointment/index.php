<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $email = $sexo = $especialidadeMedica =  $nomeMedico = $dataConsulta = $horarioConsulta = "";

if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
if (isset($_POST["especialidadeMedica"])) $especialidadeMedica = $_POST["especialidadeMedica"];
if (isset($_POST["nomeMedico"])) $nomeMedico = $_POST["nomeMedico"];
if (isset($_POST["dataConsulta"])) $dataConsulta = $_POST["dataConsulta"];
if (isset($_POST["horarioConsulta"])) $horarioConsulta = $_POST["horarioConsulta"];

$sql1 = <<<SQL
  INSERT INTO ENDERECO_TF (nome, email, sexo, especialidadeMedica, nomeMedico, dataConsulta, horarioConsulta)
  VALUES (?, ?, ?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([ $nome, $email, $sexo, $especialidadeMedica $nomeMedico, $dataConsulta, $horarioConsulta])) 
  throw new Exception('Falha na primeira inserção');

  $pdo->commit();

  // header("Location: ../../../pages/public/registerEmployee");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
