<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">
    @yield('links')
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
</head>
<body>
    <header class="p-1 bg-white b-shadow-nav">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center ps-2 pe-2 mb-md-0">
                    <li><a href="{{ route('previsao.atual') }}" class="{{ Request::is('previsao/atual') ? 'link-primary' : 'link-secondary' }} nav-link px-2">Clima Atual</a></li>
                    <li><a href="{{ route('previsao.compare') }}" class="nav-link px-2 {{ Request::is('previsao/compare') ? 'link-primary' : 'link-secondary' }}">Compare o clima</a></li>
                    <li><a href="{{ route('previsao.listar') }}" class="{{ Request::is('previsao/listar') ? 'link-primary' : 'link-secondary' }} nav-link px-2">Consultar salvas</a></li>
                </ul>

                <div class="dropdown text-end">
                    <ul class="nav">
                        <li><a href="{{ route('index') }}" class="nav-link px-2 link-secondary"><i class="fa fa-home"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    @yield('conteudo')

    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast-container">
        @if (session()->has('success'))
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto"><i class="fa fa-check text-success"></i></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto"><i class="fa fa-xmark text-danger"></i></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>

    <footer>
        <script src="{{ asset('jquery/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('jquery/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('jquery/additional-methods.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/utils.js') }}"></script>
        @yield('scripts')
    </footer>
</body>
</html>
