<?php
require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

$especialidade_medico = '';


if(isset($_GET["especialidade_medico"])) $especialidade_medico = $_GET["especialidade_medico"];  

try {

  $sql = <<<SQL
  SELECT nome_medico
  FROM medico
  WHERE especialidade_medico = ?
  SQL;

  $stmt = $pdo->prepare($sql);
}catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

class Especialidade
{
  public $nome_medico;

  function __construct($nome_medico)
  {
    $this->nome_medico = $nome_medico;
  }
}
$especialidade = $_GET['especialidade_medico'] ?? '';

$stmt->execute([$especialidade]);

$especialidades = array();
while ($row = $stmt->fetch()) {
    array_push($especialidades,new Especialidade($row['nome_medico'])); 
}
echo json_encode($especialidades);
?>
