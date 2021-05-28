<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $logradouro = $cidade = $estado = "";

if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];


$sql1 = <<<SQL
  INSERT INTO ENDERECO_TF (cep, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([ $cep, $logradouro, $cidade, $estado])) 
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
