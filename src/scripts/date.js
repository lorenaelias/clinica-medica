const dashboardDate = document.querySelector('#dashboardDate');
const cadFuncionarioDate = document.querySelector('#cadFuncionarioDate');
const cadPacienteDate = document.querySelector('#cadPacienteDate');
const listAgendamentosDate = document.querySelector('#listAgendamentosDate');
const listEnderecoDate = document.querySelector('#listEnderecoDate');
const listFuncionariosDate = document.querySelector('#listFuncionariosDate');
const listMeusAgendamentosDate = document.querySelector('#listMeusAgendamentosDate');
const listPacientesDate = document.querySelector('#listPacientesDate');

var hoje = new Date();
var dd = String(hoje.getDate()).padStart(2, '0');
var mm = String(hoje.getMonth() + 1).padStart(2, '0'); 
var aaaa = hoje.getFullYear();

const mes = mm == 01 ? 'Janeiro' : 
            mm == 02  ? 'Fevereiro' :
            mm == 03 ? 'Março' : 
            mm == 04  ? 'Abril' :
            mm == 05 ? 'Maio' : 
            mm == 06  ? 'Junho' :
            mm == 07 ? 'Julho' : 
            mm == 08  ? 'Agosto' :
            mm == 09 ? 'Setembro' : 
            mm == 10  ? 'Outubro' :
            mm == 11 ? 'Novembro' : 
                       'Dezembro'

const fullDate = `${dd} de ${mes}, ${aaaa}`;

if(cadFuncionarioDate != null)
  cadFuncionarioDate.innerHTML = fullDate;
else if(dashboardDate != null)
  dashboardDate.innerHTML = fullDate;
else if(cadPacienteDate != null)
  cadPacienteDate.innerHTML = fullDate;
else if(listAgendamentosDate != null)
  listAgendamentosDate.innerHTML = listAgendamentosDate != null ? fullDate : "";
else if(listEnderecoDate != null)
  listEnderecoDate.innerHTML = listEnderecoDate != null ? fullDate : "";
else if(listFuncionariosDate != null)
  listFuncionariosDate.innerHTML = listFuncionariosDate != null ? fullDate : "";
else if(listMeusAgendamentosDate != null)
  listMeusAgendamentosDate.innerHTML = listMeusAgendamentosDate != null ? fullDate : "";
else if(listPacientesDate != null)
  listPacientesDate.innerHTML = listPacientesDate != null ? fullDate : "";