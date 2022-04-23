@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6 style="margin-top: 10px">{{ __('Horário da linha XXX') }}</h6>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtro</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item"onclick="selectHorario(0)">Útil</a>
                              <a class="dropdown-item"onclick="selectHorario(1)">Sábado</a>
                              <a class="dropdown-item"onclick="selectHorario(2)">Domingo</a>
                            </div>
                          </div>
                          <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModalLong" onclick="limparCampos()" style="margin-left: 10px">{{ __('Novo horário') }}</button>
                    </div>
                </div>
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover  mb-0">
                        <thead>
                          <tr>
                              <th scope="col" style="width: 25%">Dia</th>
                              <th scope="col" style="width: 25%">Horário do bairro</th>
                              <th scope="col" style="width: 25%">Horário do centro</th>
                            <th scope="col" style="width: 25%">Ações</th>
                          </tr>
                        </thead>
                        <tbody  id="tableHorarios" style="height: 100px;  overflow-y: auto; overflow-x: hidden; ">
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
                    <form id="formHorario">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="dia_horario">{{ __('Dia') }}</label>
                                    <select class="custom-select" id="dia_horario" name="dia_horario">
                                        <option selected disabled>Selecione uma opção</option>
                                        <option value="0" >Útil</option>
                                        <option value="1">Sábado</option>
                                        <option value="2">Domingo</option>
                                      </select>
                                    <span class="dia_horario" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="horario_bairro">{{ __('Horário do bairro') }}</label>
                                    <input type="time" class="form-control" id="horario_bairro" name="horario_bairro">
                                    <span class="horario_bairro" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="horario_centro">{{ __('Horário do centro') }}</label>
                                    <input type="time" class="form-control" id="horario_centro" name="horario_centro">
                                    <span class="horario_centro" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoSalvar" onclick="cadastrarHorario()">{{ __('Salvar') }}</button>
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
                    <form id="formHorarioAtualizar">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="dia_horario">{{ __('Dia') }}</label>
                                    <select class="custom-select" id="editar_dia_horario" name="editar_dia_horario">
                                        <option selected disabled>Selecione uma opção</option>
                                        <option value="0" >Útil</option>
                                        <option value="1">Sábado</option>
                                        <option value="2">Domingo</option>
                                      </select>
                                    <span class="dia_horario" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="editar_horario_bairro">{{ __('Horário do bairro') }}</label>
                                    <input type="time" class="form-control" id="editar_horario_bairro" name="editar_horario_bairro">
                                    <span class="editar_horario_bairro" style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="editar_horario_centro">{{ __('Horário do centro') }}</label>
                                    <input type="time" class="form-control" id="editar_horario_centro" name="editar_horario_centro">
                                    <span class="editar_horario_centro" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancelar') }}</button>
                <button type="button" class="btn btn-success" id="botaoAtualizar" onclick="atualizarHorario()">{{ __('Salvar') }}</button>
                </div>
            </div>
            </div>
        </div>
</div>
</div>
<script>
   const DATA = {
        horarios: <?=json_encode($horarios)?>,
        linha_id: <?=$linha_id?>,
        dia: "<?=$dia?>",
    };
</script>
<script src="/js/horario/horario_script.js"></script>
<script src="/js/horario/salvar.js"></script>
<script src="/js/horario/atualizar.js"></script>
<script src="/js/horario/deletar.js"></script>
@endsection
