<?php
require_once "../../../conexaoMysql.php";
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
    <link rel="stylesheet" href="../../styles/list_pacientes.css" />
    <title>DevHealth | Listar Pacientes</title>
  </head>
  <body class="listPacientes__container">
        <aside class="listPacientes__aside">
            <nav class="listPacientes__aside__icons">
                <a href="../dashboard/index.html"><img src="../../public/icons/home.png" alt="home" /></a>
                <a href="../cad_funcionario/index.html"><img src="../../public/icons/heart.png" alt="heart" /></a>
                <a href="../cad_paciente/index.html"><img src="../../public/icons/peoples.png" alt="peoples" /></a>
                <a href="../list_pacientes/index.html"><img src="../../public/icons/painel.png" alt="painel" /></a>
                <a href="../list_funcionarios/index.html"><img src="../../public/icons/group.png" alt="group" /></a>
                <a href="../list_endereco/index.html"><img src="../../public/icons/marker.png" alt="marker.png" /></a>
                <a href="../list_agendamentos/index.html"><img src="../../public/icons/calendar.png" alt="calendar.png" /></a>
                <a href="../list_meus_agendamentos/index.html"><img src="../../public/icons/note.png" alt="note" /></a>
                <a href="../../scripts/logout.php"><img src="../../public/icons/logout.png" alt="logout.png" /></a>
            </nav>
        </aside>
        <div class="listPacientes__content">
            <div class="listPacientes__content__header">
                <h1>Listagem de Pacientes</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>
            <div class="listPacientes__content__list" >
                <ul class="pacientList" >

                    <li class="pacientList__item" >
                        <div class="pacientList__item__profile">
                            <div></div>
                            <p>Ilmerio Reis</p>
                            <span>A+</span>
                        </div>
                        <div class="pacientList__item__contact">
                            <p>(34) 99958-4525</p>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
  </body>
</html>