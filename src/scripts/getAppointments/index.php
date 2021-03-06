<?php

require "../../../../conexaoMysql.php";
require_once "../autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {

  $sql = <<<SQL
  SELECT dataAgenda, horario, AGENDA_TF.nome as nomePaciente, AGENDA_TF.email as pacienteEmail, especialidade, PESSOA_TF.nome as nomeMedico
  FROM AGENDA_TF 
  INNER JOIN MEDICO_TF ON codigoMedico = MEDICO_TF.codigo
  INNER JOIN PESSOA_TF ON codigoMedico = PESSOA_TF.codigo
  SQL;

  $stmt = $pdo->prepare($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Agendamento
{
  public $nome;
  public $email;
  public $especialidade;
  public $nomeMedico;
  public $dataAgenda;
  public $horario;

  function __construct($nome, $email, $especialidade, $nomeMedico, $dataAgenda, $horario)
  {
    $this->nome = $nome;
    $this->email = $email; 
    $this->especialidade = $especialidade;
    $this->nomeMedico = $nomeMedico;
    $this->dataAgenda = $dataAgenda;
    $this->horario = $horario;
  }
}

$stmt->execute();

$agendamentos = array();
while ($row = $stmt->fetch()) {
  array_push($agendamentos, new Agendamento($row['nomePaciente'], $row['pacienteEmail'], $row['especialidade'], $row['nomeMedico'], $row['dataAgenda'], $row['horario']));
}
echo json_encode($agendamentos);