<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
     /*
     * Funcao responsavel por carregar a tela principal dos horarios
     */
    public function index($linha_id, $dia){
        return view('layouts/horario/index',$this->getAllHorarios($linha_id, $dia));
    }
    /*
    * Funcao responsavel por listar os horarios
    */
    private function getAllHorarios($linha_id, $dia){
        $horarios = Horario::where('linha_id', $linha_id)->where('dia', $dia)->get();
        $body = ['linha_id' => $linha_id, 'dia' => $dia, 'horarios' => $horarios];
        return $body;
    }
    /*
    * Funcao responsavel por filtrar os horarios
    */
    public function filtarHorario($linha_id, $dia){
        $horarios = Horario::where('linha_id', $linha_id)->where('dia', $dia)->get();
        $body = ['linha_id' => $linha_id, 'dia' => $dia, 'horarios' => $horarios];
        return $body;
    }
     /*
    * Funcao responsavel por salvar o novo horario
    */
    public function salvarHorario(Request $request){
        $horario = Horario::create(['linha_id' => $request["linha_id"], "dia" => $request['dia_horario'], "horario_bairro" => $request["horario_bairro"], "horario_centro" => $request["horario_centro"] ]);
        $body = ['status'=>$horario, "horarios" => $this->getAllHorarios($request["linha_id"], $request['dia_horario'])];
        return $body;
    }
     /*
    * Funcao responsavel por editar horario
    */
    public function editarHorario(Request $request){
        $horario = Horario::where('id', $request['horario_id'])->get();
        return $horario;
    }
       /*
    * Funcao responsavel por atualizar o horario
    */
    public function atualizarHorario(Request $request){        
        $horario = Horario::where('id', $request['horario_id'])->update([
            'dia' => $request['editar_dia_horario'],
            'horario_bairro' => $request['editar_horario_bairro'],
            'horario_centro' => $request['editar_horario_centro'],
        ]);
        $body = ['status'=>$horario, "horarios" => $this->getAllHorarios($request['linha_id'], $request['dia'])];
        return $body;
    }
       /*]
    * Funcao responsavel por deletar parada
    */
    // !!!!!!!!!!!!!  para remover uma linha é preciso remover os horários !!!!!!!!!!!!!!!11
    public function deletarHorario(Request $request){        
        $horarios = Horario::where('id', $request['horario_id'])->delete();
        $body = ['status'=>$horarios, "horarios" => $this->getAllHorarios($request['linha_id'], $request['dia'])];
        return $body;
    }
}
