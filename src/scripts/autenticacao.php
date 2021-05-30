<?php

function checkPassword($pdo, $email, $senha)
{
  $tempemail = "%$email%";
  $sql = <<<SQL
    SELECT PESSOA_TF.codigo as cod, nome, senhaHash
    FROM PESSOA_TF INNER JOIN FUNCIONARIO_TF
    ON FUNCIONARIO_TF.codigo = PESSOA_TF.codigo
    WHERE email LIKE ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tempemail]);
    $row = $stmt->fetch();
    
    $senhaHash = $row['senhaHash'];
    $cod = $row['cod'];
    $nome = $row['nome'];

    if (!$senhaHash)
      return array('senhaHash' => false, 'cod' => null, 'nome' => null);

    if (!password_verify($senha, $senhaHash))
      return array('senhaHash' => false, 'cod' => null, 'nome' => null);

    return array('senhaHash' => $senhaHash, 'cod' => $cod, 'nome' => $nome);
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

function checkLogged($pdo)
{
  if (!isset($_SESSION['codigo'], $_SESSION['loginString']))
    return false;

  $codigo = $_SESSION['codigo'];

  $sql = <<<SQL
    SELECT senhaHash
    FROM FUNCIONARIO_TF
    WHERE codigo = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codigo]);
    $senhaHash = $stmt->fetchColumn();
    if (!$senhaHash) 
      return false; 

    $loginStringCheck = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
    if (!hash_equals($loginStringCheck, $_SESSION['loginString']))
      return false;

    return true;
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

function exitWhenNotLogged($pdo)
{
  if (!checkLogged($pdo)) {
    header("Location: ../../pages");
    exit();
  }
}
