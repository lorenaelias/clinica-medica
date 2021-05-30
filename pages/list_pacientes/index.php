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
  <body class="listPacientes__container" onload="ifMedico();">
        <aside class="listPacientes__aside">
            <nav class="listPacientes__aside__icons">
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
        <div class="listPacientes__content">
            <div class="listPacientes__content__header">
                <h1>Listagem de Pacientes</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>
            <div class="listPacientes__content__list" >
                <ul class="pacientList" id="patientsList">

                    <!-- <li class="pacientList__item" >
                        <div class="pacientList__item__profile">
                            <div></div>
                            <p>Ilmerio Reis</p>
                            <span>A+</span>
                        </div>
                        <div class="pacientList__item__contact">
                            <p>(34) 99958-4525</p>
                        </div>
                    </li> -->

                </ul>
            </div>
        </div>

        <script>
            window.onload = buscaPacientes;
            

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
  
                        const novoLi = document.createElement("li");
                        const novaDiv = document.createElement("div");
                        const novaDiv1 = document.createElement("div");
                        const novaDiv2 = document.createElement("div"); 

                        const nome = document.createElement("p");
                        paciente.textContent = paciente.nome;

                        const email = document.createElement("p");
                        email.textContent = paciente.email;

                        const telefone = document.createElement("p");
                        telefone.textContent = paciente.telefone;

                        const logradouro = document.createElement("p");
                        logradouro.textContent = paciente.logradouro;

                        const cidade = document.createElement("p"); 
                        cidade.textContent = paciente.cidade;

                        const estado = document.createElement("p"); 
                        estado.textContent = paciente.estado;

                        const cep = document.createElement("p"); 
                        cep.textContent = paciente.cep;

                        const peso = document.createElement("p"); 
                        peso.textContent = paciente.peso;

                        const altura = document.createElement("p"); 
                        altura.textContent = paciente.altura;

                        const tiposanguineo = document.createElement("span"); 
                        tiposanguineo.textContent = paciente.tiposanguineo;

                        novaDiv1.appendChild(novaDiv);
                        novaDiv1.appendChild(nome);
                        novaDiv1.appendChild(tiposanguineo);
                        novaDiv1.appendChild(peso);
                        novaDiv1.appendChild(altura);

                        novaDiv1.classList.add("pacientList__item__profile");  
                        
                        novaDiv2.appendChild(email);
                        novaDiv2.appendChild(telefone);
                        novaDiv2.appendChild(logradouro);
                        novaDiv2.appendChild(cidade);
                        novaDiv2.appendChild(estado);
                        novaDiv2.appendChild(cep);
                      
                        novaDiv2.classList.add("pacientList__item__contact");           
                        
                        novoLi.appendChild(novaDiv1);
                        novoLi.appendChild(novaDiv2);
                        novoLi.classList.add("pacientList__item");  

                        pacientes.appendChild(novoLi);
                    }   
                    
                }
            }
        </script>

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
