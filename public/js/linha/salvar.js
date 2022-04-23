/*
  * Funcao responsavel por cadastrar uma nova linha 
  */
function cadastrarLinha(){
    let nome_linha = $("#nome_da_linha").val();
    let numero_da_linha = $("#numero_da_linha").val();
    let tempo_de_espera_da_linha = $("#tempo_de_espera_da_linha").val();
    let valor_da_linha = $("#valor_da_linha").val();
    try {
        if(nome_linha == "") throw {erros:{id:"nome_da_linha", type:"error", msg: "O campo Nome é obrigatório."}}
        if(nome_linha.length < 3) throw {erros:{id:"nome_da_linha", type:"error", msg: "O campo Nome deve ter pelo menos 4 caracteres."}}
        if(numero_da_linha == "") throw {erros:{id:"numero_da_linha", type:"error", msg: "O campo Número da linha não pode tá vázio."}}
        if(tempo_de_espera_da_linha == "") throw {erros:{id:"tempo_de_espera_da_linha", type:"error", msg: "O campo Tempo de espera da linha não pode tá vázio."}}
        if(valor_da_linha == "") throw {erros:{id:"valor_da_linha", type:"error", msg: "O campo Valor da linha não pode tá vázio."}}

        let formData = new FormData(document.getElementById("formLinha"));
        formData.append('empresa_id', DATA.empresa_id);

        salvarLinha(formData);
    } catch (error) {
       showAlerta(error);
    }
}
/*
* Funcao responsavel por salvar a nova linha
*/
function salvarLinha(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/linha/salvar",
       dataType: 'JSON',
       data: formData,
       processData: false,
       contentType: false,
       success: function(resultado) {
           adicionarRegistros(resultado.linhas.linhas);
           interacao("stop");
       }
   });
}