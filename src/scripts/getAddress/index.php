<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT logradouro, estado, cidade
  FROM ENDERECO_TF
  WHERE cep = ?
  SQL;

  $stmt = $pdo->prepare($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Endereco
{
  public $logradouro;
  public $estado;
  public $cidade;

  function __construct($logradouro, $estado, $cidade)
  {
    $this->logradouro = $logradouro;
    $this->estado = $estado; 
    $this->cidade = $cidade;
  }
}

$cep = $_GET['cep'] ?? '';
$cep = htmlspecialchars($cep);

$stmt->execute([$cep]);
$row = $stmt->fetch();

if (!$row)
  $endereco = new Endereco('', '', '');
else
  $endereco = new Endereco($row['logradouro'], $row['estado'], $row['cidade']);
  
echo json_encode($endereco);