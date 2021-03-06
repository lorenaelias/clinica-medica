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
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../styles/globalStyles.css" />
    <link rel="stylesheet" href="../../styles/dashboard.css" />
    <link rel="stylesheet" href="../../styles/responsive.css" />
    <title>DevHealth | Dashboard</title>
  </head>
  <body class="dashboard__container" onload="ifMedico();">
        <aside class="dashboard__aside">
            <nav class="dashboard__aside__icons">
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

        <main class="dashboard__content">
          <div class="dashboard__content__header">
            <span>Dashboard</span>
            <span id="dashboardDate">Ter??a, 14 de janeiro</span>
          </div>
          <div class="dashboard__content__painel">
            <img src="../../src/assets/images/HPro.png" alt="Health professional">
            <div>
              <p>Seja bem vindo(a), <span><?php echo $_SESSION['nome'];?></span></p>
              <span>Esperamos que seu dia seja maravilhoso!</span>
            </div>
          </div>
          
          <div class="dashboard__content__cards">
            <div class="dashboard__content__cards--previous">
              <h2>??ltimo atendimento</h2>
              <p><strong>Nome:</strong>Victor Hugo Lopes</p>
              <p><strong>Idade:</strong>20</p>
              <p><strong>Exame:</strong>Exames de Rotina</p>
            </div>
            
            <div class="dashboard__content__cards--next">
              <h2>Pr??ximo atendimento</h2>
              <p><strong>Nome:</strong>Daniel Furtado</p>
              <p><strong>Idade:</strong>40</p>
              <p><strong>Exame:</strong>Acompanhamento</p>
            </div>
          </div>
        </main>
        <div class="dashboard__profile">
            <h1 class="dashboard__profile__title">Perfil</h1>
            <img src="../../src/assets/images/user.png" alt="Person photo" class="dashboard__profile__photo">
            <div class="dashboard__profile__infos">
                <h3>Nome:</h3>
                <p><?php echo $_SESSION['nome'];?></p>

                <h3>Cargo:</h3>
                <p id="infoMedico" style="display:none;">M??dico</p>
                <p id="infoFunc" style="display:none;">Funcion??rio</p>  

                <h3>Email:</h3>
                <p><?php echo $_SESSION['email'];?></p>
            </div>
        </div>

        <script src="../../src/scripts/date.js"></script>

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
                if( response.success == true ) {
                  document.querySelector("#meusAgend").style.display = 'inline-block'; 
                  document.querySelector("#infoMedico").style.display = 'inline-block';
                } else {
                  document.querySelector("#infoFunc").style.display = 'inline-block';
                }
            }
          }
        </script>
  </body>
</html>
