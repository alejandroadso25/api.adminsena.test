<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminSena | Inicio</title>
    @include('includes.dependencias')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="home-page">
    {{-- Encabezado institucional con logo y accesos a los módulos. --}}
    <header class="site-header">
        <div class="gov-bar">
            <div class="container d-flex align-items-center">
                <span class="gov-mark">✦</span><span>sena.edu.co</span>
            </div>
        </div>
        {{-- El menú se abre con el botón hamburguesa y está disponible sin iniciar sesión. --}}
        <nav class="navbar navbar-light bg-white py-0" aria-label="Navegación principal">
            <div class="container main-nav">
                <a class="navbar-brand sena-brand" href="{{ url('/') }}" aria-label="AdminSena inicio">
                    <span class="sena-logo" role="img" aria-label="Logo SENA"></span><span class="sena-word">AdminSena</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#homeNav" aria-controls="homeNav" aria-expanded="false" aria-label="Abrir menú">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="d-flex align-items-center gap-2 ms-auto auth-nav navbar-auth">
                    @auth
                        <span class="nav-link">{{ auth()->user()->name }}</span>
                        <form action="{{ route('auth.logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Cerrar sesión</button>
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('auth.access') }}#login">Inicio / Registro</a>
                    @endauth
                </div>
                <div class="collapse navbar-collapse" id="homeNav">
                    <ul class="navbar-nav ms-lg-4 align-items-lg-center">
                        <li class="nav-item"><a class="nav-link" href="{{ route('areas.index') }}">Áreas</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('training-centers.index') }}">Centros de Formación</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('computers.index') }}">Computadores</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">Cursos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('teachers.index') }}">Instructores</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('apprentices.index') }}">Aprendices</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('course-teachers.index') }}">Curso - Instructores</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- Contenido principal: carrusel y tarjetas de acceso a los CRUD. --}}
    <main>
        {{-- Carrusel institucional; sus imágenes y estilos están separados del contenido del home. --}}
        @include('includes.carousel')

        <section class="news-section container" aria-labelledby="news-title">
            {{-- Noticias informativas de ejemplo. --}}
            <div class="section-heading">
                <div><p class="eyebrow text-success mb-2">ACTUALIDAD SENA</p><h2 id="news-title">Noticias</h2></div>
                <span class="section-line"></span>
            </div>
            <div class="row g-3 g-lg-4">
                <div class="col-12 col-md-4"><article class="news-card"><span class="news-date">CONVOCATORIAS</span><h3>Inscripciones abiertas</h3><p>Participa en procesos del SENA.</p><a class="news-card-action" href="{{ route('news.convocatorias') }}">Ver convocatorias <i class="fas fa-arrow-right ms-1"></i></a></article></div>
                <div class="col-12 col-md-4"><article class="news-card"><span class="news-date">OFERTAS</span><h3>Formación disponible</h3><p>Encuentra oportunidades de aprendizaje.</p><a class="news-card-action" href="{{ route('news.ofertas') }}">Ver ofertas <i class="fas fa-arrow-right ms-1"></i></a></article></div>
                <div class="col-12 col-md-4"><article class="news-card"><span class="news-date">COMUNIDAD</span><h3>Unete a la red</h3><p>Aprende, comparte y crece.</p></article></div>
            </div>
        </section>

        <section class="sena-section container" aria-labelledby="sena-section-title">
            {{-- Resumen institucional que enlaza a la página completa de historia. --}}
            <div class="sena-section-content">
                <p class="eyebrow text-success mb-2">CONOCE EL SENA</p>
                <h2 id="sena-section-title">Una historia de oportunidades</h2>
                <p>Desde 1957, el SENA acompaña a los colombianos con formación profesional integral y herramientas para transformar sus proyectos de vida.</p>
                <a class="btn btn-sena" href="{{ route('sena.history') }}">Conocer nuestra historia <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </section>

    </main>

    {{-- Footer compartido con contacto y redes oficiales. --}}
    @include('includes.footer')
    @include('includes.dependenciasbody')
</body>
</html>
