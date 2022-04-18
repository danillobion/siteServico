function editarLinha(linha_id){
    limparCampos();
    let formData = new FormData();
    formData.append('linha_id', linha_id);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: "/home/linha/editar",
        dataType: 'JSON',
        data:formData,
        processData: false,
        contentType: false,
        success: function(resultado) {
            $("#editar_nome_da_linha").val(resultado[0].nome);
            $("#editar_numero_da_linha").val(resultado[0].numero);
            $("#editar_tempo_de_espera_da_linha").val(resultado[0].tempo_de_espera);
            $("#editar_valor_da_linha").val(resultado[0].valor);
        }
    });
    // $("#editar_nome_empresa").val(empresa_nome);
}
/*
* Funcao responsavel por cadastrar uma nova empresa 
*/
function atualizarLinha(){
    let nome_linha = $("#editar_nome_da_linha").val();
    let numero_da_linha = $("#editar_numero_da_linha").val();
    let tempo_de_espera_da_linha = $("#editar_tempo_de_espera_da_linha").val();
    let valor_da_linha = $("#editar_valor_da_linha").val();
    try {
        if(nome_linha == "") throw {erros:{id:"editar_nome_da_linha", type:"error", msg: "O campo Nome é obrigatório."}}
        if(nome_linha.length < 3) throw {erros:{id:"editar_nome_da_linha", type:"error", msg: "O campo Nome deve ter pelo menos 4 caracteres."}}
        if(numero_da_linha == "") throw {erros:{id:"editar_numero_da_linha", type:"error", msg: "O campo Número da linha não pode tá vázio."}}
        if(tempo_de_espera_da_linha == "") throw {erros:{id:"editar_tempo_de_espera_da_linha", type:"error", msg: "O campo Tempo de espera da linha não pode tá vázio."}}
        if(valor_da_linha == "") throw {erros:{id:"editar_valor_da_linha", type:"error", msg: "O campo Valor da linha não pode tá vázio."}}

        let formData = new FormData(document.getElementById("formLinhaAtualizar"));
        formData.append('empresa_id', empresa_id);
        formData.append('linha_id', linha_id);

        atualizar(formData);
    } catch (error) {
       showAlerta(error);
    }
}
/*
* Funcao responsavel por salvar a nova empresa
*/
function atualizar(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/linha/atualizar",
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