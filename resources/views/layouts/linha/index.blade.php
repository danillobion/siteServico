@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 style="margin-top: 10px">{{ __('Linhas da empresa XXX') }}</h6>
                    <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModalLong" onclick="limparCampos()">{{ __('Nova linha') }}</button>
                </div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover  mb-0">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 50%">Nome da linha</th>
                            <th scope="col" >Número</th>
                            <th scope="col" >Tempo de espera</th>
                            <th scope="col" >Valor</th>
                            <th scope="col"  >Ações</th>
                          </tr>
                        </thead>
                        <tbody  id="tableLinhas" style="height: 100px;  overflow-y: auto; overflow-x: hidden; ">
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
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Cadastrar linha') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="formLinha">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nome_da_linha">{{ __('Nome da linha') }}</label>
                                    <input type="text" class="form-control" id="nome_da_linha" name="nome_da_linha" placeholder="Digite o nome da linha">
                                    <span class="nome_da_linha" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="numero_da_linha">{{ __('Número da linha') }}</label>
                                    <input type="text" class="form-control" id="numero_da_linha" name="numero_da_linha" placeholder="Digite o número da linha">
                                    <span class="numero_da_linha" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tempo_de_espera_da_linha">{{ __('Tempo de espera') }}</label>
                                    <input type="number" class="form-control" id="tempo_de_espera_da_linha" name="tempo_de_espera_da_linha" placeholder="Digite o tempo de espera da linha" min="0">
                                    <span class="tempo_de_espera_da_linha" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="valor_da_linha">{{ __('Valor da linha (R$)') }}</label>
                                    <input type="text" class="form-control" id="valor_da_linha" name="valor_da_linha" placeholder="Digite o valor da passagem">
                                    <span class="valor_da_linha" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoSalvar" onclick="cadastrarLinha()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal editar-->
        <div class="modal fade" id="modalAtualizarLinha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Editar Linha') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="formLinhaAtualizar">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_nome_da_linha">{{ __('Nome da linha') }}</label>
                                    <input type="text" class="form-control" id="editar_nome_da_linha" name="editar_nome_da_linha" placeholder="Digite o nome da linha">
                                    <span class="editar_nome_da_linha" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_numero_da_linha">{{ __('Número da linha') }}</label>
                                    <input type="text" class="form-control" id="editar_numero_da_linha" name="editar_numero_da_linha" placeholder="Digite o número da linha">
                                    <span class="editar_numero_da_linha" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_tempo_de_espera_da_linha">{{ __('Tempo de espera') }}</label>
                                    <input type="number" class="form-control" id="editar_tempo_de_espera_da_linha" name="editar_tempo_de_espera_da_linha" placeholder="Digite o tempo de espera da linha">
                                    <span class="editar_tempo_de_espera_da_linha" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_valor_da_linha">{{ __('Valor da linha') }}</label>
                                    <input type="text" class="form-control" id="editar_valor_da_linha" name="editar_valor_da_linha" placeholder="Digite o valor da passagem">
                                    <span class="editar_valor_da_linha" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoAtualizar" onclick="atualizarLinha()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
</div>
</div>
<script>
   const DATA = {
        linhas: <?=json_encode($linhas)?>,
        empresa_id: <?=$empresa_id?>,
    };
</script>
<script src="/js/linha/linha_script.js"></script>
<script src="/js/linha/salvar.js"></script>
<script src="/js/linha/atualizar.js"></script>
<script src="/js/linha/deletar.js"></script>
@endsection
