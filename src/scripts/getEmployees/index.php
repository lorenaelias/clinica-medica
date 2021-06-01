<?php

require "../../../../conexaoMysql.php";
require_once "../autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {

  $sql = <<<SQL
    SELECT nome, email, telefone, salario, dataContrato, crm, especialidade 
    FROM PESSOA_TF INNER JOIN FUNCIONARIO_TF ON PESSOA_TF.codigo = FUNCIONARIO_TF.codigo 
    LEFT OUTER JOIN MEDICO_TF ON FUNCIONARIO_TF.codigo = MEDICO_TF.codigo
  SQL;

  $stmt = $pdo->prepare($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Paciente
{
  public $nome;
  public $email;
  public $telefone;

  public $salario;
  public $dataContrato;
  public $crm;
  public $especialidade;

  function __construct($nome, $email, $telefone, $salario, $dataContrato, $crm, $especialidade)
  {
    $this->nome = $nome;
    $this->email = $email;
    $this->telefone = $telefone;

    $this->salario = $salario;
    $this->dataContrato = $dataContrato; 
    $this->crm = $crm;
    $this->especialidade = $especialidade;
  }
}

$stmt->execute();

$funcionarios = array();
while ($row = $stmt->fetch()) {
  array_push($funcionarios, new Paciente($row['nome'], $row['email'], $row['telefone'], $row['salario'], $row['dataContrato'], $row['crm'], $row['especialidade']));
}
echo json_encode($funcionarios);