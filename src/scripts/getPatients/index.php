<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
    SELECT nome, sexo, email, telefone, cep, logradouro, cidade, estado, peso, altura, tiposanguineo
    FROM PESSOA_TF INNER JOIN PACIENTE_TF 
    ON PESSOA_TF.codigo = PACIENTE_TF.codigo
  SQL;

  $stmt = $pdo->prepare($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Paciente
{
    public $nome;
    public $sexo;
    public $email;
    public $telefone;

  public $logradouro;
  public $estado;
  public $cidade;
  public $cep;

  public $peso;
  public $altura;
  public $tiposanguineo;

  function __construct($nome, $sexo, $email, $telefone, $logradouro, $estado, $cidade, $cep, $peso, $altura, $tiposanguineo)
  {
    $this->nome = $nome;
    $this->sexo = $sexo;
    $this->email = $email;
    $this->telefone = $telefone;

    $this->logradouro = $logradouro;
    $this->estado = $estado; 
    $this->cidade = $cidade;
    $this->cep = $cep;

    $this->peso = $peso;
    $this->altura = $altura;
    $this->tiposanguineo = $tiposanguineo;
  }
}

$stmt->execute();

$pacientes = array();
while ($row = $stmt->fetch()) {
  array_push($pacientes, new Endereco($row['nome'], $row['sexo'], $row['email'], $row['telefone'], $row['logradouro'], $row['estado'], $row['cidade'], $row['cep'], $row['peso'], $row['altura'], $row['tiposanguineo']));
}
echo json_encode($pacientes);