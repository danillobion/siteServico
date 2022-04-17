<?php

namespace App\Http\Controllers;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /*
    * Funcao responsavel por pegar a lista de empresas cadastradas no sistema
    */
    private function getAllEmpresas(){
        $dados = Empresa::orderBy('nome')->get();
        $body = ['empresas'=>$dados];
        return $body;
    }
    /*
     * Funcao responsavel por carregar a tela principal da empresa
     */
    public function index(){
        return view('layouts/empresa/index',$this->getAllEmpresas());
    }
    /*
    * Funcao responsavel por salvar o novo registro
    */
    public function salvarEmpresa(Request $request){
        $empresa = Empresa::create(['nome' => $request->nome_empresa]);
        $body = ['status'=>$empresa, "empresas" => $this->getAllEmpresas()];
        return $body;
    }
    /*
    * Funcao responsavel por atualizar o registro
    */
    public function atualizarEmpresa(Request $request){        
        $empresa = Empresa::where('id', $request->empresa_id)->update(['nome' => $request->editar_nome_empresa]);
        $body = ['status'=>$empresa, "empresas" => $this->getAllEmpresas()];
        return $body;
    }
    /*]
    * Funcao responsavel por deletar o registro
    */
    // !!!!!!!!!!!!!  para remover uma empresa é preciso remover as linhas, paradas e horários !!!!!!!!!!!!!!!11
    public function deletarEmpresa(Request $request){        
        $empresa = Empresa::where('id', $request->empresa_id)->delete();
        $body = ['status'=>$empresa, "empresas" => $this->getAllEmpresas()];
        return $body;
    }
    
}
