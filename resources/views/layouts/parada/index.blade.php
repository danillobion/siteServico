@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 style="margin-top: 10px">{{ __('Paradas cadastradas no sistema') }}</h6>
                    <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModalLong" onclick="limparCampos()">{{ __('Nova parada') }}</button>
                </div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover  mb-0">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 50%">Rua</th>
                            <th scope="col" >Latitude</th>
                            <th scope="col" >Longitude</th>
                            <th scope="col"  >Ações</th>
                          </tr>
                        </thead>
                        <tbody  id="tableParadas" style="height: 100px;  overflow-y: auto; overflow-x: hidden; ">
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
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Cadastrar parada') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="formParada">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="rua_da_parada">{{ __('Rua') }}</label>
                                    <input type="text" class="form-control" id="rua_da_parada" name="rua_da_parada" placeholder="Digite o nome da rua">
                                    <span class="rua_da_parada" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="latitude_da_parada">{{ __('Latitude') }}</label>
                                    <input type="text" class="form-control" id="latitude_da_parada" name="latitude_da_parada" placeholder="Digite a latitude">
                                    <span class="latitude_da_parada" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="longitude_da_parada">{{ __('Longitude') }}</label>
                                    <input type="text" class="form-control" id="longitude_da_parada" name="longitude_da_parada" placeholder="Digite a longitude">
                                    <span class="longitude_da_parada" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoSalvar" onclick="cadastrarParada()">{{ __('Salvar') }}</button>
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
                    <form id="formParadaAtualizar">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_rua_da_parada">{{ __('Rua') }}</label>
                                    <input type="text" class="form-control" id="editar_rua_da_parada" name="editar_rua_da_parada" placeholder="Digite o nome da rua">
                                    <span class="editar_rua_da_parada" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_latitude_da_parada">{{ __('Latitude') }}</label>
                                    <input type="text" class="form-control" id="editar_latitude_da_parada" name="editar_latitude_da_parada" placeholder="Digite a latitude">
                                    <span class="editar_latitude_da_parada" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_longitude_da_parada">{{ __('Longitude') }}</label>
                                    <input type="text" class="form-control" id="editar_longitude_da_parada" name="editar_longitude_da_parada" placeholder="Digite a longitude">
                                    <span class="editar_longitude_da_parada" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoAtualizar" onclick="atualizarParada()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
</div>
</div>
<script>
   const DATA = {
        paradas: <?=json_encode($paradas)?>,
    };
</script>
<script src="/js/parada/parada_script.js"></script>
<script src="/js/parada/salvar.js"></script>
<script src="/js/parada/atualizar.js"></script>
<script src="/js/parada/deletar.js"></script>
@endsection
