
/*
* Variaveis globais
*/
var empresa_id;
var empresa_nome;

/*
* Funcao responsavel por listar as empresas cadastradas no sistema
*/
document.addEventListener("DOMContentLoaded", function() {
    adicionarRegistros(DATA.empresas);
  });

  function adicionarRegistros(dados){
    document.getElementById("tableEmpresas").innerHTML = ""; // limpar 
    var table = document.getElementById("tableEmpresas");
    dados.map(e=>{
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = e.nome;
        cell2.innerHTML = tipoDropdown(e);
    });
  }

  function tipoDropdown(dados){
        return `
        <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" empresa_id="${dados.id}" nome="${dados.nome}" onclick="atualizarVariaveisGlobais(this)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="linha/${dados.id}">Linhas</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" data-toggle="modal" data-target="#modalAtualizarEmpresa" onclick="editarEmpresa()">Editar</a>
        <a class="dropdown-item" href="#" style="color:red" onclick="botaoDeletar()">Deletar</a>
        </div>
        </div>`;
}

function atualizarVariaveisGlobais(dados){
    empresa_id = dados.getAttribute("empresa_id");
    empresa_nome = dados.getAttribute("nome");
}

 /*
 * Funcao responsavel por limpar os campos
 */
function limparCampos(){
    $("#nome_empresa").removeClass("is-invalid").val("");
    $(".nome_empresa").text("");
}
 /*
 * Funcao responsavel por avisar quando o campo tiver errado
 */
function showAlerta(data){
    $("#nome_empresa").addClass("is-invalid");
    $(".nome_empresa").text(data.erros.msg);
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