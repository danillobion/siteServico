<?php

namespace App\Http\Controllers;
use App\Models\Linha;
use Illuminate\Http\Request;

class LinhaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /*
     * Funcao responsavel por carregar a tela principal
    */
    public function index($empresa_id){
        return view('layouts/linha/index',$this->getAllLinhas($empresa_id));
    }
    /*
    * Funcao responsavel por salvar o novo registro
    */
    public function salvarLinha(Request $request){
        $linha = Linha::create([
            'empresa_id' => $request['empresa_id'],
            'nome' => $request['nome_da_linha'],
            'numero' => $request['numero_da_linha'],
            'tempo_de_espera' => $request['tempo_de_espera_da_linha'],
            'valor' => $request['valor_da_linha'],
        ]);
        $body = ['status'=>$linha, "linhas" => $this->getAllLinhas($request['empresa_id'])];
        return $body;
    }
    /*
    * Funcao responsavel por editar o novo registro
    */
    public function editarLinha(Request $request){
        $linha = Linha::where('id', $request['linha_id'])->get();
        return $linha;
    }
    /*
    * Funcao responsavel por atualizar o registro
    */
    public function atualizarLinha(Request $request){        
        $linha = Linha::where('id', $request['linha_id'])->update([
            'empresa_id' => $request['empresa_id'],
            'nome' => $request['editar_nome_da_linha'],
            'numero' => $request['editar_numero_da_linha'],
            'tempo_de_espera' => $request['editar_tempo_de_espera_da_linha'],
            'valor' => $request['editar_valor_da_linha'],
        ]);
        $body = ['status'=>$linha, "linhas" => $this->getAllLinhas($request['empresa_id'])];
        return $body;
    }
    /*
    * Funcao responsavel por pegar todas as linhas de uma determinada empresa
    */
    private function getAllLinhas($empresa_id){
        $linha = Linha::where('empresa_id', $empresa_id)->get();
        $body = ['empresa_id' =>$empresa_id, 'linhas'=>$linha];
        return $body;
    }
      /*]
    * Funcao responsavel por deletar o registro
    */
    // !!!!!!!!!!!!!  para remover uma linha é preciso remover os horários !!!!!!!!!!!!!!!11
    public function deletarLinha(Request $request){        
        $empresa = Linha::where('id', $request->linha_id)->delete();
        $body = ['status'=>$empresa, "linhas" =>  $this->getAllLinhas($request['empresa_id'])];
        return $body;
    }
}
