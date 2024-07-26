@extends('user.layouts.app')

@section('title', 'Jurnal')

@section('content')
    <!-- Section Header -->
    <section id="header-section">
        <h1>Daftar Jurnal</h1>
    </section>
    {{-- Section Jurnal --}}
    <section id="jurnal">
        <div class="container mt-5">
            <div class="text-center mb-4">
                <h3 class="fs-3 fw-bolder">Daftar Jurnal</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <p>Dimana mahasiswa dapat mem-publish atau menerbitkan artikel ilmiah ? Laman ini menampilkan informasi
                        mengenai jurnal bidang Informatika dari seluruh Indonesia. Jurnal dikelompokkan berdasarkan waktu
                        terbit dan tingkat akreditasi Sinta, dengan urutan Sinta 1 lebih baik apabila dibandingkan Sinta 6.
                        Beberapa diantaranya terakreditas Scopus. Khusus mahasiswa S1 Prodi Informatika, Jurnal
                        terakreditasi Sinta 3 merupakan syarat minimal yang harus dipenuhi apabila hendak menempuh jalur
                        kelulusan non skripsi atau non reguler kategori Scientist. Melalui skema Scientist, segala biaya
                        yang timbul ditanggung oleh Mahasiswa</p>

                    <!-- Menampilkan data jurnal dalam bentuk list -->
                    <ul>
                        @foreach ($jurnals as $jurnal)
                            <li>{{ $jurnal->name }} - {{ $jurnal->category }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection
