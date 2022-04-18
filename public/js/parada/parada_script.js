
/*
* Variaveis globais
*/
var parada_id;
var rua;
var latitude;
var longitude;

/*
* Funcao responsavel por listar as paradas cadastradas no sistema
*/
document.addEventListener("DOMContentLoaded", function() {
    adicionarRegistros(DATA.paradas);
  });

  function adicionarRegistros(dados){
    document.getElementById("tableParadas").innerHTML = ""; // limpar 
    var table = document.getElementById("tableParadas");
    dados.map(e=>{
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        cell1.innerHTML = e.rua;
        cell2.innerHTML = e.latitude;
        cell3.innerHTML = e.longitude;
        cell4.innerHTML = tipoDropdown(e);
    });
  }

  function tipoDropdown(dados){
        return `
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" parada_id="${dados.id}" rua="${dados.rua}" latitude="${dados.latitude}" longitude="${dados.longitude}" onclick="atualizarVariaveisGlobais(this)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" data-toggle="modal" data-target="#modalAtualizarLinha" onclick="editarParada(${dados.id})">Editar</a>
        <a class="dropdown-item" href="#" style="color:red" onclick="botaoDeletar()">Deletar</a>
        </div>
        </div>`;
}

function atualizarVariaveisGlobais(dados){
    parada_id = dados.getAttribute("parada_id");
    rua = dados.getAttribute("rua");
    latitude = dados.getAttribute("nolatitudeme");
    longitude = dados.getAttribute("longitude");
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