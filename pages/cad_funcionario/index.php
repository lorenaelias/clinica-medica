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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../../styles/globalStyles.css" />
  <link rel="stylesheet" href="../../styles/cad_funcionario.css" />
  <title>DevHealth | Cadastrar funcionário</title>
</head>

<body class="cadFuncionario__container">
  <aside class="cadFuncionario__aside">
    <nav class="cadFuncionario__aside__icons">
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
  <div class="cadFuncionario__content">
    <h2 class="cadFuncionario__content__header">Terça, 14 de janeiro 2021</h2>
    <div class="cadFuncionario_content__formContainer">
      <h1>Cadastrar novo funcionário</h1>
      <form>
        <div>
          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome">
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" name="email" id="email">
        </div>
        <div>
          <label for="sexo">Sexo</label>
          <select name="sexo" id="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
          </select>
        </div>
        <div>
          <label for="telefone">Telefone</label>
          <input type="text" name="telefone" id="telefone">
        </div>
        <div>
          <label for="cep">CEP (Ex. 38400-100)</label>
          <input type="text" name="cep" id="cep">
        </div>
        <div>
          <label for="logradouro">Logradouro</label>
          <input type="text" name="logradouro" id="logradouro">
        </div>
        <div>
          <label for="cidade">Cidade</label>
          <input type="text" name="cidade" id="cidade">
        </div>
        <div>
          <label for="estado">Estado</label>
          <input type="text" name="estado" id="estado">
        </div>
        <div>
          <label for="iniContrato">Início do Contrato</label>
          <input type="date" name="iniContrato" id="iniContrato">
        </div>
        <div>
          <label for="salario">Salário</label>
          <input type="number" name="salario" id="salario">
        </div>
        <div>
          <label for="senha">Senha</label>
          <input type="password" name="senha" id="senha">
        </div>

        <div>
          <label for="medico">Médico</label>
          <select id="selectMedico" name="medico">
            <option value="true">Sim</option>
            <option value="false" selected>Não</option>
          </select>
        </div>

        <div id="somedico" style="display: none;">
          <div>
            <label for="especialidade">Especialidade</label>
            <input type="text" name="especialidade" id="especialidade">
          </div>
          <div>
            <label for="crm">CRM</label>
            <input type="text" name="crm" id="crm">
          </div>
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
        } else {
          document.querySelector("#registerFail").style.display = 'block';
        }
      };

      xhr.onerror = function () {
        console.error("Erro de rede - requisição não finalizada");
      };

      xhr.open("POST", "../../src/scripts/registerEmployee/index.php", true);
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