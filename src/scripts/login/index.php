<?php

class RequestResponse{
  public $success;
  public $destination;

  function __construct($success, $destination)
  {
      $this->success = $success;
      $this->destination = $destination;
  }
}

function checkLogin($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT senhaHash
    FROM PESSOA_TF INNER JOIN FUNCIONARIO_TF
    ON FUNCIONARIO_TF.codigo = PESSOA_TF.codigo
    WHERE email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
    if (!$row)
      return false;
    else
      return password_verify($senha, $row['senhaHash']);
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}



require "../../../../conexaoMysql.php";
$pdo = mysqlConnect();

$email = $senha = "";

if (isset($_POST["email"]))
  $email = $_POST["email"];
if (isset($_POST["senha"]))
  $senha = $_POST["senha"];

$sucesso = false;
$dest = "";
if (checkLogin($pdo, $email, $senha)) {
  $sucesso = true;
  $dest = "../../../pages/dashboard";
}

echo json_encode(new RequestResponse($sucesso, $dest));
?>