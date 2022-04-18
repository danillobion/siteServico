/*
  * Funcao responsavel por cadastrar uma nova linha 
  */
function cadastrarHorario(){
    let dia_horario = $("#dia_horario").val();
    let horario_bairro = $("#horario_bairro").val();
    let horario_centro = $("#horario_centro").val();
    
    try {
        if(dia_horario == null) throw {erros:{id:"dia_horario", type:"error", msg: "O campo Dia é obrigatório."}}
        if(horario_bairro == "") throw {erros:{id:"horario_bairro", type:"error", msg: "O campo Horário do bairro é obrigatório."}}
        if(horario_centro == "") throw {erros:{id:"horario_centro", type:"error", msg: "O campo Horário do centro é obrigatório."}}

        let formData = new FormData(document.getElementById("formHorario"));
        formData.append('linha_id', DATA.linha_id);
        salvarHorario(formData);
    } catch (error) {
       showAlerta(error);
    }
}
/*
* Funcao responsavel por salvar a nova linha
*/
function salvarHorario(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/horario/salvar",
       dataType: 'JSON',
       data: formData,
       processData: false,
       contentType: false,
       success: function(resultado) {
           adicionarRegistros(resultado.horarios.horarios);
           interacao("stop");
       }
   });
}