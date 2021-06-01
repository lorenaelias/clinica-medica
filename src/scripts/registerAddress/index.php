<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];

$sql1 = <<<SQL
  INSERT INTO ENDERECO_TF (cep, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?)
  SQL;

try {
  if ($cep == "" || $logradouro == "" || $cidade == "" || $estado == "") {
    $success = false;
  } else {
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute([ $cep, $logradouro, $cidade, $estado]);

    $success = true;
  }
} 
catch (Exception $e) {

  $success = false;
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
echo json_encode($success);
