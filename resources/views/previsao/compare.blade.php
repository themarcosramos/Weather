@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/previsao/compare.css') }}">
@endsection
@section('conteudo')

    <div class="container-fluid bg-light mh-92vh ">


        <div class="row">

            <div class="col-lg-12   p-0">
                <div class="d-flex bg-light mh-22vh align-items-start rounded  p-2 pb-2 justify-content-center">

                    <div class="p-1 w-100">


                        <form action="{{ route('previsao.compare') }}" id="pesquisaPrevisao" method="get">

                            <div class="row  ">
                                <div class="col-lg-6 rounded  h-80vh p-2">
                                    <div class=" mb-2 card-previsao p-3">
                                        <div class="row">
                                            <div class="col-md-5 p-1 " id="div-cep1">
                                                <label for="cep"><b>CEP</b></label>
                                                <input type="text" name="cep1"
                                                    value="{{ request()->get('cep1') ?? '' }}" data-num-campo="1"
                                                    id="cep1" class="form-control cep glass">
                                            </div>
                                            <div class="col-md-5 p-1 ">
                                                <label for="cidade"><b>Cidade</b></label>
                                                <input type="text" name="cidade1"
                                                    value="{{ request()->get('cidade1') ?? '' }}" id="cidade1"
                                                    class="form-control glass">
                                            </div>
                                            <div class="col-md-2 p-1 d-flex flex-column ">
                                                <label for="">&nbsp;</label>
                                                <div class="d-flex gap-1 flex-wrap">
                                                    <button class="btn btn-secondary" title="Pesquisar cidade"><i
                                                            class="fa fa-magnifying-glass"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($primeiraPrevisao))
                                        <div
                                            class="container-previsao br-12 bg-{{ isset($primeiraPrevisao['current']['weather_code']) ? $primeiraPrevisao['current']['weather_code'] : 'light' }}">
                                            <div class=" mb-2  card-previsao d-flex flex-column align-items-center p-3">
                                                @if (isset($primeiraPrevisao['success']) && !$primeiraPrevisao['success'])
                                                    <div class="mt-4">
                                                        <h5 class="text-center">
                                                            {{ $primeiraPrevisao['mensagem_traduzida'] }}</h5>
                                                    </div>
                                                @endif
                                                @isset($primeiraPrevisao['current'])
                                                    <div class="row w-100 mt-2">
                                                        <div class="col-12 p-0 rounded">

                                                            <div
                                                                class="container-previsao   rounded bg-card-principal p-3  d-flex flex-column justify-content-center align-items-center">
                                                                <div
                                                                    class="w-100 justify-content-between  align-items-center d-flex gap-1 mb-2">
                                                                    <b><i class=" text-primary"></i>
                                                                        {{ date('d/m/Y H:i', strtotime($primeiraPrevisao['location']['localtime'])) }}</b>

                                                                </div>
                                                               

                                                                <div class="previsao-atual mt-2 p-2">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex flex-row align-items-center gap-2">

                                                                        <h4 class="mt-3">
                                                                        Tempo em  <b class="text-primary"><i
                                                                                class="fa fa-location-dot"></i>
                                                                            {{ $primeiraPrevisao['location']['name'] }}</b></h4>

                                                                            <div class="flex-row d-flex gap-2">
                                                                                <b class="fs-5">{{ $primeiraPrevisao['current']['temperature'] }}
                                                                                    °C</b>
                                                                                @if ($primeiraPrevisao['current']['temperature'] < 20)
                                                                                    @php $temperatureClass= 'bg-primary' @endphp
                                                                                @elseif ($primeiraPrevisao['current']['temperature'] >= 20 && $primeiraPrevisao['current']['temperature'] <= 29)
                                                                                    @php $temperatureClass= 'bg-warning' @endphp
                                                                                @else
                                                                                    @php $temperatureClass= 'bg-danger' @endphp
                                                                                @endif
                                                                                <span
                                                                                    class="badge  border my-auto {{ $temperatureClass }} border-light rounded-circle p-2 ">
                                                                                    <span class="visually-hidden">cor da
                                                                                        temperatura</span></span>
                                                                            </div>

                                                                        </div>
                                                                    </div>



                                                                </div>
                                                                <div class="row mt-2 w-100 p-0">
                                                                    <div class="col-md-4 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center">
                                                                            <b class="text-warning"> UV</b>
                                                                            <h4>
                                                                                {{ $primeiraPrevisao['current']['uv_index'] }}
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center">
                                                                            <b class="text-primary">
                                                                                Vento</b>
                                                                            <h5>
                                                                                {{ $primeiraPrevisao['current']['wind_speed'] }}
                                                                                Km/h
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex justify-content-center align-items-center flex-column text-center">
                                                                            <b class="text-primary">
                                                                                Horário Local</b>
                                                                            @if ($primeiraPrevisao['current']['is_day'] == 'yes')
                                                                                <div>

                                                                                   
                                                                                        <i
                                                                                            class="text-warning"></i>
                                                                                        {{ date('H:i', strtotime($primeiraPrevisao['location']['localtime'])) }}
                                                                                    
                                                                                </div>
                                                                            @else
                                                                                <span class="fs-5 fw-semibold">
                                                                                    <i class="text-warning"></i>
                                                                                    {{ date('H:i', strtotime($primeiraPrevisao['location']['localtime'])) }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column  justify-content-center text-center">
                                                                            <b class="text-primary"> 
                                                                                Visibilidade</b>
                                                                            <h5>
                                                                                {{ $primeiraPrevisao['current']['visibility'] }}
                                                                                Km
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center">
                                                                            <b class="text-primary"><i >
                                                                                </i> Umidade</b>
                                                                            <h5>
                                                                                {{ $primeiraPrevisao['current']['humidity'] }}
                                                                                %
                                                                            </h5>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                    @else
                                       
                                    @endif

                                </div>
                                <div class="col-lg-6 rounded  h-80vh p-2">
                                    <div class=" mb-2 card-previsao p-3">
                                        <div class="row">
                                            <div class="col-md-5 p-1 " id="div-cep2">
                                                <label for="cep"><b>CEP</b></label>
                                                <input type="text" name="cep2"
                                                    value="{{ request()->get('cep2') ?? '' }}" data-num-campo="2"id="cep2"
                                                    class="form-control cep glass">
                                            </div>
                                            <div class="col-md-5 p-1 ">
                                                <label for="cidade"><b>Cidade</b></label>
                                                <input type="text" name="cidade2"
                                                    value="{{ request()->get('cidade2') ?? '' }}" id="cidade2"
                                                    class="form-control glass">
                                            </div>
                                            <div class="col-md-2 p-1 d-flex flex-column ">
                                                <label for="">&nbsp;</label>
                                                <div class="d-flex gap-1 flex-wrap">
                                                    <button class="btn btn-secondary " title="Pesquisar cidade"><i
                                                            class="fa fa-magnifying-glass"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($segundaPrevisao))
                                        <div
                                            class="container-previsao br-12 bg-{{ isset($segundaPrevisao['current']['weather_code']) ? $segundaPrevisao['current']['weather_code'] : 'light' }}">
                                            <div class=" mb-2  card-previsao d-flex flex-column align-items-center p-3">
                                                @if (isset($segundaPrevisao['success']) && !$segundaPrevisao['success'])
                                                    <div class="mt-4">
                                                        <h5 class="text-center">
                                                            {{ $segundaPrevisao['mensagem_traduzida'] }}</h5>
                                                    </div>
                                                @endif
                                                @isset($segundaPrevisao['current'])
                                                    <div class="row w-100 mt-2">
                                                        <div class="col-12 p-0 rounded">

                                                            <div
                                                                class="container-previsao   rounded bg-card-principal p-3  d-flex flex-column justify-content-center align-items-center">
                                                                <div
                                                                    class="w-100 justify-content-between  align-items-center d-flex gap-1 mb-2">
                                                                    <b><i class="text-primary"></i>
                                                                        {{ date('d/m/Y H:i', strtotime($segundaPrevisao['location']['localtime'])) }}</b>

                                                                </div>
                                                           


                                                                <div class="previsao-atual mt-2 p-2">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex flex-row align-items-center gap-2">

                                                                            <h4 class="mt-3">
                                                                            Tempo em  <b class="text-primary"><i
                                                                                    class="fa fa-location-dot"></i>
                                                                                {{ $segundaPrevisao['location']['name'] }}</b></h4>

                                                                            <div class="flex-row d-flex gap-2">
                                                                                <b class="fs-5">{{ $segundaPrevisao['current']['temperature'] }}
                                                                                    °C</b>
                                                                                @if ($segundaPrevisao['current']['temperature'] < 20)
                                                                                    @php $temperatureClass= 'bg-primary' @endphp
                                                                                @elseif ($segundaPrevisao['current']['temperature'] >= 20 && $segundaPrevisao['current']['temperature'] <= 29)
                                                                                    @php $temperatureClass= 'bg-warning' @endphp
                                                                                @else
                                                                                    @php $temperatureClass= 'bg-danger' @endphp
                                                                                @endif
                                                                                <span
                                                                                    class="badge  border my-auto {{ $temperatureClass }} border-light rounded-circle p-2 ">
                                                                                    <span class="visually-hidden">cor da
                                                                                        temperatura</span></span>
                                                                            </div>

                                                                        </div>

                                                                    </div>



                                                                </div>
                                                                <div class="row mt-2 w-100 p-0">
                                                                    <div class="col-md-4 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center">
                                                                            <b class="text-warning"> UV</b>
                                                                            <h4>
                                                                                {{ $segundaPrevisao['current']['uv_index'] }}
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center">
                                                                            <b class="text-primary">
                                                                                Vento</b>
                                                                            <h5>
                                                                                {{ $segundaPrevisao['current']['wind_speed'] }}
                                                                                Km/h
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex justify-content-center align-items-center flex-column text-center">
                                                                            <b class="text-primary"><i
                                                                                    ></i> Horário Local</b>
                                                                            @if ($segundaPrevisao['current']['is_day'] == 'yes')
                                                                                <div>

                                                                                    <span class="fs-5 fw-semibold">
                                                                                        <i
                                                                                            class="text-warning"></i>
                                                                                        {{ date('H:i', strtotime($segundaPrevisao['location']['localtime'])) }}
                                                                                    </span>
                                                                                </div>
                                                                            @else
                                                                                <span class="fs-5 fw-semibold">
                                                                                    <i
                                                                                        class=" text-warning"></i>
                                                                                    {{ date('H:i', strtotime($segundaPrevisao['location']['localtime'])) }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column  justify-content-center text-center">
                                                                            <b class="text-primary">
                                                                                Visibilidade</b>
                                                                            <h5>
                                                                                {{ $segundaPrevisao['current']['visibility'] }}
                                                                                Km
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 p-1">
                                                                        <div
                                                                            class="previsao-atual h-10vh d-flex flex-column justify-content-center text-center">
                                                                            <b class="text-primary"><i>
                                                                                </i> Umidade</b>
                                                                            <h5>
                                                                                {{ $segundaPrevisao['current']['humidity'] }} %
                                                                            </h5>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                @endisset
                                            </div>
                                        </div>
                                    @else
                                     
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>




    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/previsao/compare.js') }}"></script>
@endsection
