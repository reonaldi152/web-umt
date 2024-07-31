@extends('user.layouts.app')

@section('title', 'Welcome')

@section('content')

    {{-- Section Hero --}}
    <section id="hero" class="d-flex align-items-center">
        <div class="container position-relative">
            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 justify-content-center align-items-center">
                <div class="col col-lg-6">
                    <h1 class="mb-3 fs-1 fw-bold">{{ $dashboards[0]->title }}</h1>
                    <p class="fw-light">
                        {{ $dashboards[0]->subtitle }}
                    </p>
                </div>
                <div class="col col-lg-4 text-center">
                    {{-- <img src="{{ url('/assets/hero.png') }}" alt="" class="img-fluid"> --}}

                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($carousels as $index => $carousel)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $carousel->image) }}" class="d-block w-100"
                                        alt="carousel-image">
                                </div>
                            @endforeach
                        </div>
                        {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Agenda dan Pengumuman --}}
    <section id="ap">
        <div class="container mt-5">
            <div class="text-center mb-4">
                <h3 class="fs-3 fw-bolder">Agenda Dan Pengumuman</h3>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                @foreach ($agendas as $agenda)
                    <div class="col d-flex justify-content-center">
                        <div class="card h-100">
                            <div class="home-card-img-top">
                                <img src="{{ asset('storage/' . $agenda->image) }}" alt="Placeholder image"
                                    class="card-img-top img-fluid">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $agenda->title }}</h5>
                                <p class="card-text">{{ $agenda->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Section Talenta Terbaik --}}
    <section id="tt" class="mb-5">
        <div class="container mt-5">
            <div class="col">
                <h3 class="fs-3 fw-bolder mb-4">Talenta Terbaik</h3>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                @foreach ($talentas as $talenta)
                    <div class="col">
                        <div class="card h-100">
                            <div class="home-card-img-top">
                                <img src="{{ asset('storage/' . $talenta->image) }}" alt="Placeholder image"
                                    class="img-fluid">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $talenta->title }}</h5>
                                <p class="card-text">{{ $talenta->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Section Alumni --}}
    <section id="alumni" class="mb-5">
        <div class="container mt-5">
            <div class="text-center mb-4">
                <h3 class="fs-3 fw-bolder">Alumni</h3>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
                @foreach ($alumnis as $alumni)
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $alumni->image) }}" class="card-img-top img-fluid"
                                alt="{{ $alumni->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $alumni->name }}</h5>
                                <p class="card-text">{{ $alumni->jabatan }}</p>
                                <div class="d-flex justify-content-center">
                                    @if ($alumni->linkedin)
                                        <a href="{{ $alumni->linkedin }}" class="btn btn-link"><i
                                                class="bi bi-linkedin"></i></a>
                                    @endif
                                    @if ($alumni->instagram)
                                        <a href="{{ $alumni->instagram }}" class="btn btn-link"><i
                                                class="bi bi-instagram"></i></a>
                                    @endif
                                    @if ($alumni->email)
                                        <a href="mailto:{{ $alumni->email }}" class="btn btn-link"><i
                                                class="bi bi-envelope"></i></a>
                                    @endif
                                    @if ($alumni->youtube)
                                        <a href="{{ $alumni->youtube }}" class="btn btn-link"><i
                                                class="bi bi-youtube"></i></a>
                                    @endif
                                    @if ($alumni->tiktok)
                                        <a href="{{ $alumni->tiktok }}" class="btn btn-link"><i
                                                class="bi bi-tiktok"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
