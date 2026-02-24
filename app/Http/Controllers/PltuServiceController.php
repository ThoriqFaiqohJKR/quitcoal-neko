<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class PltuServiceController extends Controller
{

    public function getMarker()
    {
        $data = DB::table('profil_pltu')
            ->select(
                'id',
                'nama',
                'luas',
                'level_2',
                'level_3',
                'level_4',
                'level_5',
                'level_6',
                'latitude',
                'longitude'
            )
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $features = [];

        foreach ($data as $row) {
            $features[] = [
                "type" => "Feature",
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [
                        (float) $row->longitude,
                        (float) $row->latitude
                    ]
                ],
                "properties" => [
                    "id" => $row->id,
                    "nama" => $row->nama,
                    "luas" => $row->luas,
                    "level_2" => $row->level_2,
                    "level_3" => $row->level_3,
                    "level_4" => $row->level_4,
                    "level_5" => $row->level_5,
                    "level_6" => $row->level_6,
                    "latitude" => $row->latitude,
                    "longitude" => $row->longitude
                ]
            ];
        }

        return response()->json([
            "type" => "FeatureCollection",
            "features" => $features
        ]);
    }
    

    
    public function getProvinsiCentroid()
    {
        $rows = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_3_dissolved"'))
            ->selectRaw('
                "POLITICAL3" as nama,
                ST_Y(ST_PointOnSurface(geom)) as latitude,
                ST_X(ST_PointOnSurface(geom)) as longitude
            ')
            ->get();

        return response()->json($rows);
    }

    public function getPltuMarkerByKota($kota)
    {
        $rows = DB::connection('mysql')
            ->table('profil_pltu')
            ->where('level_4', $kota)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->select('level_4', 'level_6', 'latitude', 'longitude')
            ->get();

        return response()->json($rows);
    }


    public function getProvinsiCentroidPltu()
    {
        $provinsiList = DB::connection('mysql')
            ->table('profil_pltu')
            ->whereNotNull('level_3')
            ->distinct()
            ->pluck('level_3')
            ->toArray();

        if (count($provinsiList) === 0) {
            return response()->json([]);
        }

        $rows = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_3_dissolved"'))
            ->selectRaw('
                "POLITICAL3" as nama,
                ST_Y(ST_PointOnSurface(geom)) as latitude,
                ST_X(ST_PointOnSurface(geom)) as longitude
            ')
            ->whereIn(DB::raw('"POLITICAL3"'), $provinsiList)
            ->get();

        return response()->json($rows);
    }

    public function getProvinsiCqlFilter()
    {
        $provinsiList = DB::connection('mysql')
            ->table('profil_pltu')
            ->whereNotNull('level_3')
            ->distinct()
            ->pluck('level_3')
            ->toArray();

        if (count($provinsiList) === 0) {
            return response()->json([
                'cql' => "POLITICAL3 = '___NONE___'"
            ]);
        }

        $escaped = array_map(function ($p) {
            return str_replace("'", "''", $p);
        }, $provinsiList);

        $cql = "POLITICAL3 IN ('" . implode("','", $escaped) . "')";

        return response()->json([
            'cql' => $cql
        ]);
    }

    public function getProvinsiBounds($nama)
    {
        $row = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_3_dissolved"'))
            ->selectRaw("ST_Extent(geom) as extent")
            ->whereRaw("\"POLITICAL3\" = ?", [$nama])
            ->first();

        if (!$row || !$row->extent) {
            return response()->json(['error' => 'Provinsi tidak ditemukan'], 404);
        }

        preg_match(
            '/BOX\\(([-0-9\\.]+) ([-0-9\\.]+),([-0-9\\.]+) ([-0-9\\.]+)\\)/',
            $row->extent,
            $match
        );

        if (!$match) {
            return response()->json(['error' => 'Format extent tidak valid'], 500);
        }

        return response()->json([
            'bounds' => [
                [(float) $match[2], (float) $match[1]],
                [(float) $match[4], (float) $match[3]],
            ]
        ]);
    }

    public function getKotaCentroidByProvinsi($provinsi)
    {
        $kotaList = DB::connection('mysql')
            ->table('profil_pltu')
            ->where('level_3', $provinsi)
            ->whereNotNull('level_4')
            ->distinct()
            ->pluck('level_4')
            ->toArray();

        if (count($kotaList) === 0) {
            return response()->json([]);
        }

        $rows = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_4_dissolved"'))
            ->selectRaw('
                "POLITICAL_" as nama,
                "LEVEL_3" as provinsi,
                ST_Y(ST_PointOnSurface(geom)) as latitude,
                ST_X(ST_PointOnSurface(geom)) as longitude
            ')
            ->whereIn(DB::raw('"POLITICAL_"'), $kotaList)
            ->get();

        return response()->json($rows);
    }

    public function getKotaBounds($nama)
    {
        $row = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_4_dissolved"'))
            ->selectRaw("ST_Extent(geom) as extent")
            ->whereRaw("\"POLITICAL_\" = ?", [$nama])
            ->first();

        if (!$row || !$row->extent) {
            return response()->json(['error' => 'Kota tidak ditemukan'], 404);
        }

        preg_match(
            '/BOX\\(([-0-9\\.]+) ([-0-9\\.]+),([-0-9\\.]+) ([-0-9\\.]+)\\)/',
            $row->extent,
            $match
        );

        if (!$match) {
            return response()->json(['error' => 'Format extent tidak valid'], 500);
        }

        return response()->json([
            'bounds' => [
                [(float) $match[2], (float) $match[1]],
                [(float) $match[4], (float) $match[3]],
            ]
        ]);
    }

    public function getKotaCqlFilterByProvinsi($provinsi)
    {
        $kotaList = DB::connection('mysql')
            ->table('profil_pltu')
            ->where('level_3', $provinsi)
            ->whereNotNull('level_4')
            ->distinct()
            ->pluck('level_4')
            ->toArray();

        if (count($kotaList) === 0) {
            return response()->json([
                'cql' => "POLITICAL_ = '___NONE___'"
            ]);
        }

        $escaped = array_map(function ($k) {
            return str_replace("'", "''", $k);
        }, $kotaList);

        $cql = "POLITICAL_ IN ('" . implode("','", $escaped) . "')";

        return response()->json([
            'cql' => $cql
        ]);
    }

    // ==============================
    // DESA CENTROID (LEVEL 6)
    // ==============================
    public function getDesaCentroidByKota($kota)
    {
        $desaList = DB::connection('mysql')
            ->table('profil_pltu')
            ->where('level_4', $kota)
            ->whereNotNull('level_6')
            ->distinct()
            ->pluck('level_6')
            ->toArray();

        if (count($desaList) === 0) {
            return response()->json([]);
        }

        $rows = DB::connection('pgsql')
            ->table(DB::raw('"proteus"."POLITICAL_LEVEL_6_dissolved"'))
            ->selectRaw('
                "LEVEL_6" as nama,
                ST_Y(ST_PointOnSurface(geom)) as latitude,
                ST_X(ST_PointOnSurface(geom)) as longitude
            ')
            ->whereIn(DB::raw('"LEVEL_6"'), $desaList)
            ->get();

        return response()->json($rows);
    }

    // ==============================
    // PLTU POINT (ASLI DARI MYSQL)
    // ==============================
    public function getPltuMarkerByDesa($desa)
    {
        $rows = DB::connection('mysql')
            ->table('profil_pltu')
            ->where('level_6', $desa)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->select('nama', 'level_6', 'latitude', 'longitude')
            ->get();

        return response()->json($rows);
    }
}
