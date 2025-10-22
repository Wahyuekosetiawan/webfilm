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

                            <p class="text-light mb-4">
                                Tujuan kami sederhana — menghadirkan pengalaman browsing film yang cepat, bersih, dan menyenangkan. Baik kamu sekadar ingin mencari referensi film, atau belajar bagaimana sistem berbasis Laravel bekerja, MoVision siap menemanimu.
                            </p>
                            
                            <!-- Anggota Team Section -->
                            <div class="team-section mt-5 pt-4">
                                <h4 class="text-warning text-center mb-4">Tim Pengembang</h4>
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="team-member-card bg-dark border border-warning rounded p-3 mb-3">
                                            <div class="member-info text-center">
                                                <h6 class="text-light mb-2 fw-bold">Adinda Febrian Dwitama</h6>
                                                <p class="text-warning mb-0">241011700853</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="team-member-card bg-dark border border-warning rounded p-3 mb-3">
                                            <div class="member-info text-center">
                                                <h6 class="text-light mb-2 fw-bold">Annas Syafarudin</h6>
                                                <p class="text-warning mb-0">241011700462</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="team-member-card bg-dark border border-warning rounded p-3 mb-3">
                                            <div class="member-info text-center">
                                                <h6 class="text-light mb-2 fw-bold">Fadhilah Tris Nadia</h6>
                                                <p class="text-warning mb-0">241011701281</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="team-member-card bg-dark border border-warning rounded p-3 mb-3">
                                            <div class="member-info text-center">
                                                <h6 class="text-light mb-2 fw-bold">Wahyu Eko Setiawan</h6>
                                                <p class="text-warning mb-0">241011700451</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
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

        .team-section {
            border-top: 1px solid rgba(255, 215, 0, 0.3);
        }

        .team-member-card {
            transition: all 0.3s ease;
            cursor: pointer;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .team-member-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
            border-color: #ffed4a !important;
            background: rgba(255, 215, 0, 0.05);
        }

        .member-info h6 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .member-info p {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .team-member-card {
                margin-bottom: 15px;
                min-height: 70px;
                padding: 1rem !important;
            }
            
            .member-info h6 {
                font-size: 0.9rem;
            }
            
            .member-info p {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .team-member-card {
                min-height: 65px;
                padding: 0.75rem !important;
            }
        }
    </style>
@endsection