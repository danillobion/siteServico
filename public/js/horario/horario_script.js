
/*
* Variaveis globais
*/
var horario_id;
var linha_id;
var dia;
var horario_bairro;
var horario_centro;

/*
* Funcao responsavel por listar as paradas cadastradas no sistema
*/
document.addEventListener("DOMContentLoaded", function() {
    adicionarRegistros(DATA.horarios);
  });

  function adicionarRegistros(dados){
    document.getElementById("tableHorarios").innerHTML = ""; // limpar 
    var table = document.getElementById("tableHorarios");
    dados.map(e=>{
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        if(e.dia == 0){
            cell1.innerHTML = "Útil";
        }else if(e.dia == 1){
            cell1.innerHTML = "Sábado";
        }else if(e.dia == 2){
            cell1.innerHTML = "Domingo";
        }
        cell2.innerHTML = e.horario_bairro;
        cell3.innerHTML = e.horario_centro;
        cell4.innerHTML = tipoDropdown(e);
    });
  }

  function tipoDropdown(dados){
        return `
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="${dados.id}" linha_id="${dados.linha_id}" dia="${dados.dia}" horario_bairro="${dados.horario_bairro}" horario_centro="${dados.horario_centro}" onclick="atualizarVariaveisGlobais(this)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ações
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" data-toggle="modal" data-target="#modalAtualizarLinha" onclick="editarParada(${dados.id})">Editar</a>
        <a class="dropdown-item" href="#" style="color:red" onclick="botaoDeletar()">Deletar</a>
        </div>
        </div>`;
}

function atualizarVariaveisGlobais(dados){
    horario_id = dados.getAttribute("id");
    linha_id = dados.getAttribute("linha_id");
    dia = dados.getAttribute("dia");
    horario_bairro = dados.getAttribute("horario_bairro");
    horario_centro = dados.getAttribute("horario_centro");
}

 /*
 * Funcao responsavel por limpar os campos
 */
function limparCampos(){
    $("#rua_da_parada").removeClass("is-invalid").val("");
    $(".rua_da_parada").text("");
    $("#latitude_da_parada").removeClass("is-invalid").val("");
    $(".latitude_da_parada").text("");
    $("#longitude_da_parada").removeClass("is-invalid").val("");
    $(".longitude_da_parada").text("");
}
 /*
 * Funcao responsavel por avisar quando o campo tiver errado
 */
function showAlerta(data){
    // $("#nome_linha").addClass("is-invalid");
    // $(".nome_linha").text(data.erros.msg);
    console.log("showAlerta", data);
}
function interacao(acao){
    if(acao == "start"){
        $("#botaoSalvar").prop("disabled", true);
        $("#botaoSalvar").addClass("disabled");
        $("#botaoAtualizar").prop("disabled", true);
        $("#botaoAtualizar").addClass("disabled");
    }else if(acao == "stop"){
        $("#botaoSalvar").prop("disabled",false);
        $("#botaoSalvar").removeClass("disabled");
        $("#botaoAtualizar").prop("disabled",false);
        $("#botaoAtualizar").removeClass("disabled");
    }
}