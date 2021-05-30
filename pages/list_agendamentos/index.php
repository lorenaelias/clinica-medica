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
    <link rel="stylesheet" href="../../styles/list_agendamentos.css" />
    <title>DevHealth | Listar Agendamentos</title>
  </head>
  <body class="listAgendamentos__container" onload="ifMedico();">
        <aside class="listAgendamentos__aside">
            <nav class="listAgendamentos__aside__icons">
                <a href="../dashboard"><img src="../../public/icons/home.png" alt="home" /></a>
                <a href="../cad_funcionario"><img src="../../public/icons/heart.png" alt="heart" /></a>
                <a href="../cad_paciente"><img src="../../public/icons/peoples.png" alt="peoples" /></a>
                <a href="../list_pacientes"><img src="../../public/icons/painel.png" alt="painel" /></a>
                <a href="../list_funcionarios"><img src="../../public/icons/group.png" alt="group" /></a>
                <a href="../list_endereco"><img src="../../public/icons/marker.png" alt="marker.png" /></a>
                <a href="../list_agendamentos"><img src="../../public/icons/calendar.png" alt="calendar.png" /></a>
                <a href="../list_meus_agendamentos"><img src="../../public/icons/note.png" alt="note" /></a>
                <a href="../../src/scripts/logout.php"><img src="../../public/icons/logout.png" alt="logout.png" /></a>
            </nav>
        </aside>
        <div class="listAgendamentos__content">
            <div class="listAgendamentos__content__header">
                <h1>Listagem de Agendamentos</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>
            <div class="listAgendamentos__content__list" >
                <ul class="agendamentosList" >

                    <li class="agendamentosList__item" >
                        <p>Ricardo Zamboni Silva</p>
                        <p>25/04</p>
                        <p>12:00h</p>
                        <p>med158847</p>
                    </li>

                </ul>
            </div>
        </div>

        <script>
          function ifMedico() {

            var xhr = new XMLHttpRequest();

            xhr.open("GET", "../../src/scripts/isDoc/index.php", true);
            xhr.send();

            xhr.onload = function () {

                if (xhr.status != 200){
                    console.log("Erro!");
                }

                var response = JSON.parse(xhr.responseText);
                if( response.success == true )
                  document.querySelector("#meusAgend").style.display = 'inline-block';
              
            }
          }
        </script>
  </body>
</html>
