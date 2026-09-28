@extends('layouts.app')

@section('title', 'Convocatorias')

@section('content')
    <div class="access-page-header text-center">
        <p class="eyebrow text-success mb-2">OPORTUNIDADES DE FORMACIÓN</p>
        <h1>Convocatorias</h1>
        <p>Consulta las convocatorias disponibles en nuestra plataforma.</p>
    </div>

    <section class="static-list-section" aria-labelledby="convocatorias-title">
        <div class="section-heading">
            <div><p class="eyebrow text-success mb-2">LISTADO INFORMATIVO</p><h2 id="convocatorias-title">Convocatorias disponibles</h2></div>
            <span class="section-line"></span>
        </div>
        @if (session('status'))
            {{-- Informa el resultado de la inscripción sin abandonar la página. --}}
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif
        <div class="row g-4">
            @forelse ($courses as $course)
                <div class="col-12 col-md-6 col-xl-4">
                    <article class="static-opportunity-card">
                        <span class="news-date">CONVOCATORIA {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $course->program_name ?: $course->course_number }}</h3>
                        <p>Programa de formación del SENA disponible en esta convocatoria.</p>
                        <dl>
                            <div><dt>Formación</dt><dd>{{ ucfirst($course->training_type ?? 'técnico') }}</dd></div>
                            <div><dt>Ubicación</dt><dd>{{ $course->trainingCenter->name ?? 'Regional Cauca' }}</dd></div>
                            <div><dt>Modalidad</dt><dd>Presencial</dd></div>
                            <div><dt>Jornada</dt><dd>{{ $course->day }}</dd></div>
                            <div><dt>Inscritos</dt><dd class="opportunity-status">{{ $course->enrollments_count }}</dd></div>
                        </dl>
                        @if ($loop->odd)
                            {{-- Las tarjetas impares representan convocatorias abiertas. --}}
                            @auth
                            {{-- El usuario autenticado puede enviar su solicitud. --}}
                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-sena" type="submit">Confirmar inscripción</button>
                            </form>
                            @else
                                {{-- El visitante debe crear una cuenta o iniciar sesión. --}}
                                <a class="btn btn-outline-sena" href="{{ route('auth.access') }}#login">Inicia sesión para inscribirte</a>
                            @endauth
                        @else
                            {{-- Las tarjetas pares representan convocatorias no disponibles. --}}
                            <button class="btn btn-outline-secondary" type="button" disabled>Próximamente</button>
                        @endif
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No hay convocatorias disponibles por el momento.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
