<?php

require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT dataAgenda, horario, AGENDA_TF.nome as nomePaciente, sexo, email, especialidade, PESSOA_TF.nome as nomeMedico
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
  public $sexo;
  public $especialidade;
  public $nomeMedico;
  public $dataAgenda;
  public $horario;

  function __construct($nome, $email, $sexo, $especialidade, $nomeMedico, $dataAgenda, $horario)
  {
    $this->nome = $nome;
    $this->email = $email; 
    $this->sexo = $sexo;
    $this->especialidade = $especialidade;
    $this->nomeMedico = $nomeMedico;
    $this->dataAgenda = $dataAgenda;
    $this->horario = $horario;
  }
}

$stmt->execute();

$agendamentos = array();
while ($row = $stmt->fetch()) {
  array_push($agendamentos, new Agendamento($row['nomePaciente'], $row['email'], $row['sexo'], $row['especialidade'], $row['nomeMedico'], , $row['dataAgenda'], $row['horario']));
}
echo json_encode($agendamentos);