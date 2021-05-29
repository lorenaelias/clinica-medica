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
    <link rel="stylesheet" href="../../styles/dashboard.css" />
    <title>DevHealth | Dashboard</title>
  </head>
  <body class="dashboard__container">
        <aside class="dashboard__aside">
            <nav class="dashboard__aside__icons">
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

        <main class="dashboard__content">
          <div class="dashboard__content__header">
            <span>Dashboard</span>
            <span>Terça, 14 de janeiro</span>
          </div>
          <div class="dashboard__content__painel">
            <img src="../../src/assets/images/HPro.png" alt="Health professional">
            <div>
              <p>Seja bem vindo(a), <span>Dr. Lorena</span></p>
              <span>Esperamos que seu dia seja maravilhoso!</span>
            </div>
          </div>
          
          <div class="dashboard__content__cards">
            <div class="dashboard__content__cards--previous">
              <h2>Último atendimento</h2>
              <p><strong>Nome:</strong>Victor Hugo Lopes</p>
              <p><strong>Idade:</strong>20</p>
              <p><strong>Exame:</strong>Exames de Rotina</p>
            </div>
            
            <div class="dashboard__content__cards--next">
              <h2>Próximo atendimento</h2>
              <p><strong>Nome:</strong>Daniel Furado</p>
              <p><strong>Idade:</strong>26</p>
              <p><strong>Exame:</strong>Acompanhamento</p>
            </div>
          </div>
        </main>
        <main class="dashboard__profile">
            <h1 class="dashboard__profile__title">Perfil</h1>
            <img src="../../src/assets/images/user.png" alt="Person photo" class="dashboard__profile__photo">
            <div class="dashboard__profile__infos">
                <h3>Nome:</h3>
                <p>Lorena Elias Silva</p>
                <h3>Cargo:</h3>
                <p>Médica</p>
                <h3>Área:</h3>
                <p>Neurologia</p>
                <h3>Entrou em:</h3>
                <p>20/05/2000</p>
                <h3>Contato:</h3>
                <p>+55 (34) 99584-6584</p>
            </div>
        </main>
  </body>
</html>