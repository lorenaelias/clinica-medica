<?php
require_once "../../../conexaoMysql.php";
require_once "../../src/scripts/autenticacao.php";
require_once "../../src/scripts/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../../public/icons/Logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../styles/globalStyles.css" />
    <link rel="stylesheet" href="../../styles/list_meus_agendamentos.css" />
    <title>DevHealth | Listar Meus Agendamentos</title>
  </head>
  <body class="listMeusAgendamentos__container">
        <aside class="listMeusAgendamentos__aside">
            <nav class="listMeusAgendamentos__aside__icons">
                <a href="../dashboard/index.html"><img src="../../public/icons/home.png" alt="home" /></a>
                <a href="../cad_funcionario/index.html"><img src="../../public/icons/heart.png" alt="heart" /></a>
                <a href="../cad_paciente/index.html"><img src="../../public/icons/peoples.png" alt="peoples" /></a>
                <a href="../list_pacientes/index.html"><img src="../../public/icons/painel.png" alt="painel" /></a>
                <a href="../list_funcionarios/index.html"><img src="../../public/icons/group.png" alt="group" /></a>
                <a href="../list_endereco/index.html"><img src="../../public/icons/marker.png" alt="marker.png" /></a>
                <a href="../list_agendamentos/index.html"><img src="../../public/icons/calendar.png" alt="calendar.png" /></a>
                <a href="../list_meus_agendamentos/index.html"><img src="../../public/icons/note.png" alt="note" /></a>
                <a href="../../src/scripts/logout.php"><img src="../../public/icons/logout.png" alt="logout.png" /></a>
            </nav>
        </aside>
        <div class="listMeusAgendamentos__content">
            <div class="listMeusAgendamentos__content__header">
                <h1>Listagem dos meus Meusagendamentos</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>
            <div class="listMeusAgendamentos__content__list" >
                <ul class="meusAgendamentosList" >

                    <li class="meusAgendamentosList__item" >
                        <p>Lorena Silva</p>
                        <p>18/06</p>
                        <p>10:00h</p>
                        <p>med156647</p>
                    </li>

                </ul>
            </div>
        </div>
  </body>
</html>
