<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => DB::table('umkm_points')->count(),
            'kurang' => DB::table('area_pemukiman_medan')->count(), 
            'strategis' => DB::table('umkm_points')
                ->whereIn('kategori_umkm', ['Transportasi', 'Perbankan', 'Pendidikan', 'Wisata', 'Kesehatan'])
                ->count(),
        ];
        
        return view('map', compact('stats'));
    }

    public function getUmkm()
    {
        $data = DB::select("SELECT 
            id, name, amenity, kategori_umkm as biz_tag, 
            extensions.ST_AsGeoJSON(geom) as geometry 
            FROM umkm_points");
        return response()->json($data);
    }

    public function getJalan()
    {
        $data = DB::select("SELECT id, name, extensions.ST_AsGeoJSON(geom) as geometry FROM jalan_lines LIMIT 1500");
        return response()->json($data);
    }

    public function getSimulasi(Request $request)
    {
        $lat = (float) $request->lat;
        $lng = (float) $request->lng;
        $bizType = $request->biz_type; 

        // 1. SKOR JALAN (FIX: Mengganti operator <-> menjadi extensions.ST_Distance)
        $jalan = DB::selectOne("SELECT name, lanes,
                extensions.ST_DistanceSphere(geom, extensions.ST_SetSRID(extensions.ST_MakePoint(?::double precision, ?::double precision), 4326)) as jarak 
                FROM jalan_lines 
                ORDER BY extensions.ST_Distance(geom, extensions.ST_SetSRID(extensions.ST_MakePoint(?::double precision, ?::double precision), 4326)) ASC 
                LIMIT 1", [$lng, $lat, $lng, $lat]);

        $scoreRoad = 0;
        $jarakJalan = $jalan ? round($jalan->jarak) : 999;
        if ($jarakJalan < 50) $scoreRoad += 20; 
        if ($jalan && isset($jalan->lanes) && $jalan->lanes !== null && (int)$jalan->lanes > 1) {
            $scoreRoad += 20;
        }

        // 2. CEK PEMUKIMAN
        $isResidential = DB::selectOne("SELECT id FROM area_pemukiman_medan 
            WHERE extensions.ST_DWithin(geom, extensions.ST_SetSRID(extensions.ST_MakePoint(?::double precision, ?::double precision), 4326), 0) LIMIT 1", [$lng, $lat]);

        $scoreResidential = $isResidential ? 30 : 0;

        // 3. MAGNET SEKITAR
        $magnets = DB::selectOne("SELECT COUNT(*) as jml FROM umkm_points 
            WHERE kategori_umkm IN ('Transportasi', 'Wisata', 'Pendidikan', 'Perbankan', 'Kesehatan') 
            AND extensions.ST_DistanceSphere(geom, extensions.ST_SetSRID(extensions.ST_MakePoint(?::double precision, ?::double precision), 4326)) <= 500", [$lng, $lat]);

        $jmlMagnet = ($magnets && isset($magnets->jml)) ? $magnets->jml : 0;
        $scoreMagnet = ($jmlMagnet * 5);
        if ($scoreMagnet > 30) $scoreMagnet = 30;

        // 4. KOMPETITOR
        $kompetitorData = DB::select("SELECT name FROM umkm_points 
            WHERE kategori_umkm = ? 
            AND extensions.ST_DistanceSphere(geom, extensions.ST_SetSRID(extensions.ST_MakePoint(?::double precision, ?::double precision), 4326)) <= 500
            LIMIT 10", [$bizType, $lng, $lat]);
        
        $jmlKompetitor = count($kompetitorData);
        $namaKompetitor = array_map(fn($item) => $item->name ?? 'Tanpa Nama', $kompetitorData);
        
        $penalty = $jmlKompetitor * 5;
        
        // 5. SKOR AKHIR
        $finalScore = $scoreRoad + $scoreResidential + $scoreMagnet - $penalty;
        if ($finalScore > 100) $finalScore = 100;
        if ($finalScore < 0) $finalScore = 0;

        // 6. NAMA FASILITAS TERDEKAT (FIX: Mengganti operator <-> menjadi extensions.ST_Distance)
        $fasilitasNama = DB::selectOne("SELECT name FROM umkm_points 
            WHERE kategori_umkm NOT IN ('Kuliner', 'Retail') 
            ORDER BY extensions.ST_Distance(geom, extensions.ST_SetSRID(extensions.ST_MakePoint(?::double precision, ?::double precision), 4326)) ASC LIMIT 1", [$lng, $lat]);

        $status = "Kurang Strategis";
        if ($finalScore >= 75) $status = "Sangat Strategis";
        else if ($finalScore >= 50) $status = "Strategis";

        $namaJalanFix = ($jalan && isset($jalan->name) && $jalan->name !== null) ? $jalan->name : 'Jalan Tanpa Nama/Gang';
        $namaFasilitasFix = ($fasilitasNama && isset($fasilitasNama->name) && $fasilitasNama->name !== null) ? $fasilitasNama->name : 'Fasilitas Umum';

        return response()->json([
            'lat' => $lat,
            'lng' => $lng, 
            'score' => $finalScore,
            'jarak' => $jarakJalan, 
            'nama_jalan' => $namaJalanFix,
            'is_resident' => $isResidential ? 'Ya' : 'Tidak',
            'fasilitas' => $jmlMagnet,
            'nama_fasilitas' => $namaFasilitasFix,
            'jml_kompetitor' => $jmlKompetitor,
            'list_kompetitor' => $namaKompetitor,
            'status' => $status
        ]);
    }

    public function searchJalan(Request $request)
    {
        $query = $request->q;
        $data = DB::select("SELECT name, 
            extensions.ST_Y(extensions.ST_Centroid(geom)) as lat,
            extensions.ST_X(extensions.ST_Centroid(geom)) as lng 
            FROM jalan_lines 
            WHERE name ILIKE ? AND name IS NOT NULL LIMIT 5", ["%{$query}%"]);
        return response()->json($data);
    }
}