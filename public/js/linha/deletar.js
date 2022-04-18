function botaoDeletar(){
    var r=confirm("Você deseja deletar a linha "+linha_nome+" ?");
    if (r==true){
        let formData = new FormData(); 
        formData.append('linha_id',linha_id);
        formData.append('empresa_id',empresa_id);
        formData.append('csrf-token', $('meta[name="csrf-token"]').attr('content'));
        deletarLinha(formData);
    }
}
/*
* Funcao responsavel por salvar a nova linha
*/
function deletarLinha(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/linha/deletar",
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