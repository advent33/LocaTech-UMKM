<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>LocaTech UMKM</title>
    
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden transition-colors duration-300">
    
    <div id="page-transition-overlay" class="fixed inset-0 bg-white dark:bg-slate-950 z-[99999] transition-opacity duration-300 ease-in-out pointer-events-none opacity-100 flex items-center justify-center">
        <i class="fa-solid fa-circle-notch text-indigo-600 dark:text-indigo-400 text-3xl animate-spin"></i>
    </div>
 
    <div id="nav-overlay"></div>
 
    <nav class="h-[73px] sticky top-0 z-40 glass-nav border-b border-slate-100 dark:border-slate-900 shadow-sm flex items-center transition-colors duration-300">
        <div class="max-w-[1240px] mx-auto px-10 w-full flex justify-between items-center relative">
            <h1 class="text-2xl font-extrabold text-indigo-600 dark:text-indigo-400 tracking-tighter flex items-center gap-2">
                <i class="fa-solid fa-map-location-dot text-xl"></i>LocaTech UMKM<span class="text-slate-400">.</span>
            </h1>
            
            <div class="flex items-center gap-6">
                <button id="theme-toggle" class="p-2.5 text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all focus:outline-none bg-transparent" aria-label="Toggle Theme">
                    <i id="theme-icon-dark" class="fa-solid fa-moon text-lg hidden dark:block"></i>
                    <i id="theme-icon-light" class="fa-solid fa-sun text-lg dark:hidden"></i>
                </button>
 
                <div id="nav-menu-destop" class="hidden md:flex items-center space-x-8 font-bold text-[12px] tracking-[0.15em] text-slate-500 dark:text-slate-400">
                    <a href="#home" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">HOME</a>
                    <a href="#tentang" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">ABOUT</a>
                    <a href="#fitur" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">FITUR</a>
                    <a href="#manfaat" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">MANFAAT</a>
                    <a href="#creator" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">CREATOR</a>
                    <a href="/map" class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 hover:scale-105 hover:shadow-lg dark:hover:shadow-indigo-900/30 transition-all text-center uppercase tracking-widest text-[11px] page-link">MULAI ANALISIS</a>
                </div>
 
                <button id="hamburger" class="md:hidden text-slate-600 dark:text-slate-400 text-2xl focus:outline-none bg-transparent">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>
 
    <div id="nav-menu-mobile" class="hidden font-bold text-[12px] tracking-[0.15em] text-slate-500 dark:text-slate-400">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-800 w-full">
            <span class="text-sm font-black tracking-wider text-indigo-600 dark:text-indigo-400">NAVIGASI MENU</span>
        </div>
        <a href="#home" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">HOME</a>
        <a href="#tentang" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">ABOUT</a>
        <a href="#fitur" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">FITUR</a>
        <a href="#manfaat" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">MANFAAT</a>
        <a href="#creator" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition uppercase">CREATOR</a>
        <a href="/map" id="mobile-btn-analisis" class="rounded-xl py-3 text-center uppercase tracking-widest text-[11px] font-bold text-white transition-all duration-300 page-link">MULAI ANALISIS</a>
    </div>
 
    <header id="home" class="spatial-grid border-b border-slate-100 dark:border-slate-900/60 layout-frame relative z-10 overflow-hidden">
        <div class="main-container grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 text-left flex flex-col items-start" data-aos="fade-right" data-aos-delay="100">
                <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 text-[11px] font-bold tracking-[0.20em] uppercase text-indigo-600 dark:text-indigo-400 bg-indigo-50/80 dark:bg-indigo-950/40 rounded-full border border-indigo-100 dark:border-indigo-900/30 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    Medan City Spatial Analysis
                </div>
                
                <h2 class="text-4xl md:text-6xl lg:text-[64px] font-black mb-6 tracking-tight text-slate-900 dark:text-white leading-[1.1]">
                    Identifikasi Lokasi <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-500 to-violet-500 dark:from-indigo-400 dark:to-purple-400">
                        Strategis UMKM
                    </span>
                </h2>
                
                <p class="text-slate-500 dark:text-slate-400 max-w-xl text-lg mb-8 leading-relaxed font-medium">
                    Membantu pelaku usaha UMKM di Kota Medan menentukan lokasi terbaik berdasarkan analisis spasial digital secara real-time.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <a href="/map" class="bg-slate-900 dark:bg-indigo-600 text-white px-8 py-3.5 rounded-xl font-bold text-base hover:bg-slate-800 dark:hover:bg-indigo-700 hover:shadow-xl dark:hover:shadow-indigo-900/30 transition-all flex items-center justify-center gap-3 shadow-md page-link">
                        <i class="fa-solid fa-earth-asia"></i> Buka Peta Analisis
                    </a>
                    <a href="#tentang" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 px-8 py-3.5 rounded-xl font-bold text-base hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all text-center flex items-center justify-center gap-2">
                        Pelajari Metodologi <i class="fa-solid fa-arrow-down text-sm"></i>
                    </a>
                </div>
            </div>
 
            <div class="lg:col-span-5 relative w-full flex justify-center lg:justify-end" data-aos="fade-left" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500/10 to-violet-500/10 blur-3xl -z-10 rounded-full scale-95"></div>
                <div class="relative p-2 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-[2rem] shadow-xl w-full overflow-hidden">
                    <div class="rounded-[1.5rem] overflow-hidden bg-slate-100 dark:bg-slate-800 relative group h-[440px] w-full">
                        <img src="{{ asset('img/home.jpeg') }}" alt="Spatial Map Interface" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/30 via-transparent to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
 
    <section id="tentang" class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-900/60 layout-frame">
        <div class="main-container">
            <div class="flex flex-col md:flex-row items-center gap-16 responsive-flex">
                <div class="md:w-1/2 responsive-width" data-aos="fade-right">
                    <h3 class="text-indigo-600 dark:text-indigo-400 font-extrabold uppercase tracking-[0.2em] text-[13px] mb-4">MENGENAL LOCATECH UMKM</h3>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-6 leading-tight">Solusi Cerdas Untuk <br> Ekspansi Bisnis Anda</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-lg leading-relaxed mb-8 font-medium">
                        Platform ini mengintegrasikan data geografis dengan kebutuhan pasar. Kami membantu memetakan peluang usaha melalui perhitungan kedekatan magnet keramaian kota.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-6 bg-slate-50 dark:bg-slate-950 rounded-[1.5rem] border border-slate-100 dark:border-slate-800 text-center">
                            <h4 class="text-3xl font-black text-indigo-600 dark:text-indigo-400">99%</h4>
                            <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-2">Akurasi Data</p>
                        </div>
                        <div class="p-6 bg-slate-50 dark:bg-slate-950 rounded-[1.5rem] border border-slate-100 dark:border-slate-800 text-center">
                            <h4 class="text-3xl font-black text-indigo-600 dark:text-indigo-400">Live</h4>
                            <p class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-2">Spatial Analysis</p>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 responsive-width" data-aos="fade-left">
                    <div class="rounded-[2rem] overflow-hidden shadow-lg border-4 border-slate-50 dark:border-slate-800 group">
                        <img src="{{ asset('img/tentang.jpeg') }}" alt="Map Analysis" class="w-full h-[440px] object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section id="fitur" class="bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-slate-900/60 layout-frame">
        <div class="text-center mb-12" data-aos="fade-up"> 
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-3 tracking-tight">Fitur Utama</h2>
            <p class="text-slate-500 dark:text-slate-400 text-base font-medium px-4">Segala yang Anda butuhkan untuk riset lokasi bisnis.</p>
        </div>
        <div class="main-container grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-slate-900 p-8 md:p-10 rounded-[2rem] border border-slate-100 dark:border-slate-800/80 premium-card text-center shadow-sm hover:shadow-xl dark:hover:shadow-indigo-950/20" data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-950/40 rounded-2xl flex items-center justify-center mb-6 text-indigo-600 dark:text-indigo-400 text-2xl mx-auto">
                    <i class="fa-solid fa-mouse-pointer"></i>
                </div>
                <h5 class="text-xl font-bold mb-3 text-slate-800 dark:text-slate-200">Simulasi Klik</h5>
                <p class="text-slate-500 dark:text-slate-400 text-[14px] leading-relaxed">Analisis potensi lokasi hanya dengan satu klik pada peta digital Kota Medan.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 md:p-10 rounded-[2rem] border border-slate-100 dark:border-slate-800/80 premium-card text-center shadow-sm hover:shadow-xl dark:hover:shadow-indigo-950/20" data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-950/40 rounded-2xl flex items-center justify-center mb-6 text-indigo-600 dark:text-indigo-400 text-2xl mx-auto">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
                <h5 class="text-xl font-bold mb-3 text-slate-800 dark:text-slate-200">Skor Strategis</h5>
                <p class="text-slate-500 dark:text-slate-400 text-[14px] leading-relaxed">Penilaian otomatis (0-100) berdasarkan akses jalan dan magnet massa sekitar.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 md:p-10 rounded-[2rem] border border-slate-100 dark:border-slate-800/80 premium-card text-center shadow-sm hover:shadow-xl dark:hover:shadow-indigo-950/20" data-aos="fade-up" data-aos-delay="300">
                <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-950/40 rounded-2xl flex items-center justify-center mb-6 text-indigo-600 dark:text-indigo-400 text-2xl mx-auto">
                    <i class="fa-solid fa-users-rays"></i>
                </div>
                <h5 class="text-xl font-bold mb-3 text-slate-800 dark:text-slate-200">Analisis Kompetisi</h5>
                <p class="text-slate-500 dark:text-slate-400 text-[14px] leading-relaxed">Menghitung jumlah kompetitor sejenis untuk menghindari saturasi pasar.</p>
            </div>
        </div>
    </section>
 
    <section id="manfaat" class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-900 layout-frame">
        <div class="main-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5" data-aos="fade-right">
                    <h3 class="text-indigo-600 dark:text-indigo-400 font-extrabold uppercase tracking-[0.2em] text-[13px] mb-3">KEUNTUNGAN PLATFORM</h3>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-6 tracking-tight leading-tight">
                        Keunggulan Analisis <br>LocaTech UMKM
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400 font-medium text-base leading-relaxed">
                        Pengambilan keputusan berbasis data spasial real-time memberikan keunggulan kompetitif yang mutlak bagi pertumbuhan bisnis retail dan UMKM di Kota Medan.
                    </p>
                </div>
 
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6" data-aos="fade-left">
                    <div class="p-8 bg-slate-50 dark:bg-slate-950 rounded-[2rem] border border-slate-100 dark:border-slate-800 premium-card flex flex-col items-start">
                        <div class="w-12 h-12 rounded-xl bg-white dark:bg-slate-900 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-xl mb-5 shadow-sm">
                            <i class="fa-solid fa-stopwatch"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">Efisiensi Waktu</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Menghemat waktu survei lapangan secara signifikan lewat dashboard digital terpusat.</p>
                    </div>
 
                    <div class="p-8 bg-slate-50 dark:bg-slate-950 rounded-[2rem] border border-slate-100 dark:border-slate-800 premium-card flex flex-col items-start">
                        <div class="w-12 h-12 rounded-xl bg-white dark:bg-slate-900 flex items-center justify-center text-rose-600 dark:text-rose-400 text-xl mb-5 shadow-sm">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-2">Minim Risiko</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Meminimalkan risiko kerugian finansial akibat salah memilih lokasi yang sepi pengunjung.</p>
                    </div>
 
                    <div class="p-8 bg-slate-50 dark:bg-slate-950 rounded-[2rem] border border-slate-100 dark:border-slate-800 premium-card sm:col-span-2 flex flex-col sm:flex-row sm:items-center gap-6">
                        <div class="w-12 h-12 rounded-xl bg-white dark:bg-slate-900 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xl flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-1">Optimasi Omzet</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Maksimalkan potensi keuntungan dengan mencocokkan densitas penduduk terhadap target pasar produk Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section id="creator" class="bg-slate-50 dark:bg-slate-950 layout-frame">
        <div class="main-container">
            <div class="text-center mb-10" data-aos="fade-up">
                <h3 class="text-indigo-600 dark:text-indigo-400 font-extrabold uppercase tracking-[0.2em] text-[13px] mb-2">PROFIL PENGEMBANG</h3>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">The Mastermind</h2>
            </div>
            
            <div class="max-w-4xl mx-auto bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800/80 shadow-xl overflow-hidden p-8 md:p-12 flex flex-col md:flex-row items-center gap-12 relative group" data-aos="fade-up" data-aos-delay="150">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
 
                <div class="w-full md:w-1/3 flex justify-center flex-shrink-0">
                    <div class="relative">
                        <div class="absolute -inset-1.5 bg-gradient-to-tr from-indigo-600 to-purple-500 rounded-[2rem] blur-sm opacity-25 group-hover:opacity-50 transition duration-500"></div>
                        <div class="relative w-65 h-65 rounded-[1.8rem] overflow-hidden border-4 border-white dark:border-slate-900 shadow-md">
                            <img src="{{ asset('img/team/advent.png') }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80';" alt="Adventsen" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
 
                <div class="w-full md:w-2/3 flex flex-col justify-center text-center md:text-left">
                    <div class="inline-flex items-center justify-center md:justify-start gap-2 px-3 py-1 mb-4 text-[10px] font-bold tracking-[0.2em] uppercase text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 rounded-lg w-fit mx-auto md:mx-0">
                        <i class="fa-solid fa-shield-halved text-xs"></i> LEAD DEVELOPER
                    </div>
     
                    <h4 class="text-3xl font-black text-slate-800 dark:text-slate-100 mb-1 tracking-tight">Adventsen Panjaitan</h4>
                    <p class="text-sm text-slate-400 dark:text-slate-500 font-bold tracking-wider mb-5">NIM. 2305181078</p>
     
                    <p class="text-slate-500 dark:text-slate-400 text-base leading-relaxed mb-6 italic font-medium relative bg-slate-50 dark:bg-slate-950/40 p-4 rounded-2xl border-l-4 border-indigo-500">
                        "Membangun ekosistem teknologi cerdas berbasis data geospasial untuk kemajuan ekonomi lokal Kota Medan."
                    </p>
     
                    <div class="flex items-center justify-center md:justify-start gap-4">
                        <span class="text-xs font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-widest mr-1">Hubungi:</span>
                        <a href="https://www.instagram.com/adventpjtn?igsh=MW9lNTU0emVhMHh3NA==" target="_blank" class="w-10 h-10 bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800/80 text-slate-400 dark:text-slate-500 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 dark:hover:text-white hover:-translate-y-1 transition-all shadow-sm">
                            <i class="fa-brands fa-instagram text-base"></i>
                        </a>
                        <a href="https://github.com/advent33" target="_blank" class="w-10 h-10 bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800/80 text-slate-400 dark:text-slate-500 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 dark:hover:text-white hover:-translate-y-1 transition-all shadow-sm">
                            <i class="fa-brands fa-github text-base"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/adventsen-panjaitan-422472383?utm_source=share_via&utm_content=profile&utm_medium=member_android" target="_blank" class="w-10 h-10 bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800/80 text-slate-400 dark:text-slate-500 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 dark:hover:text-white hover:-translate-y-1 transition-all shadow-sm">
                            <i class="fa-brands fa-linkedin text-base"></i>
                        </a>
                        <a href="https://www.tiktok.com/@adventsen?_r=1&_t=ZS-928QNNLhyYG" target="_blank" class="w-10 h-10 bg-slate-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800/80 text-slate-400 dark:text-slate-500 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500 dark:hover:text-white hover:-translate-y-1 transition-all shadow-sm">
                            <i class="fa-brands fa-tiktok text-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <footer class="bg-indigo-600 dark:bg-slate-950 py-6 border-t border-transparent dark:border-slate-900 transition-colors">
        <div class="container mx-auto px-6 text-center">
            <p class="text-white dark:text-slate-400 text-[11px] sm:text-[13px] font-semibold tracking-wider leading-relaxed">
                &copy; 2026 LocaTech UMKM. Adventsen Panjaitan | All rights reserved.
            </p>
        </div>
    </footer>
 
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // ENGINE SCRIPT INTERPRETER TRANSISI HALAMAN
        const transitionOverlay = document.getElementById('page-transition-overlay');
        
        // 1. Efek Fade In saat halaman sukses dimuat penuh
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                transitionOverlay.classList.add('opacity-0');
            }, 150);
        });
 
        // 2. Efek Fade Out saat mendeteksi navigasi pindah halaman ke /map
        document.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const routeTarget = this.href;
                
                transitionOverlay.classList.remove('pointer-events-none', 'opacity-0');
                transitionOverlay.classList.add('opacity-100');
                
                setTimeout(() => {
                    window.location.href = routeTarget;
                }, 300); // Sinkron dengan durasi CSS Tailwind
            });
        });
 
        // INISIALISASI ENGINE AOS ANIMASI
        AOS.init({
            duration: 900,
            once: true,  
            offset: 100  
        });
 
        // Logika Khusus Hamburger Menu Mobile Drawer
        const btn = document.getElementById('hamburger');
        const menu = document.getElementById('nav-menu-mobile');
        const overlay = document.getElementById('nav-overlay');
 
        function toggleMenu() {
            menu.classList.toggle('active');
            overlay.classList.toggle('active');
        }
 
        btn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
 
        document.querySelectorAll('#nav-menu-mobile a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    toggleMenu();
                }
            });
        });
 
        // Logika Theme Dark / Light Mode
        const themeToggleBtn = document.getElementById('theme-toggle');
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>