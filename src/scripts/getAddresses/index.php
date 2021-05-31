<?php

require "../../../../conexaoMysql.php";
require_once "../autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {

  $sql = <<<SQL
  SELECT logradouro, estado, cidade, cep
  FROM ENDERECO_TF
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
  public $cep;

  function __construct($logradouro, $estado, $cidade, $cep)
  {
    $this->logradouro = $logradouro;
    $this->estado = $estado; 
    $this->cidade = $cidade;
    $this->cep = $cep;
  }
}

$stmt->execute();

$enderecos = array();
while ($row = $stmt->fetch()) {
  array_push($enderecos, new Endereco($row['logradouro'], $row['estado'], $row['cidade'], $row['cep']));
}
echo json_encode($enderecos);