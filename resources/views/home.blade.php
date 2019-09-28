@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><b>Bienvenido (a)</b></div>

                <div class="card-body monitoring-main">
                    <div class="row text-center mb-1 pt-4 pb-4">
                        <div class="col-md-6 mb-3">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <a href="{{ url('/monitoreo') }}" class="">
                                        <div class="option-box mb-3" style="background: rgba(159, 232, 23, 0.5)">
                                            <i class="fas fa-tachometer-alt" style="font-size: 80pt !important;"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ url('/monitoreo') }}" class="">
                                        <strong>Monitoreo</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <a href="{{ url('/bitacora') }}" class="">
                                        <div class="option-box mb-3" style="background: rgba(77, 134, 177, .5)">
                                            <i class="fas fa-clipboard-list" style="font-size: 80pt !important"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ url('/bitacora') }}" class="">
                                        <strong>Bitácora</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-12">
                            <span>Seleccione la opción que desea visualizar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
