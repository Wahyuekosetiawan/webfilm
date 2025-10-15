@extends('layout')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="text-center mb-5 fade-in">
            <div class="movie-icon mb-4">
                <i class="fas fa-film text-warning"></i>
            </div>
            <h1 class="fw-bold text-warning display-5 mb-3">Tentang <span class="text-light">MoVision</span></h1>
            <div class="divider mx-auto"></div>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="about-card card bg-dark border-warning shadow-lg fade-in-up">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="text-warning mb-3">Mengapa MoVision?</h3>
                        </div>

                        <div class="about-content">
                            <p class="text-light mb-4">
                                <span class="text-warning fw-semibold">MoVision</span> dibuat untuk kamu yang suka nonton film dan ingin menemukan inspirasi tontonan baru dengan cara yang lebih mudah.
                            </p>
                            
                            <p class="text-light mb-4">
                                Dengan tampilan yang simpel tapi elegan, MoVision menampilkan berbagai film lengkap dengan gambar, genre, dan deskripsinya. Kami percaya bahwa mencari film seharusnya menyenangkan, bukan membingungkan.
                            </p>

                            <div class="highlight-box p-3 mb-4">
                                <p class="text-light mb-0">
                                    <i class="fas fa-code text-warning me-2"></i>
                                    Dibangun dengan <strong>Laravel</strong> untuk performa optimal dan keamanan terbaik
                                </p>
                            </div>

                            <p class="text-light">
                                Tujuan kami sederhana — menghadirkan pengalaman browsing film yang cepat, bersih, dan menyenangkan. Baik kamu sekadar ingin mencari referensi film, atau belajar bagaimana sistem berbasis Laravel bekerja, MoVision siap menemanimu.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-in-out;
        }

        .fade-in-delay {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .movie-icon {
            font-size: 3rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .divider {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #ffd700, transparent);
        }

        .about-card {
            border-width: 2px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.1) !important;
        }

        .highlight-box {
            background: rgba(255, 215, 0, 0.1);
            border-left: 3px solid #ffd700;
            border-radius: 0 8px 8px 0;
        }

        .feature-item {
            padding: 15px 0;
            transition: transform 0.2s ease;
        }

        .feature-item:hover {
            transform: scale(1.05);
        }

        .feature-item i {
            font-size: 1.5rem;
        }

        .btn-warning {
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }
    </style>
@endsection