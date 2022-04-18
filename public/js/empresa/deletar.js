function botaoDeletar(){
    var r=confirm("Você deseja deletar a empresa "+empresa_nome+" ?");
    if (r==true){
        let formData = new FormData(); 
        formData.append('empresa_id', empresa_id);
        formData.append('csrf-token', $('meta[name="csrf-token"]').attr('content'));
        deletarEmpresa(formData);
    }
}
/*
* Funcao responsavel por salvar a nova empresa
*/
function deletarEmpresa(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/empresa/deletar",
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