<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $sexo = $email = $telefone = "";
$cep = $logradouro = $cidade = $estado = "";
$dataContrato = $salario = $senha = "";
$medico = $especialidade = $crm = "";

if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];

if (isset($_POST["dataContrato"])) $dataContrato = $_POST["dataContrato"];
if (isset($_POST["salario"])) $salario = $_POST["salario"];
if (isset($_POST["senha"])) $senha = $_POST["senha"];

if (isset($_POST["medico"])) $medico = $_POST["medico"];
if (isset($_POST["especialidade"])) $especialidade = $_POST["especialidade"];
if (isset($_POST["crm"])) $crm = $_POST["crm"];

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql1 = <<<SQL
  INSERT INTO PESSOA_TF (nome, sexo, email, telefone, 
                       cep, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO FUNCIONARIO_TF 
    (codigo, dataContrato, salario, senhaHash)
  VALUES (?, ?, ?, ?)
  SQL;

$sql3 = <<<SQL
  INSERT INTO MEDICO_TF 
    (codigo, especialidade, crm)
  VALUES (?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $nome, $sexo, $email, $telefone, 
    $cep, $logradouro, $cidade, $estado
  ])) throw new Exception('Falha na primeira inserção');

  $idNovoFuncionario = $pdo->lastInsertId();

  $stmt2 = $pdo->prepare($sql2);
  if (!$stmt2->execute([
    $idNovoFuncionario, $dataContrato, $salario, $senhaHash
  ])) throw new Exception('Falha na segunda inserção');

  if($medico) {
    $stmt3 = $pdo->prepare($sql3);
    if (!$stmt2->execute([
        $idNovoFuncionario, $especialidade, $crm
    ])) throw new Exception('Falha na segunda inserção');
  }

  $pdo->commit();

  header("Location: ../../../pages/restrict/registerEmployee");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
