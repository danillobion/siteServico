@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12" style="margin-bottom: 1rem">
                            <label for="paradas">Paradas</label>
                            <a type="button" class="btn btn-primary btn-sm" href="home/parada" style="width:100%; color:white">{{__("Paradas")}}</a>
                        </div>
                        <div class="col-12">
                            <label for="paradas">Empresas</label>
                            <a type="button" class="btn btn-primary btn-sm" href="home/empresa" style="width:100%; color:white">{{__("Empresas")}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are Admin.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
