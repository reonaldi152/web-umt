@extends('user.layouts.app')

@section('title', 'Dosen')

@section('content')
    <!-- Section Header -->
    <section id="header-section">
        <h1>Daftar Dosen</h1>
    </section>
    <!-- Section Dosen -->
    <section id="dosen" class="mt-5">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="fs-3 fw-bolder">Dosen</h3>
            </div>
            <div class="row justify-content-center">
                @foreach ($dosens as $index => $dosen)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $dosen->image) }}" class="card-img-top"
                                alt="{{ $dosen->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dosen->name }}</h5>
                                <p class="card-text">{{ $dosen->jabatan }}</p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ $dosen->linkedin }}" target="_blank" class="btn btn-primary">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                    <a href="{{ $dosen->instagram }}" target="_blank" class="btn btn-danger">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="mailto:{{ $dosen->email }}" target="_blank" class="btn btn-secondary">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="{{ $dosen->youtube }}" target="_blank" class="btn btn-danger">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="{{ $dosen->tiktok }}" target="_blank" class="btn btn-dark">
                                        <i class="fab fa-tiktok"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (($index + 1) % 2 == 0 && ($index + 1) % 6 != 0)
                        <div class="w-100"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection
