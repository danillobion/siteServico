/*
  * Funcao responsavel por cadastrar uma nova empresa 
  */
function cadastrarEmpresa(){
    let nome = $("#nome_empresa").val();
    try {
        if(nome == "") throw {erros:{id:"nome", type:"error", msg: "O campo Nome é obrigatório."}}
        if(nome.length < 3) throw {erros:{id:"nome", type:"error", msg: "O campo Nome deve ter pelo menos 4 caracteres."}}

        let formData = new FormData(document.getElementById("formEmpresa"));

        salvarEmpresa(formData);
    } catch (error) {
       showAlerta(error);
    }
}
/*
* Funcao responsavel por salvar a nova empresa
*/
function salvarEmpresa(formData){
   interacao("start");
   $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       type: 'POST',
       url: "/home/empresa/salvar",
       dataType: 'JSON',
       data: formData,
       processData: false,
       contentType: false,
       success: function(resultado) {
           adicionarRegistros(resultado.empresas.empresas);
           interacao("stop");
       }
   });
}