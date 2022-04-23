<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Linhaeparada;
use App\Models\Parada;

class LinhaEParadaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /*
     * Funcao responsavel por carregar as paradas
     */
    public function index($linha_id){
        return view('layouts/linhaeparada/index',$this->getAllLinhaParadas($linha_id));
    }
    /*
    * Funcao responsavel por pegar a lista de paradas cadastradas no sistema
    */
    private function getAllLinhaParadas($linha_id){
        $arrayLinhaParadas = [];
        $linhaeparadas = Linhaeparada::where('linha_id',$linha_id)->get();
        $paradas = Parada::get();
        foreach ($linhaeparadas as $item) {
            $parada = Parada::where("id", $item->parada_id)->get();
                $arrayEstrutura = array(
                    "ordem" => $item->ordem,
                    "parada_id" => $parada[0]->id,
                    "rua" => $parada[0]->rua,
                    "latitude" => $parada[0]->latitude,
                    "longitude" => $parada[0]->longitude,
                );
            array_push($arrayLinhaParadas, $arrayEstrutura);
        } 
        $body = ['linhaeparadas'=>$arrayLinhaParadas, 'paradas'=>$paradas, 'linha_id' => $linha_id];
        return $body;
    }
    /*
    * Funcao responsavel por salvar o novo registro
    */
    public function salvarLinhaeParada(Request $request){
        $cont = Linhaeparada::where('linha_id', $request->linha_id)->count();
        $linhaeparadas = Linhaeparada::create([
            'ordem' =>$cont+1, 
            'linha_id' =>intval($request->linha_id), 
            'parada_id' =>intval($request->parada_id)
        ]);
        $body = ['status'=>$linhaeparadas, "linhaeparadas" =>$this->getAllLinhaParadas($request['linha_id'])];
        return $body;
    }
    /*
    * Funcao responsavel por remover uma parada que esta vinculada a uma linha
    */
    public function deletarLinhaeParada(Request $request){
        $linhaeparadas = Linhaeparada::where('ordem', $request['ordem'])->where('linha_id', $request['linha_id'])->where('parada_id', $request['parada_id'])->delete();
        $body = ['status'=>$linhaeparadas, "linhaeparadas" =>$this->getAllLinhaParadas($request['linha_id'])];
        return $body;
    }
        /*
    * Funcao responsavel por atualizar o horario
    */
    public function atualizarLinhaeParada(Request $request){  
        //remover as paradas ja cadastradas
        Linhaeparada::where('linha_id', $request['linha_id'])->delete();
        //cadastrar a nova lista de paradas
        $posicoes =  explode(",", $request->lista);
        $cont = 1;
        foreach ($posicoes as $chave => $valor) {
            Linhaeparada::create([
                'ordem' =>$cont, 
                'linha_id' =>$request['linha_id'], 
                'parada_id' =>intval($valor)
            ]);
            $cont = $cont+1;
        }
        $body = ['status'=>$posicoes, "linhaeparadas" =>$this->getAllLinhaParadas($request['linha_id'])];
        return $body;
    }
}
