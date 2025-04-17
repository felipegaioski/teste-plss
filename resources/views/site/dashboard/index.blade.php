@extends('site.layout')
    
@section('content')
<div class="main-container">
    @include('site.dashboard.header')
    <div class="row">
        <div class="col-12">
            <div class="card mx-2">
                <div class="card-header">
                    <h3 class="card-title">Chamados</h3>
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <div class="col-4 text-center">
                        <span class="fw-bold fs-0-8 text-primary">Novos: <span class="fw-medium text-secondary">{{ $data['new_tickets'] }}</span></span>
                    </div>
                    <div class="col-4 text-center">
                        <span class="fw-bold fs-0-8 text-warning">Pendentes: <span class="fw-medium text-secondary">{{ $data['pending_tickets'] }}</span></span>
                    </div>
                    <div class="col-4 text-center">
                        <span class="fw-bold fs-0-8 text-success">Finalizados:  <span class="fw-medium text-secondary">{{ $data['solved_tickets'] }}</span></span>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <h5 class="card-title">Por mês</h5>
                    <form method="GET" id="filterForm">
                        <div class="row">
                            <div class="col-4">
                                <select class="form-select" name="month" onchange="document.getElementById('filterForm').submit()">
                                    <option value="01" {{ (request('month') ?? date('m')) == '01' ? 'selected' : '' }}>Janeiro</option>
                                    <option value="02" {{ (request('month') ?? date('m')) == '02' ? 'selected' : '' }}>Fevereiro</option>
                                    <option value="03" {{ (request('month') ?? date('m')) == '03' ? 'selected' : '' }}>Março</option>
                                    <option value="04" {{ (request('month') ?? date('m')) == '04' ? 'selected' : '' }}>Abril</option>
                                    <option value="05" {{ (request('month') ?? date('m')) == '05' ? 'selected' : '' }}>Maio</option>
                                    <option value="06" {{ (request('month') ?? date('m')) == '06' ? 'selected' : '' }}>Junho</option>
                                    <option value="07" {{ (request('month') ?? date('m')) == '07' ? 'selected' : '' }}>Julho</option>
                                    <option value="08" {{ (request('month') ?? date('m')) == '08' ? 'selected' : '' }}>Agosto</option>            
                                    <option value="09" {{ (request('month') ?? date('m')) == '09' ? 'selected' : '' }}>Setembro</option>
                                    <option value="10" {{ (request('month') ?? date('m')) == '10' ? 'selected' : '' }}>Outubro</option>
                                    <option value="11" {{ (request('month') ?? date('m')) == '11' ? 'selected' : '' }}>Novembro</option>
                                    <option value="12" {{ (request('month') ?? date('m')) == '12' ? 'selected' : '' }}>Dezembro</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-select" name="year" onchange="document.getElementById('filterForm').submit()">
                                    @for ($i = date('Y'); $i >= 2022; $i--)
                                        <option value="{{ $i }}" {{ (request('year') ?? date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3 d-flex justify-content-center">
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-primary m-3 rounded-2">
                            <span class="fs-0-8 fw-bold text-white">Chamados criados no mês</span>
                            <div class="fs-1 fw-bold text-white">{{ $data['current_total_tickets'] }}</div>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-primary m-3 rounded-2">
                            <span class="fs-0-8 fw-bold text-white">Chamados resolvidos no prazo neste mês</span>
                            <div id="percentage" class="fs-1 fw-bold text-white">{{ $data['current_tickets_solved_on_time'] }}%</div>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center m-3 rounded-2
                        {{ $data['current_tickets_delayed'] > 0 ? 'bg-danger' : 'bg-success' }}">
                            <span class="fs-0-8 fw-bold text-white">Chamados atrasados neste mês</span>
                            <div id="percentage" class="fs-1 fw-bold text-white">{{ $data['current_tickets_delayed'] }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3 d-flex justify-content-center">
                        <h5 class="card-title">Totais</h5>
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-primary m-3 rounded-2">
                            <span class="fs-0-8 fw-bold text-white">Total</span>
                            <div id="percentage" class="fs-1 fw-bold text-white">{{ $data['total_tickets'] }}</div>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-primary m-3 rounded-2">
                            <span class="fs-0-8 fw-bold text-white">Total de chamados resolvidos dentro do prazo</span>
                            <div class="fs-1 fw-bold text-white">{{ $data['all_tickets_solved_on_time'] }}%</div>
                        </div>
                        <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-primary m-3 rounded-2">
                            <span class="fs-0-8 fw-bold text-white">Tempo médio de resolução de chamados (dias)</span>
                            <div id="percentage" class="fs-1 fw-bold text-white">{{ number_format($data['avg_days_to_solve'], 2, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
