<?php

require "../../../../conexaoMysql.php";
require_once "../autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {

  $sql = <<<SQL
  SELECT dataAgenda, horario, nome, sexo, email
  FROM AGENDA_TF
  WHERE codigoMedico = ?
  SQL;

  $stmt = $pdo->prepare($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Agendamento
{
  public $nome;
  public $email;
  public $sexo;
  public $data;
  public $horario;

  function __construct($nome, $email, $sexo, $data, $horario)
  {
    $this->nome = $nome;
    $this->email = $email; 
    $this->sexo = $sexo;
    $this->data = $data;
    $this->horario = $horario;
  }
}

$stmt->execute([$_SESSION['codigo']]);

$agendamentos = array();
while ($row = $stmt->fetch()) {
  array_push($agendamentos, new Agendamento($row['nome'], $row['email'], $row['sexo'], $row['dataAgenda'], $row['horario']));
}
echo json_encode($agendamentos);