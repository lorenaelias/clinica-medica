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
    <link rel="stylesheet" href="../../styles/list_enderecos.css" />
    <link rel="stylesheet" href="../../styles/responsive.css" />
    <title>DevHealth | Listar Endereços</title>
  </head>
  <body class="listEnderecos__container" onload="ifMedico(); buscaEnderecos();">
        <aside class="listEnderecos__aside">
            <nav class="listEnderecos__aside__icons">
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
        <div class="listEnderecos__content">
            <div class="listEnderecos__content__header">
                <h1>Listagem de Endereços</h1>
                <h2>Terça, 14 de janeiro 2021</h2>
            </div>

            <div class="tableContainer">
                <table class="listTable" id="enderecoList">
                    <tr class="listTable__header">
                    <th>Logradouro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>CEP</th>
                    </tr>
                </table>
            </div>
        </div>

        <script>
            function buscaEnderecos(){

                var xhr = new XMLHttpRequest();

                xhr.open("GET", "../../src/scripts/getAddresses/index.php", true);
                xhr.send();

                xhr.onload = function () {

                    if (xhr.status != 200){
                        console.log("Erro!");
                    }

                    var response = JSON.parse(xhr.responseText);

                    let enderecos = document.querySelector("#enderecoList");
                    
                    for (i = enderecos.length - 1; i >= 0; i--) {
                        enderecos.remove(i);
                    }

                    for (i=0; i<response.length; i++) {
                    
                        endereco = response[i];
  
                        const novotr = document.createElement("tr");  

                        const logradouro = document.createElement("td");
                        logradouro.textContent = endereco.logradouro;

                        const cidade = document.createElement("td"); 
                        cidade.textContent = endereco.cidade;

                        const estado = document.createElement("td"); 
                        estado.textContent = endereco.estado;

                        const cep = document.createElement("td"); 
                        cep.textContent = endereco.cep;

                        novotr.appendChild(logradouro);
                        novotr.appendChild(cidade);
                        novotr.appendChild(estado);
                        novotr.appendChild(cep);   
                        novotr.classList.add("listTable__item");           
                        
                        enderecos.appendChild(novotr);
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
