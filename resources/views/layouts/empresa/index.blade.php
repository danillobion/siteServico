@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 style="margin-top: 10px">{{ __('Empresas cadastradas no sistema') }}</h6>
                    <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModalLong" onclick="limparCampos()">{{ __('Nova empresa') }}</button>
                </div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover  mb-0">
                        <thead>
                          <tr>
                            <th scope="col" style="width:50%">Nome da empresa</th>
                            <th scope="col" style="width:50%">Ações</th>
                          </tr>
                        </thead>
                        <tbody  id="tableEmpresas" style="height: 100px;  overflow-y: auto; overflow-x: hidden; ">
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Cadastrar empresa') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="formEmpresa">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nome_empresa">{{ __('Nome da empresa') }}</label>
                                    <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" placeholder="Digite o nome da empresa">
                                    <span class="nome_empresa" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoSalvar" onclick="cadastrarEmpresa()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalAtualizarEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Editar empresa') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="formEmpresaAtualizar">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editar_nome_empresa">{{ __('Nome da empresa') }}</label>
                                    <input type="text" class="form-control" id="editar_nome_empresa" name="editar_nome_empresa" placeholder="Digite o nome da empresa">
                                    <span class="editar_nome_empresa" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoAtualizar" onclick="atualizarEmpresa()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
</div>
</div>
<script>
   const DATA = {
        empresas: <?=json_encode($empresas)?>,
    };
</script>
<script src="../js/empresa/empresa_script.js"></script>
<script src="../js/empresa/salvar.js"></script>
<script src="../js/empresa/atualizar.js"></script>
<script src="../js/empresa/deletar.js"></script>
@endsection
