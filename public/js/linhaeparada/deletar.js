function botaoDeletar(){
    var r=confirm("Você deseja deletar a parada "+rua+" ?");
    if (r==true){
        let formData = new FormData(); 
        formData.append('ordem',ordem);
        formData.append('parada_id',parada_id);
        formData.append('linha_id',DATA.linha_id);
        formData.append('csrf-token', $('meta[name="csrf-token"]').attr('content'));
        deletarLinhaeParada(formData);
    }
}
/*
* Funcao responsavel por deletar parada
*/
function deletarLinhaeParada(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/linha/parada/deletar",
       dataType: 'JSON',
       data: formData,
       processData: false,
       contentType: false,
       success: function(resultado) {
           adicionarRegistros(resultado.linhaeparadas.linhaeparadas);
           interacao("stop");
       }
   });
}