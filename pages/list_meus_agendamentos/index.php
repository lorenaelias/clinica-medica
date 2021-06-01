<?php
require_once "../../../conexaoMysql.php";
require_once "../../src/scripts/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);
?>
<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <link rel="shortcut icon" href="../../public/icons/Logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="preconnect" href="https://fonts.gstatic.com" >
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../styles/globalStyles.css" />
    <link rel="stylesheet" href="../../styles/list_meus_agendamentos.css" />
    <link rel="stylesheet" href="../../styles/responsive.css" />
    <title>DevHealth | Listar Meus Agendamentos</title>
  </head>
  <body class="listMeusAgendamentos__container" onload="buscaMeusAgendamentos();">
        <aside class="listMeusAgendamentos__aside">
            <nav class="listMeusAgendamentos__aside__icons">
                <a href="../dashboard"><img src="../../public/icons/home.png" alt="home" ></a>
                <a href="../cad_funcionario"><img src="../../public/icons/heart.png" alt="heart" ></a>
                <a href="../cad_paciente"><img src="../../public/icons/peoples.png" alt="peoples" ></a>
                <a href="../list_pacientes"><img src="../../public/icons/painel.png" alt="painel" ></a>
                <a href="../list_funcionarios"><img src="../../public/icons/group.png" alt="group" ></a>
                <a href="../list_endereco"><img src="../../public/icons/marker.png" alt="marker.png" ></a>
                <a href="../list_agendamentos"><img src="../../public/icons/calendar.png" alt="calendar.png" ></a>
                <a href="../list_meus_agendamentos"><img src="../../public/icons/note.png" alt="note" ></a>
                <a href="../../src/scripts/logout.php"><img src="../../public/icons/logout.png" alt="logout.png" ></a>
            </nav>
        </aside>
        <div class="listMeusAgendamentos__content">
            <div class="listMeusAgendamentos__content__header">
                <h1>Listagem dos Meus Agendamentos</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>
            <div class="tableContainer">
                <table class="listTable" id="listAgendamentos">
                    <tr class="listTable__header" >
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>Data</th>
                        <th>Horário</th>
                    </tr>
                </table>
            </div>
        </div>

        <script>
            function buscaMeusAgendamentos(){

                var xhr = new XMLHttpRequest();

                xhr.open("GET", "../../src/scripts/getMyAppointments/index.php", true);
                xhr.send();

                xhr.onload = function () {

                    if (xhr.status != 200){
                        console.log("Erro!");
                    }

                    var response = JSON.parse(xhr.responseText);

                    let agendamentos = document.querySelector("#listAgendamentos");
                    
                    for (i = agendamentos.length - 1; i >= 0; i--) {
                        agendamentos.remove(i);
                    }

                    for (i=0; i<response.length; i++) {
                    
                        agendamento = response[i];
  
                        const novotr = document.createElement("tr");  

                        const nome = document.createElement("td");
                        nome.textContent = agendamento.nome;

                        const email = document.createElement("td"); 
                        email.textContent = agendamento.email;

                        const sexo = document.createElement("td"); 
                        sexo.textContent = agendamento.sexo;

                        const data = document.createElement("td"); 
                        data.textContent = agendamento.data;

                        const horario = document.createElement("td"); 
                        horario.textContent = agendamento.horario + "h";

                        novotr.appendChild(nome);
                        novotr.appendChild(email);
                        novotr.appendChild(sexo);
                        novotr.appendChild(data);   
                        novotr.appendChild(horario);
                        novotr.classList.add("listTable__item");           
                        
                        agendamentos.appendChild(novotr);
                    }   
                    
                }
            }
        </script>
  </body>
</html>
