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
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body class="bg-welcome">
    <div class="h-100vh w-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 offset-lg-3 p-5 offset-md-2">
                    <div class="bg-card-welcome p-4">
                        <p class="welcome-text">Aqui na sua plataforma de previsão climática, você pode escolher entre:</p>
                        <div class="d-flex gap-2 flex-wrap2">
                            <a href="{{ route('previsao.atual') }}" role="button" class="btn fw-bold btn-light-gray">
                                <span>Consultar o clima</span>
                            </a>
                            <a href="{{ route('previsao.compare') }}" role="button" class="btn fw-bold btn-light-gray">
                                Compare o clima
                            </a>
                            <a href="{{ route('previsao.listar') }}" role="button" class="btn fw-bold btn-light-gray">
                                Consultar salvas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/utils.js') }}"></script>
    </footer>
</body>
</html>
