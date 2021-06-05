const dashboardDate = document.querySelector('#dashboardDate');
const cadFuncionarioDate = document.querySelector('#cadFuncionarioDate');
const cadPacienteDate = document.querySelector('#cadPacienteDate');
const listAgendamentosDate = document.querySelector('#listAgendamentosDate');
const listEnderecoDate = document.querySelector('#listEnderecoDate');
const listFuncionariosDate = document.querySelector('#listFuncionariosDate');
const listMeusAgendamentosDate = document.querySelector('#listMeusAgendamentosDate');
const listPacientesDate = document.querySelector('#listPacientesDate');

var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); 
var yyyy = today.getFullYear();

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

const fullDate = `${dd} de ${mes}, ${yyyy}`;

dashboardDate.innerHTML = fullDate;
cadFuncionarioDate.innerHTML = fullDate;
cadPacienteDate.innerHTML = fullDate;
listAgendamentosDate.innerHTML = fullDate;
listEnderecoDate.innerHTML = fullDate;
listFuncionariosDate.innerHTML = fullDate;
listMeusAgendamentosDate.innerHTML = fullDate;
listPacientesDate.innerHTML = fullDate;