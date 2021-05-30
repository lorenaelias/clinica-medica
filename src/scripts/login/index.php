<?php

require "../../../../conexaoMysql.php";
require_once "../autenticacao.php";

session_start();

class RequestResponse{
  public $success;
  public $destination;

  function __construct($success, $destination)
  {
      $this->success = $success;
      $this->destination = $destination;
  }
}

$pdo = mysqlConnect();

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$sucesso = false;
$dest = "";
$arr = checkPassword($pdo, $email, $senha);
$senhaHash = $arr['senhaHash'];
$cod = $arr['cod'];
$nome = $arr['nome'];

if ($senhaHash) {
  
  $_SESSION['email'] = $email;
  $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']); 
  $_SESSION['codigo'] = $cod;
  $_SESSION['nome'] = $nome;

  $sucesso = true;
  $dest = "../dashboard";
}

echo json_encode(new RequestResponse($sucesso, $dest));
?>