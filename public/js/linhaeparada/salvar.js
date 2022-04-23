/*
  * Funcao responsavel por cadastrar uma nova linha 
  */
function cadastrarLinhaEParadas(){
    var parada_selecionada_id = $("#select_parada").val();
    try {
        if(parada_selecionada_id == "") throw {erros:{id:"select_parada", type:"error", msg: "O campo Rua é obrigatório."}}

        var formData = new FormData();
        formData.append('linha_id', parseInt(DATA.linha_id));
        formData.append('parada_id', parseInt(parada_selecionada_id));
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        salvarLinhaeParada(formData);
    } catch (error) {
        showAlerta(error);
    }
}
/*
* Funcao responsavel por salvar a nova linha
*/
function salvarLinhaeParada(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/linha/parada/salvar",
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