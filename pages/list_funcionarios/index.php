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
    <link rel="stylesheet" href="../../styles/list_funcionarios.css" />
    <title>DevHealth | Listar Funcionários</title>
  </head>
  <body class="listFuncionarios__container" onload="ifMedico();">
        <aside class="listFuncionarios__aside">
            <nav class="listFuncionarios__aside__icons">
                <a href="../dashboard"><img src="../../public/icons/home.png" alt="home" /></a>
                <a href="../cad_funcionario"><img src="../../public/icons/heart.png" alt="heart" /></a>
                <a href="../cad_paciente"><img src="../../public/icons/peoples.png" alt="peoples" /></a>
                <a href="../list_pacientes"><img src="../../public/icons/painel.png" alt="painel" /></a>
                <a href="../list_funcionarios"><img src="../../public/icons/group.png" alt="group" /></a>
                <a href="../list_endereco"><img src="../../public/icons/marker.png" alt="marker.png" /></a>
                <a href="../list_agendamentos"><img src="../../public/icons/calendar.png" alt="calendar.png" /></a>
                <a href="../list_meus_agendamentos" id="meusAgend" style="display: none;"><img src="../../public/icons/note.png" alt="note" /></a>
                <a href="../../src/scripts/logout.php"><img src="../../public/icons/logout.png" alt="logout.png" /></a>
            </nav>
        </aside>
        <div class="listFuncionarios__content">
            <div class="listFuncionarios__content__header">
                <h1>Listagem de Funcionários</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>
            <div class="tableContainer">
                <table  class="listTable">
                    <tr class="listTable__header" >
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>É médico ?</th>
                        <th>CRM</th>
                        <th>Especialidade</th>
                    </tr>
                    <tr class="listTable__item" >
                        <td>Ilmerio Reis</td>
                        <td>Ilmerio@ufu.com.br</td>
                        <td>99498-7812</td>
                        <td>Não</td>
                        <td>Não possui</td>
                        <td>Não possui</td>
                    </tr>
                </table>
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
