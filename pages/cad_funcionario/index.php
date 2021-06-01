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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" >
  <link rel="stylesheet" href="../../styles/globalStyles.css" >
  <link rel="stylesheet" href="../../styles/cad_funcionario.css" >
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <title>DevHealth | Cadastrar funcionário</title>
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
    <h2 class="cadFuncionario__content__header">Terça, 14 de janeiro 2021</h2>
    <div class="cadFuncionario_content__formContainer">
      <h1>Cadastrar novo funcionário</h1>
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
        <div class="col-sm-7">
          <label class="form-label" for="telefone">Telefone</label class="form-label">
          <input class="form-control" type="text" name="telefone" id="telefone">
        </div>
        <div class="col-sm-5">
          <label class="form-label" for="cep">CEP (Ex. 38400-100)</label class="form-label">
          <input class="form-control" type="text" name="cep" id="cep" maxlength="10">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="logradouro">Logradouro</label class="form-label">
          <input class="form-control" type="text" name="logradouro" id="logradouro">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="cidade">Cidade</label class="form-label">
          <input class="form-control" type="text" name="cidade" id="cidade">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="estado">Estado</label class="form-label">
          <input class="form-control" type="text" name="estado" id="estado">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="iniContrato">Início do Contrato</label class="form-label">
          <input class="form-control" type="date" name="iniContrato" id="iniContrato" maxlength="8" min="1910-01-01" max="2030-12-31">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="salario">Salário</label class="form-label">
          <input class="form-control" type="number" name="salario" id="salario">
        </div>
        <div class="col-sm-4">
          <label class="form-label" for="senha">Senha</label class="form-label">
          <input class="form-control" type="password" name="senha" id="senha">
        </div>

        <div class="col-sm-12">
          <label class="form-label" for="selectMedico">Médico</label class="form-label">
          <select class="form-select" id="selectMedico" name="medico">
            <option value="true">Sim</option>
            <option value="false" selected>Não</option>
          </select>
        </div>

        <div id="somedico" style="display: none;">
          <div class="col-sm">
            <label class="form-label" for="especialidade">Especialidade</label class="form-label">
            <input class="form-control" type="text" name="especialidade" id="especialidade">
          </div>
          <div class="col-sm">
            <label class="form-label" for="crm">CRM</label class="form-label">
            <input class="form-control" type="text" name="crm" id="crm">
          </div>
        </div>
        <div class="col-sm-12">
        <button type="submit" id="buttonCad">Cadastrar</button>
        </div>
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

  <script>
    let selected = document.querySelector("#selectMedico");

    selected.addEventListener('change', mostraOpcoes);

    function mostraOpcoes(ev) {
      ev.preventDefault();

      if (selected.value == 'true') {
        document.querySelector("#somedico").style.display = 'block';
      } else {
        document.querySelector("#somedico").style.display = 'none';
      }
    }


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
          console.error("String JSON inválida: " + xhr.responseText);
          return;
        }

        let form = document.querySelector("form");
        form.logradouro.value = endereco.logradouro;
        form.estado.value = endereco.estado;
        form.cidade.value = endereco.cidade;
      }

      xhr.onerror = function () {
        console.error("Erro de rede - requisição não finalizada");
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
          console.error("String JSON inválida: " + xhr.responseText);
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
        console.error("Erro de rede - requisição não finalizada");
      };

      xhr.open("POST", "../../src/scripts/registerEmployee/index.php", true);
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