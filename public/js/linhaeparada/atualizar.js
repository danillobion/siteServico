function editarLinhaeParada(parada_id){
    // console.log(ordem, parada_id,rua,latitude,longitude);
    $("#parada_rua").val(rua);
}
/*
* Funcao responsavel por cadastrar uma nova empresa 
*/
function atualizarLinhaeParada(){
    let formData = new FormData();
    //estrutura original
    let arrayTemp = DATA.linhaeparadas.map(function(item) {return item.parada_id;});

    //posicao
    let nova_ordem = $("#ordem_parada").val()-1;
    let posicaoAntiga = arrayTemp.indexOf(parseInt(parada_id));

    if (nova_ordem >= arrayTemp.length) {
        var k = nova_ordem - arrayTemp.length + 1;
        while (k--) {
            arrayTemp.push(undefined);
        }
    }
    arrayTemp.splice(nova_ordem, 0, arrayTemp.splice(posicaoAntiga, 1)[0]);
    formData.append('linha_id', DATA.linha_id);
    formData.append('lista', arrayTemp);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    atualizar(formData);
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
       url: "/home/linha/parada/atualizar",
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