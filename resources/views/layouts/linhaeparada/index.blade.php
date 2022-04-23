@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 style="margin-top: 10px">{{ __('Lista de paradas da linha XXX') }}</h6>
                    <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModalLong" onclick="limparCampos()">{{ __('Selecionar parada') }}</button>
                </div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover  mb-0">
                        <thead>
                          <tr>
                            <th scope="col" >Ordem</th>
                            <th scope="col" style="width: 100%">Parada</th>
                            <th scope="col"  >Ações</th>
                          </tr>
                        </thead>
                        <tbody  id="tableLinhaeparadas" style="height: 100px;  overflow-y: auto; overflow-x: hidden; ">
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        
        <!-- Modal adicionar-->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Selecionar parada') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="formLinhaEParadas">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nome_da_linha">{{ __('Nome da linha') }}</label>
                                    <select class="form-select" aria-label="Default select example" id="select_parada" name="select_parada">
                                      </select>
                                    <span class="select_parada" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoSalvar" onclick="cadastrarLinhaEParadas()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal editar-->
        <div class="modal fade" id="modalAtualizarLinhaeParada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Editar Linha') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="editar_formLinhaEParadas">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nome_da_linha">{{ __('Parada') }}</label>
                                    <input class="form-control" type="text" id="parada_rua" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ordem_parada">{{ __('Posição') }}</label>
                                    <input class="form-control" type="number" id="ordem_parada" name="ordem_parada" min="1" max="<?=  count($linhaeparadas) ?>">
                                    <span class="ordem_parada" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoAtualizar" onclick="atualizarLinhaeParada()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
</div>
</div>
<script>
   const DATA = {
    linhaeparadas: <?=json_encode($linhaeparadas)?>,
    paradas: <?=json_encode($paradas)?>,
    linha_id: <?=json_encode($linha_id)?>,
    };
</script>
<script src="/js/linhaeparada/linhaeparada_script.js"></script>
<script src="/js/linhaeparada/salvar.js"></script>
<script src="/js/linhaeparada/atualizar.js"></script>
<script src="/js/linhaeparada/deletar.js"></script>
@endsection
