<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <title>Dashboard Analisis Spasial</title>
    
    <link rel="stylesheet" href="{{ asset('css/map-style.css') }}">
</head>
<body class="bg-slate-50 text-slate-800 h-screen overflow-hidden flex flex-col">
 
    <div id="page-transition-overlay" class="fixed inset-0 bg-slate-50 z-[99999] transition-opacity duration-300 ease-in-out pointer-events-none opacity-100 flex items-center justify-center">
        <i class="fa-solid fa-circle-notch text-indigo-600 text-3xl animate-spin"></i>
    </div>
 
    <nav class="h-20 border-b border-slate-200 flex items-center justify-between px-10 bg-white">
        <div class="flex items-center gap-3">
            <div class="w-2.5 h-2.5 bg-indigo-500 rounded-full animate-ping"></div>
            <h1 class="font-bold text-lg tracking-tight text-slate-800">LOCATECH ANALISIS STRATEGIS</h1>
        </div>
        <a href="/" class="text-sm font-semibold text-slate-500 hover:text-indigo-600 transition page-back-link">
            <span class="mr-1">←</span> Kembali ke Home
        </a>
    </nav>
 
    <div class="flex flex-1 overflow-hidden">
        <aside class="w-96 bg-white border-r border-slate-200 p-8 flex flex-col gap-8 overflow-y-auto">
            
            <div class="relative">
                <h3 class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-2">Cari Lokasi Jalan</h3>
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Ketik nama jalan..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 pr-10 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    <button id="clear-search" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 font-bold text-lg">×</button>
                    <div id="search-results" class="hidden"></div>
                </div>
            </div>
 
            <div>
                <h3 class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-5">Statistik Wilayah</h3>
                <div class="grid gap-4">
                    <div class="bg-slate-50 p-5 rounded-3xl border border-slate-100">
                        <p class="text-slate-500 text-xs font-medium mb-1">Total Data Spasial</p>
                        <p class="text-3xl font-extrabold text-slate-800">{{ $stats['total'] }}</p>
                    </div>
                    <div class="bg-rose-50 p-5 rounded-3xl border border-rose-100">
                        <p class="text-rose-600 text-xs font-semibold mb-1">Area Pemukiman Warga</p>
                        <p class="text-3xl font-extrabold text-rose-600">{{ $stats['kurang'] }}</p>
                    </div>
                </div>
            </div>
 
            <div id="simulasi-panel" class="bg-indigo-50/50 p-6 rounded-[32px] border border-indigo-100">
                <h3 class="text-indigo-600 text-sm font-bold mb-4 flex items-center gap-2">
                    <span class="text-lg">📍</span> Simulasi Lokasi Baru
                </h3>
 
                <div class="mb-4">
                    <label class="text-[9px] font-black text-indigo-400 uppercase mb-1 block">Tipe Usaha Anda:</label>
                    <select id="biz_type" class="w-full bg-white border border-indigo-100 rounded-xl px-3 py-2 text-xs font-bold text-indigo-700 outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="Kuliner">Kuliner (Cafe, Resto, dsb)</option> 
                        <option value="Retail">Retail (Toko, Minimarket, dsb)</option>
                    </select>
                </div>
 
                <div id="simulasi-default">
                    <p class="text-slate-500 text-xs leading-relaxed italic border-t border-indigo-100 pt-3 text-center">Silakan klik area atau cari jalan untuk menganalisis potensi lokasi.</p>
                </div>
 
                <div id="simulasi-result" class="hidden border-t border-indigo-100 pt-4">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-500 font-medium">Skor Strategis:</span>
                            <span id="res-score" class="text-xl font-black text-indigo-600">0</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-indigo-100 pb-2">
                            <span class="text-xs text-slate-500 font-medium">Kelayakan:</span>
                            <span id="res-status" class="text-[10px] font-bold px-3 py-1 rounded-full uppercase"></span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-slate-500">Koordinat:</span>
                                <span id="res-coord" class="text-[10px] font-bold text-slate-800"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-slate-500">Jalan Terdekat:</span>
                                <span id="res-jalan-nama" class="text-[10px] font-bold text-indigo-600 underline"></span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] text-slate-500">Kompetitor Sejenis:</span>
                                <div class="text-right flex flex-col items-end">
                                    <span id="res-kompetitor" class="text-[10px] font-bold text-rose-500 cursor-pointer hover:underline" onclick="toggleKompetitorList()"></span>
                                    <div id="list-kompetitor" class="hidden mt-1 text-[9px] text-slate-400 bg-slate-50 p-2 rounded-lg border border-slate-100 max-h-24 overflow-y-auto w-40 text-left"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/60 p-4 rounded-2xl border border-indigo-100 shadow-sm">
                            <p id="res-saran" class="text-[11px] text-indigo-700 leading-relaxed font-medium italic"></p>
                        </div>
                    </div>
                </div>
            </div>
 
            <div class="mt-auto">
                <div class="bg-slate-50 p-5 rounded-2xl text-[10px] text-slate-400 leading-relaxed border border-slate-100">
                    Sistem menggunakan data <b>OpenStreetMap & PostGIS</b> untuk menghitung kompetisi dan magnet aktivitas masyarakat secara real-time.
                </div>
            </div>
        </aside>
 
        <main class="flex-1 p-8 bg-slate-50 relative">
            <div id="map" class="shadow-2xl shadow-slate-200 border-4 border-white"></div>
        </main>
    </div>
 
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script>
        // SCRIPT TRANSISI HALAMAN MAP
        const mapOverlay = document.getElementById('page-transition-overlay');
        
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                mapOverlay.classList.remove('opacity-100');
                mapOverlay.classList.add('opacity-0');
            }, 150);
        });
 
        document.querySelectorAll('.page-back-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const routeTarget = this.href;
                
                mapOverlay.classList.remove('pointer-events-none', 'opacity-0');
                mapOverlay.classList.add('opacity-100');
                
                setTimeout(() => {
                    window.location.href = routeTarget;
                }, 300);
            });
        });
 
        const map = L.map('map').setView([3.5952, 98.6722], 13);
        
        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3'],
            attribution: '&copy; Google Maps'
        }).addTo(map);
 
        const markers = L.markerClusterGroup();
        let tempMarker = null;
 
        function toggleKompetitorList() {
            const list = document.getElementById('list-kompetitor');
            list.classList.toggle('hidden');
        }
 
        fetch('/api/umkm').then(res => res.json()).then(data => {
            data.forEach(p => {
                const geo = JSON.parse(p.geometry);
                let color;
                
                if (p.biz_tag === 'Kuliner' || p.biz_tag === 'Retail') {
                    color = '#10b981';
                } else if (p.biz_tag === 'Pemukiman') {
                    color = '#fb7185';
                } else {
                    color = '#6366f1';
                }
 
                const marker = L.circleMarker([geo.coordinates[1], geo.coordinates[0]], {
                    radius: 8, fillColor: color, color: "#ffffff", weight: 2, fillOpacity: 0.9
                });
 
                marker.bindPopup(`
    <div style="font-family: 'Plus Jakarta Sans', sans-serif; padding: 5px;">
        <h4 style="font-weight: 800; color: #1e293b; margin-bottom: 4px;">${p.name || 'Fasilitas'}</h4>
        <p style="font-size: 10px; color: #64748b;">Kategori: <b>${p.biz_tag}</b></p>
    </div>
                `);
                markers.addLayer(marker);
            });
            map.addLayer(markers);
        });
 
        fetch('/api/jalan').then(res => res.json()).then(data => {
            data.forEach(j => {
                L.geoJSON(JSON.parse(j.geometry), { style: { color: '#94a3b8', weight: 2, opacity: 0.2 } }).addTo(map);
            });
        });
 
        function executeAnalysis(lat, lng) {
            const bizType = document.getElementById('biz_type').value;
            const listContainer = document.getElementById('list-kompetitor');
            listContainer.classList.add('hidden');
 
            if(tempMarker) map.removeLayer(tempMarker);
            tempMarker = L.marker([lat, lng]).addTo(map).bindPopup("Lokasi Analisis Baru").openPopup();
 
            fetch(`/api/simulasi?lat=${lat}&lng=${lng}&biz_type=${bizType}`)
                .then(res => res.json())
                .then(res => {
                    document.getElementById('simulasi-default').classList.add('hidden');
                    document.getElementById('simulasi-result').classList.remove('hidden');
                    
                    const statusEl = document.getElementById('res-status');
                    statusEl.innerText = res.status;
                    statusEl.className = `text-[10px] font-bold uppercase px-3 py-1 rounded-full ${res.status.includes('Strategis') && !res.status.includes('Kurang') ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'}`;
                    
                    document.getElementById('res-score').innerText = res.score;
                    document.getElementById('res-coord').innerText = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
                    document.getElementById('res-jalan-nama').innerText = res.nama_jalan;
                    document.getElementById('res-kompetitor').innerText = res.jml_kompetitor + " Kompetitor Sejenis (Lihat)";
                    
                    if (res.list_kompetitor && res.list_kompetitor.length > 0) {
                        listContainer.innerHTML = res.list_kompetitor.map(name => `• ${name}`).join('<br>');
                    } else {
                        listContainer.innerHTML = "Tidak ada kompetitor sejenis.";
                    }
 
                    let saran = "";
                    if (res.score >= 75) {
                        saran = `LOKASI EMAS! ${res.is_resident === 'Ya' ? 'Berada tepat di zona pemukiman.' : ''} Sangat potensial untuk ${bizType} karena magnet massa tinggi.`;
                    } else if (res.score >= 50) {
                        saran = res.jml_kompetitor > 3 ? `Lokasi Strategis, tapi waspada persaingan ${res.jml_kompetitor} unit.` : `Lokasi Strategis. Dekat dengan ${res.nama_fasilitas} and kompetisi rendah.`;
                    } else {
                        saran = res.jml_kompetitor > 5 ? `Persaingan Terlalu Ketat! Terdapat ${res.jml_kompetitor} kompetitor.` : `Lokasi Kurang Direkomendasikan (Jarak ke magnet massa terlalu jauh).`;
                    }
                    document.getElementById('res-saran').innerText = saran;
                });
        }
 
        map.on('click', function(e) {
            executeAnalysis(e.latlng.lat, e.latlng.lng);
        });
 
        const searchInput = document.getElementById('search-input');
        const clearBtn = document.getElementById('clear-search');
        const searchResults = document.getElementById('search-results');
 
        searchInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
                searchResults.classList.add('hidden');
            }
        });
 
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            this.classList.add('hidden');
            searchResults.classList.add('hidden');
            searchInput.focus();
        });
 
        searchInput.addEventListener('keyup', function() {
            const query = this.value;
            if (query.length < 3) {
                searchResults.classList.add('hidden');
                return;
            }
 
            fetch(`/api/search-jalan?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    if (data.length > 0) {
                        searchResults.classList.remove('hidden');
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'search-item';
                            div.innerText = item.name;
                            div.onclick = function() {
                                map.flyTo([item.lat, item.lng], 17);
                                executeAnalysis(item.lat, item.lng);
                                searchResults.classList.add('hidden');
                                searchInput.value = item.name;
                            };
                            searchResults.appendChild(div);
                        });
                    } else {
                        searchResults.classList.add('hidden');
                    }
                });
        });
 
        const legend = L.control({position: 'bottomright'});
        legend.onAdd = function () {
            const div = L.DomUtil.create('div', 'legend text-[11px] font-semibold');
            div.innerHTML = `
                <div style="margin-bottom: 8px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-size: 9px;">Legenda Data</div>
                <div class="flex items-center gap-3 mb-2"><span class="w-3 h-3 rounded-full bg-[#10b981]"></span> UMKM (Kuliner/Retail)</div>
                <div class="flex items-center gap-3 mb-2"><span class="w-3 h-3 rounded-full bg-[#fb7185]"></span> Area Pemukiman (Pasar)</div>
                <div class="flex items-center gap-3"><span class="w-3 h-3 rounded-full bg-[#6366f1]"></span> Magnet Aktivitas</div>`;
            return div;
        };
        legend.addTo(map);
    </script>
</body>
</html>