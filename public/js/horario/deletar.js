function botaoDeletar(){
    let traduzido_dia;

    if(dia == 0){
        traduzido_dia = "útil";
    }else if(dia == 1){
        traduzido_dia = "sábado";
    }else if(dia == 2){
        traduzido_dia = "domingo";
    }
    var r=confirm("Você deseja deletar o horario?  Dia: "+traduzido_dia+", horário do bairro: "+horario_bairro+" horário do centro: "+horario_centro+"");
    if (r==true){
        let formData = new FormData(); 
        formData.append('horario_id',horario_id);
        formData.append('dia',dia);
        formData.append('linha_id',linha_id);
        formData.append('csrf-token', $('meta[name="csrf-token"]').attr('content'));
        deletarHorario(formData);
    }
}
/*
* Funcao responsavel por deletar parada
*/
function deletarHorario(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/horario/deletar",
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