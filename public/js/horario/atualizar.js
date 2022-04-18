function editarParada(horario_id){
    limparCampos();
    let formData = new FormData();
    formData.append('horario_id', horario_id);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: "/home/horario/editar",
        dataType: 'JSON',
        data:formData,
        processData: false,
        contentType: false,
        success: function(resultado) {
            $("#editar_dia_horario option[value="+resultado[0].dia+"]").attr("selected", "selected");
            $("#editar_horario_bairro").val(resultado[0].horario_bairro);
            $("#editar_horario_centro").val(resultado[0].horario_centro);
        }
    });
}
/*
* Funcao responsavel por cadastrar uma nova empresa 
*/
function atualizarHorario(){
    let dia_horario = $("#editar_dia_horario").val();
    let horario_bairro = $("#editar_horario_bairro").val();
    let horario_centro = $("#editar_horario_centro").val();
    
    try {
        if(dia_horario == null) throw {erros:{id:"editar_dia_horario", type:"error", msg: "O campo Dia é obrigatório."}}
        if(horario_bairro == "") throw {erros:{id:"editar_horario_bairro", type:"error", msg: "O campo Horário do bairro é obrigatório."}}
        if(horario_centro == "") throw {erros:{id:"editar_horario_centro", type:"error", msg: "O campo Horário do centro é obrigatório."}}


        let formData = new FormData(document.getElementById("formHorarioAtualizar"));
        formData.append('horario_id', horario_id);
        formData.append('linha_id', linha_id);
        formData.append('dia', dia);

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
       url: "/home/horario/atualizar",
       dataType: 'JSON',
       data: formData,
       processData: false,
       contentType: false,
       success: function(resultado) {
           console.log(resultado);
           adicionarRegistros(resultado.horarios.horarios);
           interacao("stop");
       }
   });
}