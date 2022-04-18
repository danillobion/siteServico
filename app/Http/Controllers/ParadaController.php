<?php

namespace App\Http\Controllers;
use App\Models\Parada;
use Illuminate\Http\Request;

class ParadaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /*
     * Funcao responsavel por carregar a tela principal da paradas
     */
    public function index(){
        return view('layouts/parada/index',$this->getAllParadas());
    }
    /*
    * Funcao responsavel por salvar o novo registro
    */
    public function salvarParada(Request $request){
        $parada = Parada::create([
            'rua' => $request['rua'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
        ]);
        $body = ['status'=>$parada, "paradas" => $this->getAllParadas()];
        return $body;
    }
    /*
    * Funcao responsavel por editar parada
    */
    public function editarParada(Request $request){
        $parada = Parada::where('id', $request['parada_id'])->get();
        return $parada;
    }
        /*
    * Funcao responsavel por atualizar parada
    */
    public function atualizarParada(Request $request){        
        $paradas = Parada::where('id', $request['parada_id'])->update([
            'rua' => $request['editar_rua_da_parada'],
            'latitude' => $request['editar_latitude_da_parada'],
            'longitude' => $request['editar_longitude_da_parada'],
        ]);
        $body = ['status'=>$paradas, "paradas" => $this->getAllParadas()];
        return $body;
    }
    /*
    * Funcao responsavel por pegar a lista de paradas cadastradas no sistema
    */
    private function getAllParadas(){
        $dados = Parada::orderBy('rua')->get();
        $body = ['paradas'=>$dados];
        return $body;
    }
    /*]
    * Funcao responsavel por deletar parada
    */
    // !!!!!!!!!!!!!  para remover uma linha é preciso remover os horários !!!!!!!!!!!!!!!11
    public function deletarParada(Request $request){        
        $paradas = Parada::where('id', $request['parada_id'])->delete();
        $body = ['status'=>$paradas, "paradas" => $this->getAllParadas()];
        return $body;
    }
}
