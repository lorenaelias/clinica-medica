<?php
require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT nome
  FROM MEDICO_TF INNER JOIN PESSOA_TF ON MEDICO_TF.codigo = PESSOA_TF.codigo
  WHERE especialidade = ?
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
    array_push($especialidades,new Especialidade($row['nome'])); 
}
echo json_encode($especialidades);
?>
