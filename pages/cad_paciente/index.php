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
  <link rel="stylesheet" href="../../styles/responsive.css" />
  <link rel="stylesheet" href="../../styles/globalStyles.css" >
  <link rel="stylesheet" href="../../styles/cad_paciente.css" >
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <title>DevHealth | Cadastrar paciente</title>
</head>

<body class="cadFuncionario__container">
  <aside class="cadFuncionario__aside">
    <nav class="cadFuncionario__aside__icons">
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
  <div class="cadFuncionario__content">
    <h2 class="cadFuncionario__content__header" id="cadPacienteDate">Ter??a, 14 de janeiro 2021</h2>
    <div class="cadFuncionario_content__formContainer">
      <h1>Cadastrar novo paciente</h1>
      <form class="row gx-4 gy-3">
        <div class="col-sm-4">
          <label class="form-label" for="nome">Nome</label class="form-label">
          <input class="form-control" type="text" name="nome" id="nome">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="email">Email</label class="form-label">
          <input class="form-control" type="email" name="email" id="email">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="sexo">Sexo</label class="form-label">
          <select class="form-select" name="sexo" id="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
          </select>
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="telefone">Telefone</label class="form-label">
          <input class="form-control" type="tel" name="telefone" id="telefone">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="cep">CEP (Ex. 38400-100)</label class="form-label">
          <input class="form-control" type="text" name="cep" id="cep" maxlength="9">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="logradouro">Logradouro</label class="form-label">
          <input class="form-control" type="text" name="logradouro" id="logradouro">
        </div>
        <div class="col-sm-6">
          <label class="form-label" for="cidade">Cidade</label class="form-label">
          <input class="form-control" type="text" name="cidade" id="cidade">
        </div>
        <div class="col-sm-6">
          <label class="form-label" for="estado">Estado</label class="form-label">
          <input class="form-control" type="text" name="estado" id="estado">
        </div>

        <div class="col-sm-4">
          <label class="form-label" for="peso">Peso (em kg)</label class="form-label">
          <input class="form-control" type="number" name="peso" id="peso">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="altura">Altura (em cm)</label class="form-label">
          <input class="form-control" type="number" name="altura" id="altura">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="tipoSanguineo">Tipo sangu??neo</label class="form-label">
          <select class="form-select" name="tiposanguineo" id="tipoSanguineo">
            <option selected value="A+">A positivo</option>
            <option value="A-">A negativo</option>
            <option value="B+">B positivo</option>
            <option value="B-">B negativo</option>
            <option value="AB+">AB positivo</option>
            <option value="AB-">AB negativo</option>
            <option value="O+">O positivo</option>
            <option value="O-">O negativo</option>
          </select>
        </div>
        <button type="submit" id="buttonCad">Cadastrar</button>
      </form>
      <div id="registerSuccess" style="display: none; background-color: rgba(20,200,100,.6);">
        Cadastro efetuado com sucesso.
      </div>
      <div id="registerFail" style="display: none; background-color: rgba(200,20,20,.6);">
        Erro no cadastro. Tente novamente.
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="../../src/scripts/date.js"></script>

  <script>
    function buscaEndereco(cep) {
      if (cep.length != 9) return;

      let xhr = new XMLHttpRequest();
      xhr.open("GET", "../../src/scripts/getAddress/?cep=" + cep, true);

      xhr.onload = function () {
        if (xhr.status != 200) {
          console.error("Falha inesperada: " + xhr.responseText);
          return;
        }

        try {
          var endereco = JSON.parse(xhr.responseText);
        } catch (e) {
          console.error("String JSON inv??lida: " + xhr.responseText);
          return;
        }

        let form = document.querySelector("form");
        form.logradouro.value = endereco.logradouro;
        form.estado.value = endereco.estado;
        form.cidade.value = endereco.cidade;
      }

      xhr.onerror = function () {
        console.error("Erro de rede - requisi????o n??o finalizada");
      };

      xhr.send();
    }

    window.onload = function () {
      ifMedico();
      const inputCep = document.querySelector("#cep");
      inputCep.onkeyup = () => buscaEndereco(inputCep.value);
    }

    function limparCampos() {
      let campos = document.querySelectorAll('input');
      for (let i = 0; i < campos.length; i++) {
        campos[i].value = '';
      }
    }
    let botao = document.querySelector("#buttonCad");
    botao.addEventListener('click', validar);

    function validar(ev) {
      ev.preventDefault();

      let meuForm = document.querySelector("form");
      let formData = new FormData(meuForm);
      let xhr = new XMLHttpRequest();

      xhr.onload = function () {
        if (xhr.status != 200) {
          console.error("Falha inesperada: " + xhr.responseText);
        }

        try {
          var response = JSON.parse(xhr.responseText);
        } catch (e) {
          console.error("String JSON inv??lida: " + xhr.responseText);
        }

        if (response == true) {
          document.querySelector("#registerSuccess").style.display = 'block';
          limparCampos();
        } else {
          document.querySelector("#registerFail").style.display = 'block';
        }
        setTimeout(() => {
          document.querySelector("#registerSuccess").style.display = 'none';
          document.querySelector("#registerFail").style.display = 'none';
        }, 3000);
      };

      xhr.onerror = function () {
        console.error("Erro de rede - requisi????o n??o finalizada");
      };

      xhr.open("POST", "../../src/scripts/registerPatient/index.php", true);
      console.log(formData);
      xhr.send(formData);
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
