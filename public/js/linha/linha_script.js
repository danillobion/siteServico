
/*
* Variaveis globais
*/
var empresa_id;
var linha_id;
var linha_nome;

/*
* Funcao responsavel por listar as empresas cadastradas no sistema
*/
document.addEventListener("DOMContentLoaded", function() {
    adicionarRegistros(DATA.linhas);
  });

  function adicionarRegistros(dados){
    document.getElementById("tableLinhas").innerHTML = ""; // limpar 
    var table = document.getElementById("tableLinhas");
    dados.map(e=>{
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        cell1.innerHTML = e.nome;
        cell2.innerHTML = e.numero;
        cell3.innerHTML = e.tempo_de_espera;
        cell4.innerHTML = e.valor;
        cell5.innerHTML = tipoDropdown(e);
    });
  }

  function tipoDropdown(dados){
        return `
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" empresa_id="${dados.empresa_id}" linha_id="${dados.id}" nome="${dados.nome}" onclick="atualizarVariaveisGlobais(this)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="/home/horario/${dados.id}/0">Horários</a>
        <a class="dropdown-item" href="/home/linha/parada/${dados.id}/">Paradas</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" data-toggle="modal" data-target="#modalAtualizarLinha" onclick="editarLinha(${dados.id})">Editar</a>
        <a class="dropdown-item" href="#" style="color:red" onclick="botaoDeletar()">Deletar</a>
        </div>
        </div>`;
}

function atualizarVariaveisGlobais(dados){
    empresa_id = dados.getAttribute("empresa_id");
    linha_id = dados.getAttribute("linha_id");
    linha_nome = dados.getAttribute("nome");
}

 /*
 * Funcao responsavel por limpar os campos
 */
function limparCampos(){
    $("#nome_da_linha").removeClass("is-invalid").val("");
    $(".nome_da_linha").text("");
    $("#numero_da_linha").removeClass("is-invalid").val("");
    $(".numero_da_linha").text("");
    $("#tempo_de_espera_da_linha").removeClass("is-invalid").val("");
    $(".tempo_de_espera_da_linha").text("");
    $("#valor_da_linha").removeClass("is-invalid").val("");
    $(".valor_da_linha").text("");
}
 /*
 * Funcao responsavel por avisar quando o campo tiver errado
 */
function showAlerta(data){
    console.log(data);
    $("#nome_linha").addClass("is-invalid");
    $(".nome_linha").text(data.erros.msg);
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