<?php
require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT horario
  FROM AGENDA_TF
  WHERE codigoMedico = ?
  AND dataAgenda = ?
  SQL;

  $stmt = $pdo->prepare($sql);
}catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Horario
{
  public $horario;

  function __construct($horario)
  {
    $this->horario = $horario;
  }
}

$medico = $_GET['medico'] ?? '';
$dataAgenda = $_GET['dataAgenda'] ?? '';

$stmt->execute([$medico, $dataAgenda]);

$horarios = array();
while ($row = $stmt->fetch()) {
    array_push($horarios,new Horario($row['horario'])); 
}
echo json_encode($horarios);
?>
