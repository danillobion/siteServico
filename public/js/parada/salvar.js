/*
  * Funcao responsavel por cadastrar uma nova linha 
  */
function cadastrarParada(){
    let rua_da_parada = $("#rua_da_parada").val();
    let latitude_da_parada = $("#latitude_da_parada").val();
    let longitude_da_parada = $("#longitude_da_parada").val();
    try {
        if(rua_da_parada == "") throw {erros:{id:"rua_da_parada", type:"error", msg: "O campo Rua é obrigatório."}}
        if(rua_da_parada.length < 3) throw {erros:{id:"rua_da_parada", type:"error", msg: "O campo Rua deve ter pelo menos 4 caracteres."}}
        if(latitude_da_parada == "") throw {erros:{id:"latitude_da_parada", type:"error", msg: "O campo Latitude não pode tá vázio."}}
        if(longitude_da_parada == "") throw {erros:{id:"longitude_da_parada", type:"error", msg: "O campo Longitude não pode tá vázio."}}

        let formData = new FormData();
        formData.append('rua', rua_da_parada);
        formData.append('latitude', latitude_da_parada);
        formData.append('longitude', longitude_da_parada);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
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
       url: "/home/parada/salvar",
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