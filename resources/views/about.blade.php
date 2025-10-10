@extends('layout')

@section('content')
    <div class="container py-5 fade-in">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-warning display-5 mb-3">Tentang <span class="text-light">MoVision</span></h1>
            <p class="text-light opacity-75 fs-5">
                MoVision dibuat untuk kamu yang suka nonton film dan ingin menemukan inspirasi tontonan baru dengan cara
                yang lebih mudah.
                Dengan tampilan yang simpel tapi elegan, MoVision menampilkan berbagai film lengkap dengan gambar, genre,
                dan deskripsinya.

                Website ini dibangun menggunakan Laravel, jadi selain seru untuk digunakan, MoVision juga kuat dari sisi
                performa dan keamanan.

                Tujuan kami sederhana — menghadirkan pengalaman browsing film yang cepat, bersih, dan menyenangkan.
                Baik kamu sekadar ingin mencari referensi film, atau belajar bagaimana sistem berbasis Laravel bekerja,
                MoVision siap menemanimu.
            </p>
        </div>
    </div>

    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-body ul li {
            transition: transform 0.2s ease;
        }

        .card-body ul li:hover {
            transform: translateX(5px);
            color: #ffd700;
        }
    </style>
@endsection
