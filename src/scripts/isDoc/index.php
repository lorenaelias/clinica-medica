<?php

require "../../../../conexaoMysql.php";
require_once "../autenticacao.php";

session_start();

$pdo = mysqlConnect();

class RequestResponse{
    public $success;

    function __construct($success)
    {
        $this->success = $success;
    }
}

$medico = false;

$sql = <<<SQL
SELECT crm
FROM MEDICO_TF
WHERE codigo = ?
SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['codigo']]);
    $row = $stmt->fetch();

    if ($row)
        $medico = true;
} 
catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
}

echo json_encode(new RequestResponse($medico));