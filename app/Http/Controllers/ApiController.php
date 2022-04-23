<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Linha;
use App\Models\Parada;
use App\Models\Horario;
use App\Models\Linhaeparada;

class ApiController extends Controller
{
    public function transporteColetivo(Request $request){
        $listaEmpresas = Empresa::get(['id','nome']);
        $listaLinhas = Linha::get(['id','empresa_id','nome','numero','tempo_de_espera','valor']);
        $listaParadas = Parada::get(['id','rua','latitude','longitude']);
        $listaHorarios = Horario::get(['linha_id','dia','horario_bairro','horario_centro']);
        $listaLinhaseparadas = Linhaeparada::get(['ordem', 'linha_id','parada_id']);

        $dados = ['empresas'=>$listaEmpresas,'linhas'=>$listaLinhas,'paradas'=>$listaParadas,'horarios'=>$listaHorarios,'linha_parada'=>$listaLinhaseparadas,];
        $body = ['dados'=>$dados, 'status'=>true, 'cidade'=>'Garanhuns/PE', 'dataAtualizacao'=>date("d.m.y"), 'versaoDoSistema' => "1.0"];
        echo json_encode($body);
    }
}
