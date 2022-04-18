function editarEmpresa(){
    $("#editar_nome_empresa").val(empresa_nome);
}
/*
* Funcao responsavel por cadastrar uma nova empresa 
*/
function atualizarEmpresa(){
    let nome = $("#editar_nome_empresa").val();
    try {
        if(nome == "") throw {erros:{id:"editar_nome_empresa", type:"error", msg: "O campo Nome é obrigatório."}}
        if(nome.length < 3) throw {erros:{id:"editar_nome_empresa", type:"error", msg: "O campo Nome deve ter pelo menos 4 caracteres."}}

        let formData = new FormData(document.getElementById("formEmpresaAtualizar"));
        formData.append('empresa_id', empresa_id);

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
       url: "/home/empresa/atualizar",
       dataType: 'JSON',
       data: formData,
       processData: false,
       contentType: false,
       success: function(resultado) {
           adicionarRegistros(resultado.empresas.empresas);
           interacao("stop");
       }
   });
}