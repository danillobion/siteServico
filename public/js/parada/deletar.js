function botaoDeletar(){
    var r=confirm("Você deseja deletar a parada "+rua+" ?");
    if (r==true){
        let formData = new FormData(); 
        formData.append('parada_id',parada_id);
        formData.append('csrf-token', $('meta[name="csrf-token"]').attr('content'));
        deletarLinha(formData);
    }
}
/*
* Funcao responsavel por deletar parada
*/
function deletarLinha(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/parada/deletar",
       dataType: 'JSON',
       data: formData,
       processData: false,
       contentType: false,
       success: function(resultado) {
           adicionarRegistros(resultado.paradas.paradas);
           interacao("stop");
       }
   });
}