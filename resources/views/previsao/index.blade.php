@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/previsao/index.css') }}">
@endsection
@section('conteudo')
    <div class="modal modal-md fade" id="HistoricoDePesquisasModal" aria-labelledby="HistoricoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-glass bg-light">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-clock-rotate-left"></i> Histórico
                        </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-white ">
                    <form action="" id="formPesquisaHistorico" method="get">
                      
                        <div class="d-flex flex-row gap-2">
                            <input name="query" id="query" type="text" class="form-control glass flex-grow-1">
                            <button type="submit" class="btn btn-success"><i class="fa fa-magnifying-glass"></i></button>
                        </div>
                    </form>

                    <div id="listar-historicos" class=" mt-3 gap-2 d-flex  p-1 flex-column overflow-auto h-60vh">
                        @foreach ($historicos_pesquisas as $pesquisa)
                            <div
                                id="item{{ $pesquisa->id }}"class="glass-item rounded p-2 d-flex flex-row justify-content-between">
                                <i>{{ $pesquisa->query }}</i> <a onclick="excluirPesquisa({{ $pesquisa->id }})"
                                    role="button" class="btn btn-sm btn-light"><i class="fa fa-xmark"></i></a>
                            </div>
                        @endforeach
                        @if (count($historicos_pesquisas) == 0)
                            <p>Não há nenhum histórico </p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
    <main>


        <section class="bg-{{ isset($current['weather_code']) ? $current['weather_code'] : 'light' }} pt-2 h-100vh ">

            <div class="container">


                <div class="row">

                    <div class="col-lg-8 offset-lg-2 mt-2 p-0">
                        <div class="d-flex previsao-atual  align-items-start rounded pt-2  p-2 pb-2 justify-content-center">
                            <div class="p-2 w-100">


                                <form action="{{ route('previsao.atual') }}" id="pesquisaPrevisao" method="get">

                                    <div class="row">
                                        <div class="col-md-5 " id="div-cep">
                                            <label for="cep"><b>CEP</b></label>
                                            <input type="text" name="cep"
                                                value="{{ request()->get('cep') ?? '' }}"id="cep"
                                                class="form-control glass">
                                        </div>
                                        <div class="col-md-5 ">
                                            <label for="cidade"><b>Cidade</b></label>
                                            <input type="text" name="cidade"
                                                value="{{ request()->get('cidade') ?? '' }}" id="cidade"
                                                class="form-control glass">
                                        </div>
                                        <div class="col-md-2  d-flex flex-column ">
                                            <label for="">&nbsp;</label>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <button class="btn btn-secondary " title="Pesquisar cidade"><i
                                                        class="fa fa-magnifying-glass"></i></button>
                                                <a href="#" role="button" class="btn btn-primary"
                                                    onclick="abrirModalHistorico()"title="Histórico de pesquisas"><i
                                                        class="fa fa-clock-rotate-left"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                @if (isset($success) && !$success)
                    <div class="mt-4">
                        <h5 class="text-center">{{ $mensagem_traduzida }}</h5>
                    </div>
                @endif
                @isset($current)
                    <div class="row mt-2">
                        <div class="col-lg-8 offset-lg-2 p-0 rounded">

                            <div
                                class="container-previsao   rounded bg-card-principal p-3  d-flex flex-column justify-content-center align-items-center">
                                <div class="w-100 justify-content-between  align-items-center d-flex gap-1 mb-2">
                                    <b><i class="text-primary"></i>
                                        {{ date('d/m/Y ', strtotime($location['localtime'])) }}</b>
                                    <div class="d-flex flex-row gap-1">
                                        <a role="button"
                                            href="{{ url('/previsao/compare?cep1=&cidade1=' . $location['name'] . '&cep2=&cidade2=') }}"
                                            class="btn btn-primary">
                                            Comparar</a>
                                        <div>
                                            <form action="{{ route('previsao.nova') }}" method="post">
                                                <input type="hidden" name="umidade" value="{{ $current['humidity'] }}">
                                                <input type="hidden" name="visibilidade" value="{{ $current['visibility'] }}">
                                                <input type="hidden" name="indice_uv" value="{{ $current['uv_index'] }}">
                                                <input type="hidden" name="cidade" value="{{ $location['name'] }}">
                                                <input type="hidden" name="temperatura" value="{{ $current['temperature'] }}">
                                                <input type="hidden" name="icone"
                                                    value="{{ $current['weather_icons'][0] }}">
                                                <input type="hidden" name="descricao"
                                                    value="{{ $current['weather_descriptions'][0] }}">
                                                <input type="hidden" name="dia_noite" value="{{ $current['is_day'] }}">
                                                <input type="hidden" name="vento" value="{{ $current['wind_speed'] }}">
                                                <input type="hidden" name="codigo_previsao"
                                                    value="{{ $current['weather_code'] }}">
                                                <input type="hidden" name="data_local"
                                                    value="{{ $location['localtime'] }}">
                                                @csrf
                                                <button type="submit"class="btn btn-success">
                                                    Salvar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                                <div class="previsao-atual mt-2 p-2">
                                    <div class="d-flex justify-content-between align-items-center">

                                        <div class="d-flex flex-row align-items-center gap-2">

                                        <h4 class="mt-3">
                                        Tempo em <b class="text-primary"><i class="fa fa-location-dot"></i>
                                            {{ $location['name'] }}</b></h4>

                                            <div class="flex-row d-flex gap-2 text-warning ">
                                                <b class="fs-5">{{ $current['temperature'] }} °C</b>
                                                @if ($current['temperature'] < 20)
                                                    @php $temperatureClass= 'bg-primary' @endphp
                                                @elseif ($current['temperature'] >= 20 && $current['temperature'] <= 29)
                                                    @php $temperatureClass= 'bg-warning' @endphp
                                                @else
                                                    @php $temperatureClass= 'bg-danger' @endphp
                                                @endif
                                                <span
                                                    class="badge  border my-auto {{ $temperatureClass }} border-light rounded-circle p-2 ">
                                                    <span class="visually-hidden">cor da temperatura</span></span>
                                            </div>

                                        </div>
                                        
                                    </div>



                                </div>
                                <div class="row mt-2 w-100 p-0">
                                    <div class="col-md-4 p-1">
                                        <div
                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center text-warning ">
                                            <b class="text-warning">UV</b>
                                            <h4>
                                                {{ $current['uv_index'] }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-1">
                                        <div
                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center text-warning ">
                                            <b class="text-primary">Vento</b>
                                            <h5>
                                                {{ $current['wind_speed'] }} Km/h
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-1">
                                        <div
                                            class="previsao-atual h-10vh d-flex justify-content-center align-items-center flex-column text-center text-warning ">
                                            <b class="text-primary"> Horário Local</b>
                                            @if ($current['is_day'] == 'yes')
                                                <div>

                                                    <span class="fs-5 fw-semibold">
                                                        <i class=" text-warning"></i>
                                                        {{ date('H:i', strtotime($location['localtime'])) }}
                                                    </span>
                                                </div>
                                            @else
                                               
                                                <span class="fs-5 fw-semibold">
                                                    <i class="text-warning"></i>
                                                    {{ date('H:i', strtotime($location['localtime'])) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 p-1">
                                        <div
                                            class="previsao-atual h-10vh d-flex flex-column  justify-content-center text-center">
                                            <b class="text-primary"> </b> Visibilidade</b>
                                            <h5>
                                                {{ $current['visibility'] }} Km
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-1">
                                        <div
                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center">
                                            <b class="text-primary"><i>
                                                </i> Umidade</b>
                                            <h5>
                                                {{ $current['humidity'] }} %
                                            </h5>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>
                @endisset
            </div>
        </section>

    </main>
@endsection
@section('scripts')
    <script src="{{ asset('js/previsao/index.js') }}"></script>
@endsection
