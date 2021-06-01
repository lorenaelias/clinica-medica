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
    <meta charset="UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <link rel="shortcut icon" href="../../public/icons/Logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="preconnect" href="https://fonts.gstatic.com" >
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    >
    <link rel="stylesheet" href="../../styles/globalStyles.css" >
    <link rel="stylesheet" href="../../styles/list_pacientes.css" >
    <title>DevHealth | Listar Pacientes</title>
  </head>
  <body class="listPacientes__container" onload="ifMedico();buscaPacientes();">
        <aside class="listPacientes__aside">
            <nav class="listPacientes__aside__icons" >
                <a href="../dashboard"><img src="../../public/icons/home.png" alt="home" ></a>
                <a href="../cad_funcionario"><img src="../../public/icons/heart.png" alt="heart" ></a>
                <a href="../cad_paciente"><img src="../../public/icons/peoples.png" alt="peoples" ></a>
                <a href="../list_pacientes"><img src="../../public/icons/painel.png" alt="painel" ></a>
                <a href="../list_funcionarios"><img src="../../public/icons/group.png" alt="group" ></a>
                <a href="../list_endereco"><img src="../../public/icons/marker.png" alt="marker.png" ></a>
                <a href="../list_agendamentos"><img src="../../public/icons/calendar.png" alt="calendar.png" ></a>
                <a href="../list_meus_agendamentos" id="meusAgend" style="display: none;"><img src="../../public/icons/note.png" alt="note" ></a>
                <a href="../../src/scripts/logout.php"><img src="../../public/icons/logout.png" alt="logout.png" ></a>
            </nav>
        </aside>
        <div class="listPacientes__content">
            <div class="listPacientes__content__header">
                <h1>Listagem de Pacientes</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>

            <div class="tableContainer" >
                <table class="listTable" id="patientsList">
                    <tr class="listTable__header" >
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>

                        <th>Tipo Sang.</th>
                        <th>Peso (kg)</th>
                        <th>Altura (cm)</th>
                        
                        <th>Logradouro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Cep</th>
                    </tr>
                </table>
            </div>
        </div>

        <script>

            function buscaPacientes(){

                var xhr = new XMLHttpRequest();

                xhr.open("GET", "../../src/scripts/getPatients/index.php", true);
                xhr.send();

                xhr.onload = function () {

                    if (xhr.status != 200){
                        console.log("Erro!");
                    }

                    var response = JSON.parse(xhr.responseText);

                    let pacientes = document.querySelector("#patientsList");
                    
                    for (i = pacientes.length - 1; i >= 0; i--) {
                        pacientes.remove(i);
                    }

                    for (i=0; i<response.length; i++) {
                    
                        paciente = response[i];
  
                        const novatr = document.createElement("tr");

                        const nome = document.createElement("td");
                        nome.textContent = paciente.nome;

                        const email = document.createElement("td");
                        email.textContent = paciente.email;

                        const telefone = document.createElement("td");
                        telefone.textContent = paciente.telefone;

                        const tiposanguineo = document.createElement("td"); 
                        tiposanguineo.textContent = paciente.tiposanguineo;

                        const peso = document.createElement("td"); 
                        peso.textContent = paciente.peso;

                        const altura = document.createElement("td"); 
                        altura.textContent = paciente.altura;

                        const logradouro = document.createElement("td");
                        logradouro.textContent = paciente.logradouro;

                        const cidade = document.createElement("td"); 
                        cidade.textContent = paciente.cidade;

                        const estado = document.createElement("td"); 
                        estado.textContent = paciente.estado;

                        const cep = document.createElement("td"); 
                        cep.textContent = paciente.cep;

                        novatr.appendChild(nome);
                        novatr.appendChild(email);
                        novatr.appendChild(telefone);

                        novatr.appendChild(tiposanguineo);
                        novatr.appendChild(peso);
                        novatr.appendChild(altura);
                        
                        novatr.appendChild(logradouro);
                        novatr.appendChild(cidade);
                        novatr.appendChild(estado);
                        novatr.appendChild(cep);
             
                        novatr.classList.add("listTable__item");  

                        pacientes.appendChild(novatr);
                    }   
                    
                }
            }

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
