
/*
* Variaveis globais
*/
var ordem;
var parada_id;
var rua;
var latitude;
var longitude;

/*
* Funcao responsavel por listar as paradas cadastradas no sistema
*/
document.addEventListener("DOMContentLoaded", function() {
    adicionarRegistros(DATA.linhaeparadas);
    adicionarParadas(DATA.paradas);
  });

  function adicionarRegistros(dados){
    document.getElementById("tableLinhaeparadas").innerHTML = ""; // limpar 
    var table = document.getElementById("tableLinhaeparadas");
    dados.map(e=>{
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.innerHTML = e.ordem;
        cell2.innerHTML = e.rua;
        cell3.innerHTML = tipoDropdown(e);
    });
  }
  function adicionarParadas(dados){
    dados.forEach(element => {
        $('#select_parada').append($('<option>', {
            value: element.id,
            text: element.rua
        }));       
      });
  }

  function tipoDropdown(dados){
        return `
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" ordem="${dados.ordem}" parada_id="${dados.parada_id}" rua="${dados.rua}" latitude="${dados.latitude}" longitude="${dados.longitude}" onclick="atualizarVariaveisGlobais(this)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" data-toggle="modal" data-target="#modalAtualizarLinhaeParada" onclick="editarLinhaeParada(${dados.parada_id})">Alterar posição</a>
        <a class="dropdown-item" href="#" style="color:red" onclick="botaoDeletar()">Deletar</a>
        </div>
        </div>`;
}

function atualizarVariaveisGlobais(dados){
    ordem = dados.getAttribute("ordem");
    parada_id = dados.getAttribute("parada_id");
    rua = dados.getAttribute("rua");
    latitude = dados.getAttribute("latitude");
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