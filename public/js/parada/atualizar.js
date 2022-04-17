function editarParada(parada_id){
    limparCampos();
    let formData = new FormData();
    formData.append('parada_id', parada_id);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: "/home/parada/editar",
        dataType: 'JSON',
        data:formData,
        processData: false,
        contentType: false,
        success: function(resultado) {
            $("#editar_rua_da_parada").val(resultado[0].rua);
            $("#editar_latitude_da_parada").val(resultado[0].latitude);
            $("#editar_longitude_da_parada").val(resultado[0].longitude);
        }
    });
}
/*
* Funcao responsavel por cadastrar uma nova empresa 
*/
function atualizarParada(){
    let rua = $("#editar_rua_da_parada").val();
    let latitude = $("#editar_latitude_da_parada").val();
    let longitude = $("#editar_longitude_da_parada").val();
    try {
        if(rua == "") throw {erros:{id:"editar_rua_da_parada", type:"error", msg: "O campo Rua é obrigatório."}}
        if(rua.length < 3) throw {erros:{id:"editar_rua_da_parada", type:"error", msg: "O campo Rua deve ter pelo menos 4 caracteres."}}
        if(latitude == "") throw {erros:{id:"editar_latitude_da_parada", type:"error", msg: "O campo Latitude não pode tá vázio."}}
        if(longitude == "") throw {erros:{id:"editar_longitude_da_parada", type:"error", msg: "O campo Longitude não pode tá vázio."}}

        let formData = new FormData(document.getElementById("formParadaAtualizar"));
        formData.append('parada_id', parada_id);

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
       url: "/home/parada/atualizar",
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