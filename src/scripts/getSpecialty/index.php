<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT DISTINCT especialidade
  FROM MEDICO_TF
  SQL;

  $stmt = $pdo->prepare($sql);
}catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Especialidade
{
  public $nome_especialidade;
  
  function __construct($nome_especialidade)
  {
    $this->nome_especialidade = $nome_especialidade;
  }
}

$stmt->execute();

$especialidades = array();
while ($row = $stmt->fetch()) {
    array_push($especialidades,new Especialidade($row['especialidade'])); 
}
echo json_encode($especialidades);
?>
